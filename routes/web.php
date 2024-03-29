<?php

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

Route::domain('{customer}.'.config('app.url_base'))->group(function () {
    //ensure tenant exists or redirect to root domain

    Route::get('/email', function (){
        return view('gig-created');
    });

    Route::group(['middleware' => 'auth-type:password'], function () {
        Route::group(['middleware' => 'tenancy.enforce'], function () {
            Route::get('register/verify/resend',  'Auth\RegisterController@showResendVerificationEmailForm')->name('showResendVerificationEmailForm');
            Route::post('register/verify/resend', 'Auth\RegisterController@resendVerificationEmail')->name('resendVerificationEmail')->middleware('throttle:2,1');
            Route::get('verify-user/{code}', 'Auth\RegisterController@activateUser')->name('activate.user');
            Auth::routes();
        });
    });

    //authenticate tenant based on auth type
    Route::group(['middleware' => 'tenant.login'], function () {
        Route::get('/', function () {
            return view('tenant');
        });
    });
});

Route::group(['middleware' => 'auth-type:password'], function () {
    Route::group(['middleware' => 'tenancy.enforce'], function () {
        Auth::routes();
    });
});


Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'tenancy.enforce'], function () {
    Auth::routes();
    Route::get('register/verify/resend',  'Auth\RegisterController@showResendVerificationEmailForm')->name('showResendVerificationEmailForm');
    Route::post('register/verify/resend', 'Auth\RegisterController@resendVerificationEmail')->name('resendVerificationEmail')->middleware('throttle:2,1');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
