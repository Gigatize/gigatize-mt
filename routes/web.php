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

Route::group(['middleware' => ['web']], function () {
        Route::domain('{customer}.' . config('app.url_base'))->group(function () {
            Route::get('/', function () {
                return view('tenant_welcome');
            });

            Route::get('/saml/login', function() {
                return \Aacotroneo\Saml2\Facades\Saml2Auth::login(URL::full());
            });

            //authenticate tenant based on auth type
            Route::group(['middleware' => 'tenant.login'], function () {

            Route::get('verify-user/{code}', 'Auth\RegisterController@activateUser')->name('activate.user');

            Route::group(['middleware' => 'tenancy.enforce'], function () {
                Auth::routes();
                Route::get('register/verify/resend', 'Auth\RegisterController@showResendVerificationEmailForm')->name('showResendVerificationEmailForm');
                Route::post('register/verify/resend', 'Auth\RegisterController@resendVerificationEmail')->name('resendVerificationEmail')->middleware('throttle:2,1');
            });
        });
    });

    Route::group(['middleware' => 'tenancy.enforce'], function () {

        Auth::routes();
        Route::get('register/verify/resend',  'Auth\RegisterController@showResendVerificationEmailForm')->name('showResendVerificationEmailForm');
        Route::post('register/verify/resend', 'Auth\RegisterController@resendVerificationEmail')->name('resendVerificationEmail')->middleware('throttle:2,1');
    });


    Route::get('/', function () {
        return view('welcome');
    });

    Route::get('/home', 'HomeController@index')->name('home');

});
