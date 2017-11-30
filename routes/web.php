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

// this route for testing pos indonesia courier service
use App\Services\PosIndonesiaCourierService;

Route::get('/posindonesia', function () {
    //init object
    $posIndonesia = new PosIndonesiaCourierService;

    //create request getfee
    // $requestToPosIndonesia = [
    //                             [
    //                                 'userId'            => config('common.username_pos_indonesia'),
    //                                 'password'          => config('common.password_pos_indonesia'),
    //                                 'customerId'        => '0',
    //                                 'isDomestic'        => '0',
    //                                 'senderPosCode'     => '13210',
    //                                 'receiverPosCode'   => 'SG',
    //                                 'weight'            => '1000',
    //                                 'length'            => '0',
    //                                 'width'             => '100',
    //                                 'height'            => '100',
    //                                 'diameter'          => '0',
    //                                 'itemValue'         => '900000'
    //                             ]
    //                         ];

    $requestToPosIndonesia = [
                                [
                                    'userId'            => config('common.username_pos_indonesia'),
                                    'password'          => config('common.password_pos_indonesia'),
                                    'city'        => '',
                                    'address'        => ''
                                ]
                            ];

    //send request
    $resultFee = $posIndonesia->callMethod('getPosCodeByaddrAndCity', $requestToPosIndonesia);

    //result
    var_dump($resultFee);
});

Route::get('/blog', [
    'as'   => 'blog-get-index',
    'uses' => 'Frontend\BlogController@index',
]);

Route::post('/blog', [
    'as'   => 'blog-post-ajax',
    'uses' => 'Frontend\BlogController@getBlogAjax',
]);

Route::get('/blog/category/{slug}', [
    'as'   => 'blog-get-category',
    'uses' => 'Frontend\BlogController@category',
]);

Route::get('/blog/{slug}', [
    'as'   => 'blog-get-read',
    'uses' => 'Frontend\BlogController@blogRead',
]);

Route::post('/blog/search', [
    'as'   => 'blog-get-search',
    'uses' => 'Frontend\BlogController@search',
]);

Route::get('/help/{slug}', [
    'as'   => 'get-help',
    'uses' => 'Frontend\PageController@help',
]);

Route::get('/page/{slug}', [
    'as'   => 'get-page',
    'uses' => 'Frontend\PageController@page',
]);

Route::get('/', [
    'as'   => 'index',
    'uses' => 'Frontend\PageController@index',
]);

Route::get('/', [
    'as'   => 'index',
    'uses' => 'Frontend\PageController@index',
]);

Route::get('/home', [
    'as'   => 'home',
    'uses' => 'Frontend\PageController@index',
]);

Route::get('/shop/{categories}/{category}/{slug?}/{sale?}', [
    'as'   => 'shop',
    'uses' => 'Frontend\PageController@shop',
]);

Route::get('/product/{slug?}/{method?}/{sku?}/{id?}', [
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

Route::get('/persist-bag', [
    'as'   => 'persist.bag',
    'uses' => 'Frontend\PageController@bag',
]);

Route::post('/persist-bag', [
    'as'   => 'persist.bag',
    'uses' => 'Frontend\PageController@bag',
]);

Route::get('/bag', [
    'as'   => 'bag',
    'uses' => 'Frontend\PageController@showBagPage',
]);

Route::get('/review', [
    'as'   => 'review',
    'uses' => 'Frontend\PageController@review',
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
        'uses' => 'Frontend\LoginController@activation',
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

    Route::get('/forgot', [
        'as'   => 'page.forgot',
        'uses' => 'Frontend\LoginController@showForgotPage',
    ]);

    Route::post('/forgot', [
        'as'   => 'forgot',
        'uses' => 'Frontend\LoginController@forgot',
    ]);

    Route::get('/reset/{code}', [
        'as'   => 'page.reset',
        'uses' => 'Frontend\LoginController@showResetPage',
    ]);

    Route::post('/reset', [
        'as'   => 'reset',
        'uses' => 'Frontend\LoginController@reset',
    ]);


});

Route::middleware(['auth'])->group(function () {

    Route::get('/account', [
        'as'   => 'user',
        'uses' => 'Frontend\UserController@index',
    ]);

    Route::get('/account/detail', [
        'as'   => 'user.detail',
        'uses' => 'Frontend\UserController@showDetailPage',
    ]);

    Route::post('/account/update', [
        'as'   => 'user.update',
        'uses' => 'Frontend\UserController@update',
    ]);

    Route::get('/logout', [
        'as'   => 'logout',
        'uses' => 'Frontend\LoginController@logout',
    ]);

    Route::get('/account/reset-password', [
        'as'   => 'user.reset.password',
        'uses' => 'Frontend\UserController@showResetPasswordPage',
    ]);

    Route::post('/account/reset-password', [
        'as'   => 'user.reset.password',
        'uses' => 'Frontend\UserController@updatePassword',
    ]);

    Route::get('/account/wishlist', [
        'as'   => 'user.wishlist',
        'uses' => 'Frontend\UserController@showWishlistPage',
    ]);

    Route::post('/account/persist-wishlist', [
        'as'   => 'persist.wishlist',
        'uses' => 'Frontend\UserController@postWishlist',
    ]);

    Route::get('/account/persist-wishlist', [
        'as'   => 'persist.wishlist',
        'uses' => 'Frontend\UserController@getWishlist',
    ]);

    Route::delete('/account/wishlist/destroy', [
        'as'   => 'user.wishlist.destroy',
        'uses' => 'Frontend\UserController@wishlistDestroy',
    ]);

    Route::post('/account/upload-profile', [
        'as'   => 'user.upload.profile',
        'uses' => 'Frontend\UserController@uploadProfile',
    ]);

    Route::get('/account/history', [
        'as'   => 'user.history',
        'uses' => 'Frontend\UserController@history',
    ]);

    // Route checkout module
    Route::get('/checkout', [
        'as'   => 'checkout',
        'uses' => 'Frontend\UserController@showShippingAddressPage',
    ]);

    Route::get('/checkout/shipping', [
        'as'   => 'checkout.shipping',
        'uses' => 'Frontend\UserController@showShippingOptionPage',
    ]);

    Route::get('/checkout/billing', [
        'as'   => 'checkout.billing',
        'uses' => 'Frontend\UserController@showShippingBillingPage',
    ]);

    Route::post('/checkout/shipping', [
        'as'   => 'checkout.shipping',
        'uses' => 'Frontend\UserController@postShippingOption',
    ]);

    Route::get('/checkout/review', [
        'as'   => 'checkout.review',
        'uses' => 'Frontend\UserController@showReviewPage',
    ]);


    // Route Address module
    Route::get('/account/address', [
        'as'   => 'user.address',
        'uses' => 'Frontend\UserController@showAddressPage',
    ]);

    Route::post('/account/address', [
        'as'   => 'user.address',
        'uses' => 'Frontend\UserController@addressSave',
    ]);

    Route::post('/account/address-default', [
        'as'   => 'user.address.default',
        'uses' => 'Frontend\UserController@defaultAddress',
    ]);

    Route::delete('/account/address/destroy', [
        'as'   => 'user.address.destroy',
        'uses' => 'Frontend\UserController@addressDestroy',
    ]);

    Route::get('/account/address/edit/{id?}', [
        'as'   => 'user.address.edit',
        'uses' => 'Frontend\UserController@addressEdit',
    ]);

    Route::post('/account/address/update/{id?}', [
        'as'   => 'user.address.update',
        'uses' => 'Frontend\UserController@addressUpdate',
    ]);

    // Route Credit Card module
    Route::get('/account/cc', [
        'as'   => 'user.cc',
        'uses' => 'Frontend\UserController@showCreditCardPage',
    ]);

    Route::post('/account/cc', [
        'as'   => 'user.cc',
        'uses' => 'Frontend\UserController@creditCardSave',
    ]);

    Route::post('/account/cc-default', [
        'as'   => 'user.cc.default',
        'uses' => 'Frontend\UserController@defaultCreditCard',
    ]);

    Route::delete('/account/cc/destroy', [
        'as'   => 'user.cc.destroy',
        'uses' => 'Frontend\UserController@ccDestroy',
    ]);

    Route::get('/account/cc/edit/{id?}', [
        'as'   => 'user.cc.edit',
        'uses' => 'Frontend\UserController@ccEdit',
    ]);

    Route::post('/account/cc/update/{id?}', [
        'as'   => 'user.cc.update',
        'uses' => 'Frontend\UserController@ccUpdate',
    ]);

    Route::post('/order', [
        'as'   => 'order',
        'uses' => 'Frontend\OrderController@store',
    ]);

});
