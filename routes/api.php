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

Route::post('v1/subcriber', 'Api\UserController@subcriber')->name('subcriber');

Route::get('v1/product/{id?}', 'Api\PageController@product')->name('product.api');

Route::group([
	'prefix' => 'v1', 
	'middleware' => 'auth:api'
], function () {
	Route::post('wishlist/', 'Api\UserController@wishlist')->name('wishlist');
});

// start local address
Route::get('v1/countries', 'Api\LocalAddressController@getAllCountry')->name('get.all.country');
// end local address
