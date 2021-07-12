<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\SubscriptionController;
use App\Http\Controllers\API\AdvertisementController;
use App\Http\Controllers\API\PreferenceController;
use App\Http\Controllers\API\ForgotPasswordController;
use App\Http\Controllers\API\BlocksController;




/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::get('user-profile', [AuthController::class, 'userProfile']);

    Route::get('subscriptions', [SubscriptionController::class, 'index']);
    Route::get('preferences', [PreferenceController::class, 'index']);
    Route::post('user/preference/update/{user_id}', [PreferenceController::class, 'updateUserPreference']);

    Route::post('user/update/profileVisibility/{user_id}', [AuthController::class, 'updateProfileVisibility']);

    Route::post('reset',[ForgotPasswordController::class,'reset']);
    Route::post('forgot',[ForgotPasswordController::class,'forgot']);

    Route::get('advertisements', [AdvertisementController::class, 'index']);

    Route::post('blockuser', [BlocksController::class, 'blockUser']);
    Route::get('block/users/{user_id}', [BlocksController::class, 'blockUserList']); 

    




});
