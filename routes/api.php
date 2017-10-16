<?php

use Illuminate\Http\Request;

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

Route::get('v1/menu/{parent?}', 'Api\PageController@menu')->name('menu');

Route::get('v1/popular', 'Api\PageController@popular')->name('populer');

Route::get('v1/related/{categoryId}', 'Api\PageController@related')->name('related');

Route::group([
	'prefix' => 'v1', 
	'middleware' => 'auth:api'
], function () {
	Route::get('wishlist/', 'Api\UserController@wishlist')->name('wishlist');
});
