<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use App\Models\Role;
use App\Models\User;


class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = User::all();
        return view('admin.users.index' , ['users'=>$list]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){    
        return view ('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {    

        $rules = [
            'name' => 'required',
            'email' => 'required|unique:users',
            'gender'  => 'required',
            'location' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'timezone' => 'required',
            'password' => 'required',
            // 'avatar' => 'required'
        ];

        $validator = Validator::make($request->all(),$rules);
         // die('good');
        if ($validator->fails()) {
             // die('good');
            return redirect()->route('admin.user.create')
            ->withInput()
            ->withErrors($validator);
        }else{
               
            $postdata = $request->input();

            $insertdata = [
                'name'=> $postdata['name'],
                'email' => $postdata['email'],
                'gender'  => $postdata['gender'],
                'location' => $postdata['location'],
                'latitude' => $postdata['latitude'],
                'longitude' => $postdata['longitude'],
                'timezone' => $postdata['timezone'],
                'password' => bcrypt($postdata['password'])
                // 'avatar' =>  $data['avatar']
            ];

               if ($request->hasFile('avatar')) 
               {
                    $image = $request->file('avatar');
                    $name = time().'.'.$image->getClientOriginalExtension();
                    $image->move(public_path('users'), $name);
                    $insertdata['avatar'] = $name;
               }

               // dd($data);
            
            $users = User::create($insertdata);
             return redirect()->route('admin.user.create')->with('success',"Insert successfully");
         

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        if (!empty($user->id)){
            return view('admin.users.show', ['user' => $user]);
        }else{
            return redirect()->route('admin.users')->with('error' , "Record not found");
        
        }
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
        $user = User::find($id);
        
       if ( !empty($user->id) ) {
            $user->delete();
           return redirect()->route('admin.users')->with('success', "Record deleted successfully");
        } 
        else{
            return redirect()->route('admin.users')->with('error' , "Record not deleted");
        }
    }

    public function active(Request $request)
    { 
         $data = $request->all();
         $id = $data['id'];
          // print_r($id);die();
       
    }

     public function verified(Request $request)
    { 
         $verify = $request->all();
         $id = $verify['id'];
          // print_r($id);die();
       
    }


     public function approved(Request $request)
    { 
         $approve = $request->all();
         $id = $approve['id'];
          print_r($id);die();
       
    }    
}
