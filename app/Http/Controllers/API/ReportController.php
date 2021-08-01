<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use JWTAuth;
use Validator;
use App\Models\Report;

class ReportController extends Controller
{
    
    public function reportUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'UserId' => 'required',
            'ReportedUserId' => 'required',
        ]);

        if($validator->fails()) {
            return response()->json([
                'StatusCode' => 400,
                'Message' => $validator->messages(),
            ],400);
        }


        $already_reported_user =Report::where('UserId', $request->UserId)->where('ReportedUserId', $request->ReportedUserId)->first();
       
      
            
          if($already_reported_user){

             Report::where('UserId', $request->UserId)->where('ReportedUserId', $request->ReportedUserId)->delete();
            
            return response()->json([
            'Message' => 'User Removed from Reported List',
            'StatusCode' => 200
            ],200);
           
            } else {

                $block_user= Report::create(['UserId'=> $request->UserId,'ReportedUserId' => $request->ReportedUserId,'ReportedUserQuickBloxId'=>$request->ReportedUserQuickBloxId]);

                 return response()->json([
            'Message' => 'User Reported successfully',
            'StatusCode' => 200
        ],200);
            

               
            }  
        }



}
