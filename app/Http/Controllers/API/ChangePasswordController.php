<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UpdatePasswordRequest;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Validator;
use Hash;
class ChangePasswordController extends Controller
{

    // public function reset(UpdatePasswordRequest $request)
    // {
    //     return $this->updatePasswordRow($request)->count() > 0 ? $this->resetPassword($request): $this->tokenNotFoundError();
    // }

    // public function updatePasswordRow($request)
    // {
    //     return DB::table('password_resets')->where([
    //         'email' => $request->email,
    //         'token' => $request->resetToken          
    //     ]);
    // }

    // public function tokenNotFoundError() {
    //     return response()->json([
    //         'error' => 'Either your email is wrong or token is wrong.'
    //     ],Response::HTTP_UNPROCESSABLE_ENTITY);
    // }


    // public function resetPassword($request) {
        
    //     $userData = User::whereEmail($request->email)->first();
    //     $userData->update([
    //         'password' => bcrypt($request->password)]);

    //     $this->updatePasswordRow($request)->delete();

    //     return response()->json([
    //         'StatusCode' => 200,
    //         'Message' => 'Password has been updated'
    //     ], 201);

    // }



     /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function changePassword(Request $request){
        $user = User::findOrFail($request->UserId);

        $validator = Validator::make( $request->all(), [
            'NewPassword' => 'required|min:6',
            'OldPassword' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'StatusCode' => 400,
                'Message' => $validator->errors()->first(),
            ]);
        }else{

            if (Hash::check($request->OldPassword, $user->Password)) { 

                $user->fill([
                    'Password' => Hash::make($request->NewPassword)
                ])->save();

                return response()->json([
                    'StatusCode' => 200,
                    'test' => $user,
                    'Message' => 'success',
                ]);
            }else{
                return response()->json([
                    'StatusCode' => 400,
                    'Message' => 'Your old password is not correct.',
                ]);
                
            }
        }
    }



}
