<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Collector;
use App\Models\PickupRequest;
use App\Models\Address;
use App\Models\TimeSlot;
use App\Models\CollectorRecycle;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register', 'adminLogin', 'availableTime']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if (!$token = auth()->attempt($validator->validated())) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->createNewToken($token);
    }
    public function adminLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if (!$token = auth()->attempt($validator->validated())) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        

         $access_token = $token;
         return view('dashboard')->with('token', $access_token);

    }
    /**
     * Register a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|between:2,100',
            'last_name' => 'required|string|between:2,100',
            'user_type' => 'required',
            'phone' => 'required|string|min:11',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|confirmed|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json(array(
                "status" => false,
                "errors" => $validator->errors()
            ), 400);
        }
        $user = User::create(array_merge(
            $validator->validated(),
            ['password' => bcrypt($request->password)]
        ));
       $token = auth()->attempt($validator->validated());
       
        return response()->json([
            'status' => true,
            'message' => 'User successfully registered',
            'access_token'=>$token,
            'user' => $user
        ], 201);
    }

    public function approveCollector(Request $request){
        $user = auth()->user();
        $user_type = $user->user_type;
        if($user_type == 1){
            

        $collector_id = ($request->header('collectorid'));
        $collector = Collector::find($collector_id);
        $user_id = $collector->user_id;
        $collector_user = User::find($user_id);
        $collector_email = $collector_user->email;
        if($collector != null){
        $collector->is_approved = 1;
        $collector->save();     
        }


        return response()->json([
            'status' => true,
            'message' => 'Admin successfully approved Collector',
            'collector' => $collector
        ], 201);
    }

    }
    public function disapproveCollector(Request $request){
        $user = auth()->user();
        $user_type = $user->user_type;
        if($user_type == 1){
            
        $collector_id = $request->header('collectorid');
        $collector =Collector::find($collector_id);
        $user_id = $collector->user_id;
        $collector_user = User::find($user_id);
        $collector_email = $collector_user->email;
        $collector->delete();
        $collector_user->delete();
        $recyclable =CollectorRecycle::where("collector_id",$collector_id);
        $recyclable->delete();

        return response()->json([
            'status' => true,
            'message' => 'Admin disapproved collector',
            'collector' => $collector
        ], 201);
    }

    }



    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'User successfully signed out']);
    }
    public function editUserProfile(Request $req){
        $id =auth()->user()->id;
        $user = User::find($id);
        $user->first_name = $req->first_name;   
        $user->last_name = $req->last_name;
        $user->phone = $req->phone;
        $user->save();
        return response()->json(['message' => 'profile successfully updated']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->createNewToken(auth()->refresh());
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function userProfile()
    {
        return response()->json(auth()->user());
    }
    public function newPickupRequest(Request $request){
        $collector_id = $request->collector_id;
        $user_id = auth()->user()->id;
        $address = Address::where("user_id", $user_id)->get("id");
        $address_id = $address[0]->id;
        $pickup_request = new PickupRequest;
        $pickup_request->user_id = $user_id;
        $pickup_request->collector_id= $collector_id;
        $pickup_request->address_id = $address_id;
        $pickup_request->is_approved = 0;
        $pickup_request->is_declined = 0;
        $pickup_request->is_done = 0;
        $pickup_request->is_canceled= 0;
        $pickup_request->pickup_date =$request->pickup_date;
        $pickup_request->pickup_time =$request->pickup_time;
        $pickup_request->pickup_time_id =$request->pickup_time_id;
        $pickup_request->save();
        return response()->json([
            "status" => 1,
            "message" => "Request Successful"
        ]);
    }
    //Get User requests
    public function getMyRequests(){
        $user_id = auth()->user()->id;
        $requests = PickupRequest::where("user_id", $user_id)
                                ->orderBy('id', 'desc')->take(6)->get()->reverse();
        
        for($i = 0; $i < count($requests); $i++){
            $collector_id = $requests[$i]->collector_id;
            $collector[$i] = Collector::where('id', $collector_id)->get();
        }
        $results = array();
        for($i = 0; $i < count($requests); $i++){
            $results[$i]["request"] = $requests[$i];
            $results[$i]["collector"] = $collector[$i];
        }
        return json_encode($results,JSON_PRETTY_PRINT);
}
public function storeToken(Request $request)
    {   
        $id = auth()->user()->id;
        $user = User::find($id);
        $user->device_token = $request->device_token;
        $user->save();
        return response()->json(['Token successfully stored.']);
    }


public function sendNotification(Request $request)
{
    $user_id = $request->user_id;
    $firebaseTokenObj = User::where("id", $user_id)->get("device_token");
    $firebaseToken = $firebaseTokenObj[0]->device_token;
    //$firebaseToken = "eEoUZ6wZhUg:APA91bG6NxuAC-jnIB4UbQQgxNoipt-8kjuH8N_fYgq7wZPiOPyFCsQ5kE-Kgkpz0iuD37lotDuOrgTnHGudeDlnZYt54DHgiBD0mM7-fci7CdxQYtESH791ZoDgmuj8p2wV0FvjnXeZ";
    $SERVER_API_KEY = 'AAAA-TxoaWA:APA91bHIUs4v6COgAmdaqXgqpxWUiM_k2gWsaPjZlXJm6r7nCr-mUtLe3faEW7svU09AEKvLCVUM5rORqjMXOojmp6FyxCm6mQjCZW38Z11lXXFQN1bVEjO0_YSZVA43zhvUNY9vPpCq';

    $data = [
        "to" => $firebaseToken,
        "notification" => [
            "title" => $request->title,
            "body" => $request->body,  
        ]
    ];
    $dataString = json_encode($data);

    $headers = array(
        'Authorization: key=' . $SERVER_API_KEY,
        'Content-Type: application/json',
    );

    $ch = curl_init();
  
    curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
           
    $response = curl_exec($ch);
    
    if ($response === FALSE) {
        die('Curl failed: ' . curl_error($ch));
    }        

    // Close connection
    curl_close($ch);  
    dd($response);
}


    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function createNewToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => auth()->user()
        ]);
    }
    public function availableTime(Request $request){
        $date = $request->date;
        $collector_id = $request->collector_id;
        $reserved = PickupRequest::where("pickup_date", $date)
                                    ->where("is_declined", "0")
                                    ->where("collector_id",$collector_id)
                                    ->pluck("pickup_time_id");
        
        $availableTime = TimeSlot::whereNotIn("id", $reserved)->get();
        return json_encode($availableTime,JSON_PRETTY_PRINT);
    }

}