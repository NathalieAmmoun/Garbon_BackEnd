<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Collector;
use App\Models\CollectorRecycle;
use App\Models\Recyclable;
use App\Models\Address;
use App\Models\PickupRequest;
use DB;

class CollectorController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth:api',['except'=>['displayCollectors']]);
    }
    public function addCollector(Request $request)
    {
    $request->validate([
        "name" => "required",
        "description" => "required"]);
    $collector = new Collector();
    $collector->name = $request->name;
    $collector->description = $request->description;
    $collector->user_id = auth()->user()->id;
    $collector->is_approved=0;
    $collector->save();
    return response()->json([
        "status" => 1,
        "message" => "Collector added successfully"
    ]);
    }
    public function editCollectorProfile(Request $request)
    {
        $user_id = auth()->user()->id;
        $collector = Collector::where("user_id", $user_id)->first();
        $collector->name = $request->name;
        $collector->description = $request->description;
        $collector->save();
        return response()->json([
            "status" => 1,
            "message" => "Collector profile edited successfully"
        ]);
    }
    public function addRecyclable(Request $request){
    $recyclable_id = $request->recyclable_id;
    $user_id = auth()->user()->id;
    $collector= Collector::where('user_id', $user_id)->get("id");
    $collector_id = $collector[0]->id;
    $collector_recycles = new CollectorRecycle();
    $collector_recycles->collector_id = $collector_id;
    $collector_recycles->recyclable_id = $recyclable_id;
    $collector_recycles->save();
    return response()->json([
        "status" => 1,
        "message" => "Collector Recyclables added successfully"]);
}   
    public function getRecyclables(){
        $recyclables= Recyclable::all();
        return json_encode($recyclables,JSON_PRETTY_PRINT);
}  
    //Display all approved collectors in database
    public function displayCollectors(){
        $collectors = Collector::where("is_approved",1)->get();
        $collector_recycles = array();
        for($i = 0; $i < count($collectors); $i++){
            $id = $collectors[$i]->id;
            $collector_recycles[$i]= CollectorRecycle::where('collector_id',$id)->get();                                    
        }
       
        $recyclables = array();
        for($j = 0; $j < count($collector_recycles); $j++){
            for($k=0; $k<count($collector_recycles[$j]); $k++){
                $id = $collector_recycles[$j][$k]->recyclable_id;
                $recyclables[$j][$k] = Recyclable::where("id", $id)->get();
                 }  
        }
        $results = array();
        for($i = 0; $i < count($collectors); $i++){
            $results[$i]["collectors"] = $collectors[$i];
            if ($recyclables){
            $results[$i]["recyclables"] = $recyclables[$i];}                             
        }
         return json_encode($results,JSON_PRETTY_PRINT);                
    }
    public function deleteRecyclable(Request $request){
        $recyclable_id = $request->recyclable_id;
    
        $recyclable =CollectorRecycle::where("recyclable_id",$recyclable_id);
        $recyclable->delete();
        return response()->json([
            'status' => true,
            'message' => 'Recyclable deleted successfully',
            'recyclable' => $recyclable
        ], 201);
    }
    public function getUnapprovedCollectors(){
        $collectors = Collector::where("is_approved",0)->get();
        $collector_recycles = array();
        for($i = 0; $i < count($collectors); $i++){
            $id = $collectors[$i]->id;
            $collector_recycles[$i]= CollectorRecycle::where('collector_id',$id)->get();                                    
        }
        $recyclables = array();
        for($j = 0; $j < count($collector_recycles); $j++){
            for($k=0; $k<count($collector_recycles[$j]); $k++){
                $id = $collector_recycles[$j][$k]->recyclable_id;
                $recyclables[$j][$k] = Recyclable::where("id", $id)->get();
                 }  
        }
        $results = array();
        for($i = 0; $i < count($collectors); $i++){
            $results[$i]["collectors"] = $collectors[$i];
            $results[$i]["recyclables"] = $recyclables[$i];}                             
         return json_encode($results,JSON_PRETTY_PRINT);  
    } 
    public function getUnapprovedRequests(){
        $user_id = auth()->user()->id;
        $collector= Collector::where("user_id", $user_id)->get("id");
        $collector_id= $collector[0]->id;
        $requests = PickupRequest::where("collector_id", $collector_id)
                                ->where('is_approved', 0)
                                ->where('is_declined',0)
                                ->where('is_done',0)
                                ->where('is_canceled', 0)->get();
        for($i = 0; $i < count($requests); $i++){
            $user_id = $requests[$i]->user_id;
            $user[$i] = User::where('id', $user_id)->get(["id", "first_name", "last_name"]);
            $address[$i] = Address::where('user_id', $user_id)->get();
    }
    $results = array();
    for($i = 0; $i < count($requests); $i++){
        $results[$i]["request"] = $requests[$i];
        $results[$i]["user"] = $user[$i];
        $results[$i]['address'] = $address[$i];
    }
    return json_encode($results,JSON_PRETTY_PRINT);

}   
public function getApprovedRequests(){
    
    $user_id = auth()->user()->id;
    $collector= Collector::where("user_id", $user_id)->get("id");
    $collector_id= $collector[0]->id;
    $requests = PickupRequest::where("collector_id", $collector_id)
                            ->where('is_approved', 1)
                            ->where('is_declined',0)->get();
    for($i = 0; $i < count($requests); $i++){
        $user_id = $requests[$i]->user_id;
        $user[$i] = User::where('id', $user_id)->get(["id", "first_name", "last_name"]);
        $address[$i] = Address::where('user_id', $user_id)->get();
}
$results = array();
for($i = 0; $i < count($requests); $i++){
    $results[$i]["request"] = $requests[$i];
    $results[$i]["user"] = $user[$i];
    $results[$i]['address'] = $address[$i];
}
return json_encode($results,JSON_PRETTY_PRINT);

}   

public function approveRequest(Request $request){
    $request_id = $request->request_id;
    $pickup_request = PickupRequest::find($request_id);
    $pickup_request->is_approved = 1;
    $pickup_request->is_declined = 0;
    $pickup_request->save();
    return response()->json([
        'status' => true,
        'message' => 'Collector successfully approved Request',
    ], 201);
}

public function declineRequest(Request $request){
    $request_id = $request->request_id;
    $pickup_request = PickupRequest::find($request_id);
    $pickup_request->is_approved = 0;
    $pickup_request->is_declined = 1;
    $pickup_request->save();
    return response()->json([
        'status' => true,
        'message' => 'Collector declined Request',
    ], 201);
}

public function eventDone(Request $request){
    $request_id = $request->request_id;
    $pickup_request = PickupRequest::find($request_id);
    $pickup_request->is_done = 1;
    $pickup_request->save();
    return response()->json([
        'status' => true,
        'message' => 'Event successfully Done',
    ], 201);
}

public function eventCancel(Request $request){
    $request_id = $request->request_id;
    $pickup_request = PickupRequest::find($request_id);
    $pickup_request->is_approved = 0;
    $pickup_request->is_canceled = 1;
    $pickup_request->save();
    return response()->json([
        'status' => true,
        'message' => 'Event successfully cancel',
    ], 201);
}

public function eventChange(Request $request){
    $request_id= $request->request_id;
    $pickup_request = PickupRequest::find($request_id);
    $pickup_request->pickup_date = $request->pickup_date;
    $pickup_request->pickup_time =$request->pickup_time;
    $pickup_request->save();
    return response()->json([
        'status' => true,
        'message' => 'Event successfully changed',
    ], 201);
}

public function analytics()
    {
        $recyclers = PickupRequest::select(
                            
                            DB::raw("(sum(user_id)) as total_users"),
                            DB::raw("(DATE_FORMAT(pickup_date, '%m-%Y')) as month_year")
                            )
                            ->orderBy('pickup_date')
                            ->groupBy(DB::raw("DATE_FORMAT(pickup_date, '%m-%Y')"), "user_id")
                            ->get();
  
        return json_encode($recyclers,JSON_PRETTY_PRINT);
    }
}