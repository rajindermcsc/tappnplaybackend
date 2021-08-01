<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Validator;
use Session;
use JWTAuth;
use App\Models\Preference;
use App\Models\Setting;
use App\Models\UserSubscription;
use App\Models\Photo;
use App\Models\UserDevice;

class AuthController extends Controller
{
    
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct() {

        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request){

        $validator = Validator::make($request->all(), [
            'Email' => 'required|email',
            'Password' => 'required|string|min:6',
        ]);

        
        if ($validator->fails()) {
            return response()->json([
                'Message' =>  $validator->messages(),
                'StatusCode' => '200' ]);
        }


        $token = auth('api')->attempt(['email'=>$request->Email,'password'=>$request->Password]);

        
        $user = User::where(['Email'=>$request->Email ])->first();
         
        // if you reached here then user has been authenticated
        if (empty($user->IsUserAccountApproved)){
            return response()->json(['data'=>'','StatusCode' => 422, 'Message'=>'Your account is not verified. Please contact to administrator.','user' =>'']);
        }

        if ( !$token ) {
            return response()->json(['data'=>'','StatusCode' => 404,'Message' => 'We cant find an account with this credentials. Please make sure you entered the right information and you have verified your email address.','user' =>'']);
        }
        
        $response = $this->createNewToken($token);
        return $response;
    }

    /**
     * Register a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request) {
        $message = [
            'Email.unique' => 'It looks like you&rsquo;ve already registered. Please try logging in with your email and password.',
            'ProfilePicture.required' => 'Profile Picture required!',
        ];

        $validator = Validator::make($request->all(), [
            'Name' => 'required|string|between:2,100',
            'Email' => 'required|string|email|max:100|unique:users',
            'Password' => 'required|string|min:6',
            'JoiningAs' => 'required',
            'ProfilePicture' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['StatusCode'=> 400, 'Message'=>  $validator->errors()->first(),'User' =>'']);
        }

        $insertdata = [
            'Name'=> $request->Name,
            'Email' => $request->Email,
            'JoiningAs'  => $request->JoiningAs,
            'Location' => isset($request->Location)?$request->Location:'',
            'Latitude' => isset($request->Latitude)?$request->Latitude:'',
            'Longitude' => isset($request->Longitude)?$request->Longitude:'',
            'Timezone' => $request->Timezone,
            'Password' => bcrypt($request->Password),
            // 'role_id' => $request->role_id,
            'IsActive' => $request->IsActive,
            'IsApproved' => $request->IsApproved,
            'IsUserAccountApproved' => $request->IsUserAccountApproved,
            'QuickBloxId' => $request->QuickBloxId,
            'terms_check' => $request->terms_check
        ];




        if($request->hasFile('ProfilePicture')) {
            
            $avatar = $request->file('ProfilePicture'); 

            $path = public_path('uploads/users');
            $filename = time().$avatar->getClientOriginalName();
            $avatar->move($path, $filename);
            $insertdata['ProfilePicture'] = asset('uploads/users/'.$filename);
        }


        // dd($insertdata);

        $user = User::create($insertdata);


        if( !empty($user->id) && !empty($request->DeviceId) ){
            $devicedata = array(
                'UserId' => $user->id,
                'DeviceType' => $request->DeviceType,
                'DeviceId' => $request->DeviceId
            );
            // dd($devicedata);
            UserDevice::create($devicedata);
        }


        if( !empty($user->id) && !empty($request->Preference) ){
            $preferences = explode(",", $request->Preference );
            $user->preferences()->sync($preferences);
        }

        $pref_ids = array();
        if(isset($user->preferences)) {
            foreach ($user->preferences as $key => $pref) {
                $pref_ids[] = $pref->id;
            }
        }


        $user = User::where('id', $user->id)->first();

        if( !empty($pref_ids) ){
            $user->Preference = implode(',', $pref_ids);
        }

        return response()->json([
            'StatusCode' => 200,
            'Message' => 'User successfully registered',
            'User' => $user,
            // 'Preference' => !empty($pref_ids)?implode(',', $pref_ids):null,
            'Setting' => isset($user->settings)?$user->settings:null,
            'Photo' => isset($user->photos)?$user->photos:null,
            'PrivatePhoto' => isset($user->privatephotos)?$user->privatephotos:null,
        ], 200);
    }


    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request) {

        try {
            $user_details = JWTAuth::parseToken()->authenticate();
        }
        catch (\Exception $e) {
            return response()->json([
                'StatusCode' => 401,
                'Message' => "Invalid token",
            ]);
        }

        JWTAuth::invalidate($request->token);
        Session::flush();

        return response()->json([
            'data'=>'',
            'StatusCode' => 200,
            'status_message' => "Logout Successfully",
            'user'=>''

        ]);

    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh() {
        return $this->createNewToken(auth()->refresh());
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function userProfile() {

        $id=auth()->user()->id;
        $user= User::with(['settings','devices','subscriptions','photos','privatephotos'])->where('id','=',$id)->first();
        return response()->json(
            [
            'Message' => 'success',
            'StatusCode' => '200',
            'user' => $user ]);
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function createNewToken($token){
        $id = auth('api')->user()->id;
        $user = User::where('id', $id)->first();
        /*$user= User::with(['settings','devices','subscriptions','photos','privatephotos'])->where('id','=',$id)->first();
        return response()->json(
            [
            'data'=>[
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
            ],    
            'Message' => 'success',
            'StatusCode' => '200',
            'User' => $user ]);*/ 

            $pref_ids = array();
        if(isset($user->preferences)) {
            foreach ($user->preferences as $key => $pref) {
                $pref_ids[] = $pref->id;
            }
        }


        //$user = User::where('id', $user->id)->first();

        if( !empty($pref_ids) ){
            $user->Preference = implode(',', $pref_ids);
        }

        return response()->json([
            'data'=>[
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
            ],    
            'StatusCode' => 200,
            'Message' => 'User successfully Logged In',
            'User' => $user,
            //'Preference' =>isset($user->prefences)?$user->prefences:null,
            'Setting' => isset($user->settings)?$user->settings:null,
            'Photo' => isset($user->photos)?$user->photos:null,
            'PrivatePhoto' => isset($user->privatephotos)?$user->privatephotos:null,
        ], 200);

        /*return response()->json([
            'data'=>[
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
            ],
            'Message' => 'success',
            'StatusCode' => '200',
            'Photo' =>[],
            'PrivatePhoto' =>[],
            'Setting' =>[],
            'user' => $user
        ]);*/
    }


    public function updateProfileVisibility(Request $request){
        if(Auth::check()){
            // $user_id = auth()->user();
            $user = User::find($request->UserId);
            $user->ProfileVisibilityEnabled = $request->ProfileVisibilityEnabled;
            return response()->json([
                'StatusCode' => 200,
                'Message' => 'success',
                'User' => $user,
            ]);
        }else{
            return response()->json([
                'StatusCode' => 401,
                'Message' => 'Unauthenticated',
                'User' =>'',
            ]);
        }
    }


    public function updateLocationVisibility(Request $request){
        if(Auth::check()){
            // $user_id = auth()->user();
            $user = User::find($request->UserId);
            $user->LocationVisibilityEnabled = $request->LocationVisibilityEnabled;
            return response()->json([
                'StatusCode' => 200,
                'Message' => 'success',
                'User' => $user,
            ]);
        }else{
            return response()->json([
                'StatusCode' => 401,
                'Message' => 'Unauthenticated',
                'User' =>'',
            ]);
        }
    }




    public function updateLocation(Request $request){
        if(Auth::check()){
            $validator = Validator::make($request->all(), [
            'Location' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'UserId' => 'required'
        ]);

        
        if ($validator->fails()) {
            return response()->json([
                'Message' =>  $validator->messages(),
                'StatusCode' => '400' ],400);
        }

            $UserId = $request->UserId;
            $user = User::find($UserId);
            $user->Location = $request->Location;
            $user->Latitude = $request->latitude;
            $user->Longitude = $request->longitude;
            $user->save();

            return response()->json([
                'StatusCode' => 200,
                'Message' => 'Location Updated Successfully',
                'User' => $user,
            ]);
        }else{
            return response()->json([
                'StatusCode' => 401,
                'Message' => 'Unauthenticated',
                'User' =>'',
            ]);
        }
    }




    

    

}
