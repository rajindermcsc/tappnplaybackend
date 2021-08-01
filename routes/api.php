<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\SubscriptionController;
use App\Http\Controllers\API\AdvertisementController;
use App\Http\Controllers\API\PreferenceController;
use App\Http\Controllers\API\ForgotPasswordController;
use App\Http\Controllers\API\BlocksController;
use App\Http\Controllers\API\ChangePasswordController;
use App\Http\Controllers\API\ReportController;
use App\Http\Controllers\API\FriendController;
use App\Http\Controllers\API\PhotoController;




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
    

Route::group(['middleware' => 'api','prefix' => 'auth'], function ($router) {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
});


Route::group([
    'middleware' => 'auth:api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::get('user-profile', [AuthController::class, 'userProfile']);
    Route::post('changePassword', [ChangePasswordController::class, 'changePassword']);

    Route::get('subscriptions', [SubscriptionController::class, 'index']);
    Route::post('user/updateSubscription', [SubscriptionController::class, 'updateSubscription']);

    Route::get('preferences', [PreferenceController::class, 'index']);
    Route::post('user/preference/update', [PreferenceController::class, 'updateUserPreference']);

    Route::post('user/updateProfileVisibility', [AuthController::class, 'updateProfileVisibility']);
    Route::post('user/updateLocationVisibility', [AuthController::class, 'updateLocationVisibility']);
    Route::post('user/photos/add', [PhotoController::class, 'addPhoto']);
    Route::post('user/photos/delete', [PhotoController::class, 'deletePhoto']);

    // Route::post('reset',[ChangePasswordController::class,'reset']);
    // Route::post('forgot',[ForgotPasswordController::class,'forgot']);

    Route::get('GetAdvertisements ', [AdvertisementController::class, 'index']);

    Route::post('blockuser', [BlocksController::class, 'blockUser']);
    Route::post('unblockuser', [BlocksController::class, 'unblockUser']);
    
    Route::post('reportuser', [ReportController::class, 'reportUser']);

    Route::get('block/users', [BlocksController::class, 'blockUserList']); 

    Route::post('updateLocation', [AuthController::class, 'updateLocation']);

    Route::post('getUsers', [AuthController::class, 'getUserbyLocation']);
    
    // friends API here
    Route::post('friends', [FriendController::class, 'getFriends']); 
    Route::post('friend/sendRequest', [FriendController::class, 'sendFriendRequest']); 
    Route::post('friend/unfriendRequest', [FriendController::class, 'unfriendRequest']); 
    Route::post('friend/acceptDeclineRequest', [FriendController::class, 'acceptDeclineRequest']); 
    Route::post('friend/withdrawRequest', [FriendController::class, 'withdrawRequest']); 
    Route::post('friend/GetRequests', [FriendController::class, 'GetRequests']); 


});


