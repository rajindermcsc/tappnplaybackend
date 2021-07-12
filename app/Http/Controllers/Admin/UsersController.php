<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use App\Models\Role;
use App\Models\User;
use App\Models\Photo;

    
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
            'terms_check' => 'required'
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
                'password' => bcrypt($postdata['password']),
                'terms_check' =>  $postdata['terms_check']
            ];

           if ($request->hasFile('avatar')){
                $image = $request->file('avatar');
                $name = time().'.'.$image->getClientOriginalExtension();
                $image->move(public_path('users'), $name);
                $insertdata['avatar'] = $name;
           }

            
            $user = User::create($insertdata);


            if ($request->hasFile('photos')){
                $photos = $request->file('photos');
                $path = public_path('uploads/users');
                foreach( $photos as  $photo ){
                    $filename = time().$photo->getClientOriginalName();
                    $photo->move($path, $filename);
                    $photodata['user_id'] = $user->id;
                    $photodata['standard'] = $filename;
                    $photodata['is_private'] = 0;
                    Photo::create($photodata);
                }
            }

            if ($request->hasFile('private_photos')){
                $private_photos = $request->file('private_photos');
                $path = public_path('uploads/users');
                foreach( $private_photos as  $photo ){
                    $filename = time().$photo->getClientOriginalName();
                    $photo->move($path, $filename);
                    $privatephotodata['user_id'] = $user->id;
                    $privatephotodata['standard'] = $filename;
                    $privatephotodata['is_private'] = 1;
                    Photo::create($privatephotodata);
                }
            }

            
            return redirect()->route('admin.users')->with('success',"User created successfully!");
         
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

    public function IsActive(Request $request){ 
        $user_id = $request->user_id;
        $user = User::where('id', $user_id)->first();
        if($user->IsActive == 1 ){
            $IsActive = 0;
            $user->update([ 'IsActive'=> $IsActive ]);
        return response()->json(['status'=>$IsActive, 'message'=>'User is Deactivated successfully.','user'=>$user ]);

        }else{
            $IsActive = 1;
            $user->update([ 'IsActive'=> $IsActive ]);
        return response()->json(['status'=>$IsActive, 'message'=>'User is Activated successfully.','user'=>$user ]);
            
        }

        
    }

    public function IsVerified(Request $request){ 
        $user_id = $request->user_id;
        $user = User::where('id', $user_id)->first();
        if($user->IsProfileVerified == 1 ){
            $IsProfileVerified = 0;
            $user->update([ 'IsProfileVerified'=> $IsProfileVerified ]);
        return response()->json(['status'=>$IsProfileVerified, 'message'=>'User is UnVerified successfully.','user'=>$user ]);

        }else{
            $IsProfileVerified = 1;
            $user->update([ 'IsProfileVerified'=> $IsProfileVerified ]);
        return response()->json(['status'=>$IsProfileVerified, 'message'=>'User is Verified successfully.','user'=>$user ]);
            
        }
       
    }


    public function IsApproved(Request $request){ 
         $user_id = $request->user_id;

         $user = User::where('id', $user_id)->first();
        if($user->IsApproved == 1 ){
            $IsApproved = 0;
            $user->update([ 'IsApproved'=> $IsApproved ]);
        return response()->json(['status'=>$IsApproved, 'message'=>'User is UnApproved successfully.','user'=>$user ]);

        }else{  
            $IsApproved = 1;
            $user->update([ 'IsApproved'=> $IsApproved ]);
        return response()->json(['status'=>$IsApproved, 'message'=>'User is Approved successfully.','user'=>$user ]);
            
        }
       
    }    
}
