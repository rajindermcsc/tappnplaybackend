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
            'user_id' => 'required',
            'block_user_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['success'=> false, 'error'=> $validator->messages()], 401);
        }


        $already_block_user =Block::where('user_id' ,'=',$request->user_id)->where('block_user_id' ,'=',$request->block_user_id)->first();
      
            
          if(!$already_block_user)

            {
                
        $block_user= Block::create(['user_id'=> $request->user_id,
          'block_user_id' => $request->block_user_id]);
            
            return response()->json([
            'message' => 'User Blocked successfully'], 201);
           
            }
            else
            {

             return response()->json([
            'message' => 'User Already Blocked '], 201);
            
            }  
        }



        public function blockUserList($user_id) {
            // $user = JWTAuth::toUser($token);

            // $user_id= JWTAuth::parseToken()->authenticate()->id;
            // $user_id= Auth::user();
            // dd($user_id);   
            $block=Block::with('blockusers')->where('user_id',$user_id)->get();

            return response()->json([
                'status' => true,
                'message' => 'Block User Listed Succesfully',
                'block' => $block,
            ], 201);

        }


    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
