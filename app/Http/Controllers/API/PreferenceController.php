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
            'message' => 'Preferences Listed successfully',
            'preferences' => $preferences
        ], 201);
    }


    public function updateUserPreference(Request $request, $user_id){
        $user = User::find($user_id);

        if( !empty($request->preferences) ){
            $user->preferences()->sync($request->preferences);
            $userpreference = $user->preferences;
            return response()->json([
                'status' => true,
                'message' => 'Preferences updated successfully',
                'preferences' => $userpreference,
                'user' => $user,
            ], 201);
        }else{
            return response()->json([
                'status' => false,
                'error' => 'Preferences unable to update'
            ], 400);
        }

        
    }

    
}
