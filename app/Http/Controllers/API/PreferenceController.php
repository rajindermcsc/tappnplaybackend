<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Preference;
use App\Models\User;

class PreferenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $preferences= Preference::all();
        return response()->json([
            'StatusCode' => 200,
            'Message' => 'Preferences Listed successfully',
            'preferences' => $preferences
        ], 201);
    }


    public function updateUserPreference(Request $request){
        if(Auth::check()){
            $user_id = auth()->user();
            $user = User::find($user_id);

            if( !empty($request->preferences) ){
                $user->preferences()->sync($request->preferences);
                $userpreference = $user->preferences;
                return response()->json([
                    'StatusCode' => 200,
                    'Message' => 'Preferences updated successfully',
                    'preferences' => $userpreference,
                    'user' => $user,
                ], 200);
            }else{
                return response()->json([
                    'StatusCode' => 422,
                    'Message' => 'Preferences unable to update'
                ], 422);
            }
        }else{
            return response()->json([
                'StatusCode' => 401,
                'Message' => 'Unauthenticated',
            ], 400);
        }
        
    }

    
}
