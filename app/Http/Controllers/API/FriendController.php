<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Friend;
use App\Models\User;
use Auth;

class FriendController extends Controller{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getFriends(Request $request)
    {
        if(Auth::check()){
            $user_id = $request->UserId;
            // dd($user_id);die;
            $user_id = auth()->user()->id;

            $user = User::with('friends','friends.user')->where('id', $user_id)->first();
            $users = array();
            foreach( $user->friends as $friends ){
                $users[] = $friends->user;
            }

            if( !empty($users) ){
                foreach( $users as $key => $usr ){
                    $users[$key]->FriendStatus = 'friend';
                }     
            }
           

            // print_r($users);die();

            // dd($users);die;

            if($user->id){
                return response()->json([
                    'StatusCode' => 200,
                    'Message' => 'success',
                    'Users' => isset($users)?$users:[]
                ], 200);
            }else{
                return response()->json([
                    'StatusCode' => 404,
                    'Message' => 'There are no friend list found.',
                ], 404);
            } 
        }else{
            return response()->json([
                'StatusCode' => 401,
                'Message' => 'Unauthenticated',
            ], 400);
        }
        
    }




    public function sendFriendRequest(Request $request){

        if(Auth::check()){
            $data = array(
                'UserId' =>$request->UserId,
                'FriendUserId' =>$request->ProfileUserId,
                'CreatedByUserId' =>$request->UserId
            );

            $friendexist = Friend::where(['UserId'=>$request->UserId,'FriendUserId'=>$request->ProfileUserId])->first();

            if( empty($friendexist->id) ){
                $friend = Friend::create($data);
                if( !empty($friend->id) ){
                    return response()->json([
                        'StatusCode' => 200,
                        'Message' => 'success'
                    ], 200);
                }else{
                    return response()->json([
                        'StatusCode' => 422,
                        'Message' => 'Something went wrong!',
                    ], 422);
                } 
            }else{
                return response()->json([
                    'StatusCode' => 300,
                    'Message' => 'Both the users are already friends!',
                ]);
            }

            
        }else{
            return response()->json([
                'StatusCode' => 401,
                'Message' => 'Unauthenticated',
            ], 401);
        }
    }





     public function unfriendRequest(Request $request){

        if(Auth::check()){
            $data = array(
                'UserId' =>$request->UserId,
                'FriendUserId' =>$request->ProfileUserId
            );

            $friendexist = Friend::where(['UserId'=>$request->UserId,'FriendUserId'=>$request->ProfileUserId])->first();

            if( !empty($friendexist->id) ){
                if( $friendexist->delete() ){
                    return response()->json([
                        'StatusCode' => 200,
                        'Message' => 'success'
                    ], 200);
                }
            }else{
                return response()->json([
                    'StatusCode' => 400,
                    'Message' => 'Bad request, both users are not friend.',
                ]);
            }

            
        }else{
            return response()->json([
                'StatusCode' => 401,
                'Message' => 'Unauthenticated',
            ], 401);
        }
    }




    public function acceptDeclineRequest(Request $request){
        if(Auth::check()){

            $friendexist = Friend::where(['UserId'=>$request->UserId,'FriendUserId'=>$request->ProfileUserId])->first();

            if( !empty($friendexist->id) ){
                
                $friendexist->update(['Status'=>$request->ActionName]);
                return response()->json([
                    'StatusCode' => 200,
                    'Message' => 'success'
                ], 200);
            }else{
                return response()->json([
                    'StatusCode' => 400,
                    'Message' => 'Bad request, both users are not friend.',
                ]);
            }

            
        }else{
            return response()->json([
                'StatusCode' => 401,
                'Message' => 'Unauthenticated',
            ], 401);
        }
    }




    public function withdrawRequest(Request $request){
        if(Auth::check()){
            $friendexist = Friend::where(['UserId'=>$request->UserId,'FriendUserId'=>$request->ProfileUserId])->first();

            if( !empty($friendexist->id) ){
                
                $friendexist->update(['Status'=>$request->ActionName]);
                return response()->json([
                    'StatusCode' => 200,
                    'Message' => 'success'
                ], 200);
            }else{
                return response()->json([
                    'StatusCode' => 400,
                    'Message' => 'Bad request, both users are not friend.',
                ]);
            }

            
        }else{
            return response()->json([
                'StatusCode' => 401,
                'Message' => 'Unauthenticated',
            ], 401);
        }
    }




    public function GetRequests(Request $request){
        if(Auth::check()){
            $frndrec = Friend::with('received')->where(['FriendUserId'=>$request->UserId])->get();
            $frndsent = Friend::with('sent')->where(['UserId'=>$request->UserId])->get();


            $received_arr = array();
            if( $frndrec ){
                foreach($frndrec as $rec){
                    $received_arr[] = $rec->received;
                }
            }

            $sent_arr = array();
            if( $frndsent ){
                foreach($frndsent as $sen){
                    $sent_arr[] = $sen->sent;
                }
            }

            return response()->json([
                'StatusCode' => 200,
                'Message' => 'success',
                'Received' => $received_arr,
                'Sent' => $sent_arr
            ], 200);
            

            
        }else{
            return response()->json([
                'StatusCode' => 401,
                'Message' => 'Unauthenticated',
            ], 401);
        }
    }





}
