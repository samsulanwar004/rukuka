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

Route::get('lang/{lang}', [
    'as'=>'lang.switch',
    'uses'=>'LanguageController@switchLang'
]);

Route::get('eco-tourism', function () {
    return view('errors.503');
});

Route::get('/payment/confirm', [
    'as'   => 'payment.confirm.page',
    'uses' => 'Frontend\UserController@confirmPaymentPage',
]);

Route::get('/payment/confirm/result', [
    'as'   => 'payment.confirm',
    'uses' => 'Frontend\UserController@confirmPayment',
]);

Route::post('/payment/confirm/result', [
    'as'   => 'payment.confirm',
    'uses' => 'Frontend\UserController@confirmPayment',
]);

Route::get('/tracking/order/', [
    'as'   => 'tracking-page',
    'uses' => 'Frontend\OrderController@trackingOrder',
]);

Route::post('/tracking/order/result', [
    'as'   => 'tracking-result',
    'uses' => 'Frontend\OrderController@trackingOrderCode',
]);

Route::get('/tracking/order/result', [
    'as'   => 'tracking-result',
    'uses' => 'Frontend\OrderController@trackingOrderCode',
]);

Route::get('/editorial', [
    'as'   => 'editorial-get-index',
    'uses' => 'Frontend\BlogController@index',
]);

Route::post('/editorial', [
    'as'   => 'editorial-post-ajax',
    'uses' => 'Frontend\BlogController@getBlogAjax',
]);

Route::get('/editorial/category/{slug}', [
    'as'   => 'editorial-get-category',
    'uses' => 'Frontend\BlogController@category',
]);

Route::get('/editorial/{slug}', [
    'as'   => 'editorial-get-read',
    'uses' => 'Frontend\BlogController@blogRead',
]);

Route::get('/search/editorial', [
    'as'   => 'editorial-get-search',
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

Route::post('/review-ajax', [
    'as'   => 'review-post-ajax',
    'uses' => 'Frontend\UserController@getReviewAjax',
]);

Route::get('/', [
    'as'   => 'index',
    'uses' => 'Frontend\PageController@index',
]);

Route::get('/home', [
    'as'   => 'home',
    'uses' => 'Frontend\PageController@index',
]);

Route::get('/shop', [
    'as'   => 'shop',
    'uses' => 'Frontend\PageController@shop',
]);

Route::get('/product/{slug?}/{method?}/{sku?}/{id?}', [
    'as'   => 'product',
    'uses' => 'Frontend\PageController@product',
]);

Route::get('/popup/{slug?}', [
    'as'   => 'popup-product',
    'uses' => 'Frontend\PageController@popup',
]);

Route::get('/designer', [
    'as'   => 'designer',
    'uses' => 'Frontend\PageController@designer',
]);

Route::get('/women', [
    'as'   => 'women',
    'uses' => 'Frontend\PageController@women',
]);

Route::get('/men', [
    'as'   => 'men',
    'uses' => 'Frontend\PageController@men',
]);

Route::get('/kids', [
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

Route::get('/exchange', [
    'as'   => 'exchange',
    'uses' => 'Frontend\PageController@exchange',
]);

Route::post('/xendit', [
    'as'   => 'xendit',
    'uses' => 'Frontend\PageController@callBackXendit',
]);

Route::get('/bag', [
    'as'   => 'bag',
    'uses' => 'Frontend\PageController@showBagPage',
]);

Route::get('/search', [
    'as'   => 'search',
    'uses' => 'Frontend\PageController@search',
]);

Route::post('/contact', [
    'as'   => 'contact',
    'uses' => 'Frontend\PageController@contact',
]);

Route::get('/lookbook', [
    'as'   => 'lookbook',
    'uses' => 'Frontend\PageController@getLookbook',
]);

Route::get('/lookbook/{lookbook_slug}', [
    'as'   => 'lookbook-collection',
    'uses' => 'Frontend\PageController@getLookbookCollection',
]);

Route::get('/lookbook/{lookbook_slug}/{collection_slug}', [
    'as'   => 'lookbook-collection-product',
    'uses' => 'Frontend\PageController@getLookbookCollectionProduct',
]);

Route::get('/get-product/{sku}', [
    'as'   => 'get.product',
    'uses' => 'Frontend\PageController@getProductByAjax',
]);


//MIDDLEWARE
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

    Route::post('/checkout-as-guest', [
        'as'   => 'checkout.as.guest',
        'uses' => 'Frontend\LoginController@asGuest',
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

    Route::get('/review/{slug}', [
        'as'   => 'review',
        'uses' => 'Frontend\UserController@review',
    ]);

    Route::post('/review', [
        'as'   => 'review-post',
        'uses' => 'Frontend\UserController@postReview',
    ]);

    // Route Address module
    Route::get('/account/address', [
        'as'   => 'user.address',
        'uses' => 'Frontend\UserController@showAddressPage',
    ]);

    // Route Credit Card module
    // Route::get('/account/cc', [
    //     'as'   => 'user.cc',
    //     'uses' => 'Frontend\UserController@showCreditCardPage',
    // ]);

    // Route::post('/account/cc', [
    //     'as'   => 'user.cc',
    //     'uses' => 'Frontend\UserController@creditCardSave',
    // ]);

    // Route::post('/account/cc-default', [
    //     'as'   => 'user.cc.default',
    //     'uses' => 'Frontend\UserController@defaultCreditCard',
    // ]);

    // Route::delete('/account/cc/destroy', [
    //     'as'   => 'user.cc.destroy',
    //     'uses' => 'Frontend\UserController@ccDestroy',
    // ]);

    // Route::get('/account/cc/edit/{id?}', [
    //     'as'   => 'user.cc.edit',
    //     'uses' => 'Frontend\UserController@ccEdit',
    // ]);

    // Route::post('/account/cc/update/{id?}', [
    //     'as'   => 'user.cc.update',
    //     'uses' => 'Frontend\UserController@ccUpdate',
    // ]);

});

Route::middleware(['as.guest'])->group(function () {
    // Route checkout module
    Route::get('/checkout', [
        'as'   => 'checkout',
        'uses' => 'Frontend\UserController@showShippingAddressPage',
    ]);

    Route::get('/checkout/shipping', [
        'as'   => 'checkout.shipping',
        'uses' => 'Frontend\UserController@showShippingOptionPage',
    ]);

    // Route::get('/checkout/billing', [
    //     'as'   => 'checkout.billing',
    //     'uses' => 'Frontend\UserController@showShippingBillingPage',
    // ]);

    Route::post('/checkout/shipping', [
        'as'   => 'checkout.shipping',
        'uses' => 'Frontend\UserController@postShippingOption',
    ]);

    Route::get('/checkout/review', [
        'as'   => 'checkout.review',
        'uses' => 'Frontend\UserController@showReviewPage',
    ]);

    Route::post('/checkout/final', [
        'as'   => 'checkout.final',
        'uses' => 'Frontend\UserController@postFinalPage',
    ]);

    Route::get('/payment/finish', [
        'as'   => 'payment.finish',
        'uses' => 'Frontend\UserController@afterPaymentPage',
    ]);

    //Route Address
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

    //Route Order
    Route::post('/order', [
        'as'   => 'order',
        'uses' => 'Frontend\OrderController@store',
    ]);

    Route::get('/order', function () {
        abort('404');
    });

    Route::post('/repayment', [
        'as'   => 'repayment',
        'uses' => 'Frontend\OrderController@restore',
    ]);

    Route::get('/repayment', function () {
        abort('404');
    });

    Route::get('tracking/trace/{ordeCode}', [
        'as'   => 'tracking-trace',
        'uses' => 'Frontend\OrderController@trackingTrace',
    ]);

    Route::get('/order/repayment', [
        'as'   => 'order-repayment',
        'uses' => 'Frontend\OrderController@trackingOrder',
    ]);

});

// Route Admin crudbooster
// Module image product
Route::post('/upload-product', [
    'as'   => 'upload.product',
    'uses' => 'AdminProductImagesController@uploadProduct',
]);

Route::post('/upload-update/{id?}', [
    'as'   => 'upload.update',
    'uses' => 'AdminProductImagesController@editUploadProduct',
]);

Route::get('/export-product', [
    'as'   => 'export.product',
    'uses' => 'AdminProductReportsController@export',
]);


