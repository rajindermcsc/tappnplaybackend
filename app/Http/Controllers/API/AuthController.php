<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Validator;
use JWTAuth;
use App\Models\Preference;

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
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json(['success'=> false, 'error'=> $validator->messages()], 401);
        }


        $token = auth('api')->attempt($validator->validated());
        $user = User::where(['email'=>$request->email ])->first();
        // if you reached here then user has been authenticated
        if (empty($user->IsUserAccountApproved))
        {
            return response()->json(['error' => 'Your account is not verified. Please contact to administrator.'], 401);
        }

        if ( !$token ) {
            return response()->json(['success' => false, 'error' => 'We cant find an account with this credentials. Please make sure you entered the right information and you have verified your email address.'], 404);
        }

        return $this->createNewToken($token);
    }

    /**
     * Register a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|confirmed|min:6',
            'gender' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['success'=> false, 'error'=> $validator->messages()], 401);
        }

        $user = User::create([
            'name'=> $request->name,
            'email' => $request->email,
            'gender'  => $request->gender,
            'location' => $request->location,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'timezone' => $request->timezone,
            'password' => bcrypt($request->password),
            'role_id' => $request->role_id,
            'avatar' => $request->avatar,
            'IsActive' => $request->IsActive,
            'IsApproved' => $request->IsApproved,
            'IsUserAccountApproved' => $request->IsUserAccountApproved,
            'terms_check' => $request->terms_check
        ]);

        if( !empty($request->preferences) ){
            $user->preferences()->sync($request->preferences);
        }

        return response()->json([
            'status' => true,
            'message' => 'User successfully registered',
            'user' => $user
        ], 200);
    }


    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout() {
        auth()->logout();
        return response()->json(['status' => true, 'message' => 'User successfully signed out']);
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
        return response()->json(auth()->user());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function createNewToken($token){
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60,
            'user' => auth('api')->user()
        ]);
    }


    public function updateProfileVisibility(Request $request, $user_id){
        $user = User::find($user_id);
        $user->IsProfileVisible = $request->IsProfileVisible;
        return response()->json([
            'status' => true,
            'message' => 'Profile visibility is updated now',
            'user' => $user,
        ], 201);
    }

    

}
