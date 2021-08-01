<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Mail\SendMailreset;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ResetPasswordRequest;
use Illuminate\Support\Facades\Password;
use App\Models\User;
use Validator;


class ForgotPasswordController extends Controller
{
    public function forgot(Request $request)
{
if(!$this->validateEmail($request->email)) {
return $this->failedResponse();

}
$this->send($request->email);
return $this->successResponse();

}

public function send($email)
{
    $token= $this->createToken($email);
    Mail::to($email)->send(new SendMailreset($token,$email));
}

public function createToken($email)
{
$oldToken=DB::table('password_resets')->where('email',$email)->first();
    
    if($oldToken){
        return $oldToken->token;
    }
$token= Str::random(40);
$this->saveToken($token,$email);
return $token;

}

public function saveToken($token,$email) 
{
    DB::table('password_resets')->insert([
        'email' =>$email,
        'token' =>$token,
        'created_at' =>Carbon::now()
    ]);

}

public function validateEmail($email)
{
    return !!User::where('email',$email)->first();
}

public function failedResponse()
{
    return response()->json([
        'error'=>'Email does\'t found on our database'    ],Response::HTTP_NOT_FOUND);
}

public function successResponse(){
    return response()->json([
        'data'=>'Reset Email is send succcessfully, pleasse check your inbox' ],Response::HTTP_OK);
}


}
