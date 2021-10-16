<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Business;
use App\Models\Industry;


class BusinessController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    public function addBusiness(Request $request)
    {
    $request->validate([
        "name" => "required",
        "description" => "required",
        "industry_id" => "required"]);
        
        $business = new Business();
        $business->name = $request->name;
        $business->industry_id = $request->industry_id;
        $business->description = $request->description;
        $business->user_id = auth()->user()->id;
        $business->save();
        return response()->json([
            "status" => 1,
            "message" => "Business added successfully"
        ]);
    }
    public function editBusiness(Request $request)
    {   $user_id = auth()->user()->id;
        $business = Business::where("user_id", $user_id);
        $business->name = $request->name;
        $business->industry_id = $request->industry_id;
        $business->description = $request->description;
        $business->save();
        return response()->json([
            "status" => 1,
            "message" => "Business added successfully"
        ]);
    }
}
