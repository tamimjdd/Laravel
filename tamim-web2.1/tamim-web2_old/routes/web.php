<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthorizeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\FacebookSocialiteController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

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



Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('verified');

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


Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');
