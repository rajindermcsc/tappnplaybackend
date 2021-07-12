<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Subscription;
use Validator;

class SubscriptionController extends Controller
{
    
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */


    public function index()
    {

        $subscriptions= Subscription::all();
        return response()->json([
            'message' => 'Subscriptions Listed successfully',
            'subscriptions' => $subscriptions
        ], 201);

        
    }
    

}
