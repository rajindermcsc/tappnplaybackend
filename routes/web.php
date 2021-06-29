<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', function () {
    return view('auth.login');
});



// Admin Routes Backend
Route::group([ 'middleware' => ['auth'], 'prefix'=>'admin' ], function () {
    Route::get('dashboard', 'Admin\AdminController@index')->name('admin.dashboard');

    // Users Routes Admin
    Route::get('users', 'Admin\UsersController@index')->name('admin.users');
    Route::get('user/create', "Admin\UsersController@create")->name('admin.user.create');
    Route::post('user/store', "Admin\UsersController@store")->name('admin.user.store');
    Route::get('user/edit/{id}', "Admin\UsersController@edit")->name('admin.user.edit');
    Route::get('user/show/{id}', "Admin\UsersController@show")->name('admin.user.show');
    Route::post('user/update/{id}', "Admin\UsersController@update")->name('admin.user.update');
    Route::get('user/destroy/{id}', "Admin\UsersController@destroy")->name('admin.user.destroy');
    Route::post('user/active', "Admin\UsersController@active")->name('admin.user.active');
     Route::post('user/verified', "Admin\UsersController@verified")->name('admin.user.verified');
      Route::post('user/approved', "Admin\UsersController@approved")->name('admin.user.approved');





      // Advertisement Routes Admin
    Route::get('advertisements', 'Admin\AdvertisementController@index')->name('admin.adds');
    Route::get('advertisement/create', "Admin\AdvertisementController@create")->name('admin.adds.create');
    Route::post('advertisement/store', "Admin\AdvertisementController@store")->name('admin.adds.store');
    Route::get('advertisement/edit/{id}', "Admin\AdvertisementController@edit")->name('admin.adds.edit');
    Route::post('advertisement/update/{id}', "Admin\AdvertisementController@update")->name('admin.adds.update');;
    Route::get('advertisement/destroy/{id}', "Admin\AdvertisementController@destroy")->name('admin.adds.destroy');

});


// Auth Reset Password
Route::group(['middleware' => ['auth']], function () {
    Route::get('change-password', 'Auth\ResetPasswordController@index')->name('change-password');
    Route::post('change-password', 'Auth\ResetPasswordController@store')->name('change.password');
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
