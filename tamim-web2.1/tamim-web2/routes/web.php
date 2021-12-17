<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthorizeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\FacebookSocialiteController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/auth/google', [\App\Http\Controllers\Auth\FacebookSocialiteController::class, 'redirectToFB'])->name('autho');
Route::get('/callback/google', [\App\Http\Controllers\Auth\FacebookSocialiteController::class, 'handleCallback']);

Auth::routes();



Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function () {
    Route::post('/authorize/device', [
        'name' => 'Authorize Login',
        'as' => 'authorize.device',
        'uses' => '\App\Http\Controllers\Auth\AuthorizeController@verify',
    ]);

    Route::post('/authorize/resend', [
        'name' => 'Authorize',
        'as' => 'authorize.resend',
        'uses' => '\App\Http\Controllers\Auth\AuthorizeController@resend',
    ]);
});



