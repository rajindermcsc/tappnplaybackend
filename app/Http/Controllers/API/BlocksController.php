<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Block;
use Illuminate\Support\Facades\Auth;
use JWTAuth;
use Validator;

class BlocksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function blockUser(Request $request)
    {

        $validator = Validator::make($request->all(), [
            
            'BlockedUserId' => 'required',
            'UserId' => 'required',

        ]);


        if($validator->fails()) {
            return response()->json([
                'StatusCode' => 400,
                'Message' => $validator->messages(),
            ]);
        }


        $already_block_user =Block::where('UserId' ,'=',$request->UserId)->where('BlockedUserId' ,'=',$request->BlockedUserId)->first();
      
            
          if($already_block_user)

            {
            Block::where('UserId' ,'=',$request->UserId)->where('BlockedUserId' ,'=',$request->BlockedUserId)->delete();

                return response()->json([
            'Message' => 'User Unblocked Successfully',
            'StatusCode' => 200
        ]);


         }
            else
            {

            
        $block_user= Block::create(['UserId'=> $request->UserId,
          'BlockedUserId' => $request->BlockedUserId,'BlockedUserQuickBloxId'=> $request->BlockedUserQuickBloxId]);
            

            return response()->json([
            'Message' => 'User Blocked successfully',
            'StatusCode' => 200
        ]);
           
            
           
            }


        }


     


        public function blockUserList() {
            if( Auth::check() ){
                $user_id = auth()->user()->id;
                // $block = User::with('user')->where('user_id',$user_id)->get();
                $block = Block::where('user_id',$user_id)->get();

                return response()->json([
                    'data' =>$block,
                    'StatusCode' => 200,
                    'Message' => 'Block User Listed Succesfully'
                ]);
            }else{
                return response()->json([
                    'StatusCode' => 401,
                    'Message' => 'Unauthorized'
                ]);
            }
        }


   
}
