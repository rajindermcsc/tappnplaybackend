<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Advertisement;
use Validator;

class AdvertisementController extends Controller
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

    $advertisements= Advertisement::all();

          return response()->json([
            'Message' => 'success',
            'StatusCode' => '200',
            'Advertisements'=>$advertisements,
            
          ]);
    }

}
