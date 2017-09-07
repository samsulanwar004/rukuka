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

Route::get('/shop/{category}/{slug}', [
    'as'   => 'shop',
    'uses' => 'Frontend\PageController@shop',
]);

Route::get('/product/{slug}', [
    'as'   => 'product',
    'uses' => 'Frontend\PageController@product',
]);

Route::get('/menu/{parent}', [
    'as'   => 'menu',
    'uses' => 'Frontend\PageController@menu',
]);
