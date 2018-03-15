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

Route::get('v1/search/{keyword?}', 'Api\PageController@search')->name('search.api');

Route::get('v1/popular/{group}', 'Api\PageController@popular')->name('populer');

Route::get('v1/popular-search', 'Api\PageController@popularSearch')->name('popular-search');

Route::get('v1/related/{categoryId}', 'Api\PageController@related')->name('related');

Route::post('v1/subcriber', 'Api\UserController@subcriber')->name('subcriber');

Route::get('v1/product/{id?}', 'Api\PageController@product')->name('product.api');

Route::post('v1/recently', 'Api\PageController@recently')->name('recently');

Route::post('v1/lookbook-product', 'Api\PageController@lookbook')->name('lookbook.product');

Route::get('v1/color', 'Api\PageController@colorPalette')->name('color');

Route::get('v1/typeahead/{keyword?}', 'Api\PageController@typeahead')->name('typeahead');



Route::group([
	'prefix' => 'v1', 
	'middleware' => 'auth:api'
], function () {
	Route::post('wishlist/', 'Api\UserController@wishlist')->name('wishlist');
});

// start local address

Route::get('v1/countries', 'Api\LocalAddressController@getAllCountry')->name('get-all-country');

Route::get('v1/provinces', 'Api\LocalAddressController@getAllProvince')->name('get-all-province');

Route::get('v1/cities/{byProvince}', 'Api\LocalAddressController@getAllCity')->name('get-all-province');

Route::get('v1/sub-district/{byCity}', 'Api\LocalAddressController@getSubDistrict')->name('get-sub-district');

Route::get('v1/villages/{bySubDistrict}', 'Api\LocalAddressController@getVillage')->name('get-village');

// end local address
