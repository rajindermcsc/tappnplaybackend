<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Auth;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;



    /**
     * Change Password Form.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){
        return view('auth.passwords.change');
    } 


    /**
     * Update Password.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function store(Request $request){
        $user = User::findOrFail(auth()->user()->id);

        $request->validate([
            'current_password' => ['required'],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);

        if (Hash::check($request->current_password, $user->password)) { 
           $user->fill([
            'password' => Hash::make($request->new_password)
            ])->save();

            $msg = 'Password changed successfully.';
            if($user->role == 'Attendee') return redirect()->back()->with('msg_success', $msg );
            return redirect()->route('change-password')->with('msg_success', $msg);
        } else {
            $msg = 'Your current password is not correct.';
            
            if($user->role == 'Attendee') return redirect()->back()->with('msg_error', $msg );
            return redirect()->route('change-password')->with('msg_error', $msg);
        }

    }


    public function reset(Request $request){
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $user = User::where( 'email', $request->email )->first();

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) use ($request) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->save();
                $user->setRememberToken(Str::random(60));

                event(new PasswordReset($user));

            }
        );

        return $status == Password::PASSWORD_RESET
            ? Auth::login($user)
            ?? redirect()->route('login')->with('status', __($status))
            :back()->withErrors(['email' => [__($status)]]);

        }


}
