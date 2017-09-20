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

Route::get('/', [
    'as'   => 'index',
    'uses' => 'Frontend\PageController@index',
]);

Route::get('/home', [
    'as'   => 'home',
    'uses' => 'Frontend\PageController@index',
]);

Route::get('/shop/{categories}/{category}/{slug?}', [
    'as'   => 'shop',
    'uses' => 'Frontend\PageController@shop',
]);

Route::get('/product/{slug}', [
    'as'   => 'product',
    'uses' => 'Frontend\PageController@product',
]);

Route::get('/landing/women', [
    'as'   => 'women',
    'uses' => 'Frontend\PageController@women',
]);

Route::get('/landing/men', [
    'as'   => 'men',
    'uses' => 'Frontend\PageController@men',
]);

Route::get('/landing/kids', [
    'as'   => 'kids',
    'uses' => 'Frontend\PageController@kids',
]);

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [
        'as'   => 'login',
        'uses' => 'Frontend\LoginController@showLoginPage',
    ]);

    Route::post('/register', [
        'as'   => 'register',
        'uses' => 'Frontend\LoginController@register',
    ]);

    Route::get('/activation/{code}', [
        'as'   => 'activation',
        'uses' => 'Frontend\PageController@activation',
    ]);

    Route::post('/authenticate', [
        'as'   => 'authenticate',
        'uses' => 'Frontend\LoginController@authenticate',
    ]);

    Route::get('/login/{provider}', [
        'as'   => 'social.login',
        'uses' => 'Frontend\LoginController@socialLogin',
    ])->where([
        'provider' => 'facebook|google|twitter'
    ]);

    Route::get('/login/{provider}/callback', [
        'as'   => 'social.login.callback',
        'uses' => 'Frontend\LoginController@socialLoginCallback',
    ])->where([
        'provider' => 'facebook|google|twitter'
    ]);

});

Route::middleware(['auth'])->group(function () {

    Route::get('/user/profile', [
        'as'   => 'user.profile',
        'uses' => 'Frontend\UserController@profile',
    ]);

    Route::get('/logout', [
        'as'   => 'logout',
        'uses' => 'Frontend\LoginController@logout',
    ]);
});


