<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Address;

class AddressController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    public function addAddress(Request $request)
    {
        // validation
        $request->validate([
            "city" => "required",
            "street" => "required",
            "bldg" => "required",
            "floor" => "required",
        ]);
        $address = new Address;
        $address->city = $request->city;
        $address->street= $request->street;
        $address->bldg = $request->bldg;
        $address->floor = $request->floor;
        $address->user_id = auth()->user()->id;
        $address->save();
        return response()->json([
            "status" => 1,
            "message" => "Address added successfully"
        ]);
    }
    public function editAddress(Request $request)
    {   
        $user_id =  auth()->user()->id;
        $address = Address::where("user_id", $user_id);
        $address->city = $request->city;
        $address->street= $request->street;
        $address->bldg = $request->bldg;
        $address->floor = $request->floor;
        $address->save();
        return response()->json([
            "status" => 1,
            "message" => "Address added successfully"
        ]);
    }
}
