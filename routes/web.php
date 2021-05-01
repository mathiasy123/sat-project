<?php

use Illuminate\Support\Facades\Route;


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

// Customer routes
Route::group(['prefix' => '/', 'as' => 'customers'], function () {
    //Customer auth route
    Route::get('login', 'Auth\CustomerAuthController@index')->name('.login.index');
    Route::post('login', 'Auth\CustomerAuthController@login')->name('.login');
    Route::get('register', 'Auth\CustomerAuthController@register')->name('.register');
    Route::post('register', 'Auth\CustomerAuthController@registerAccount')->name('.register.account');
    Route::get('forgot-password', 'Auth\CustomerAuthController@showForgotPassword')->name('.login.forgot-password');
    Route::post('forgot-password', 'Auth\CustomerAuthController@forgotPassword')->name('.forgot-password');
    Route::get('logout', 'Auth\CustomerAuthController@logout')->name('.logout');

    // Customer landing page routes
    Route::group(['as' => '.landing'], function () {
        Route::get('/', 'LandingController@index')->name('.index');
        Route::get('contact', 'LandingController@contact')->name('.contact');
        Route::get('testimony', 'LandingController@testimony')->name('.testimony');
        Route::get('about', 'LandingController@about')->name('.about');
    });

    // Customer shopping routes
    Route::group(['prefix' => 'shopping', 'as' => '.shopping'], function () {
        // Customer order routes
        Route::get('/', 'ShoppingController@index')->name('.index');
        Route::get('product/{product}', 'ShoppingController@showProduct')->name('.product.show');
        Route::get('order/{product}', 'ShoppingController@order')->name('.order');

        // Courier routes
        Route::get('province', 'ShoppingController@showProvinces')->name('.province');
        Route::get('city/{province}', 'ShoppingController@showCities')->name('.city');
        Route::get('courier/origin={origin}&destination={destination}&weight={weight}&courier={courier}', 'ShoppingController@showCourierCost')->name('.courier');

        // Customer routes require login
        Route::middleware('auth:customer')->group(function () {
            Route::post('order', 'OrderController@store')->name('.order.store');

            // Customer profile routes
            Route::get('profile', 'ShoppingController@profile')->name('.profile');
            Route::put('{profile}/profile', 'ShoppingController@updateProfile')->name('.profile.update');
            Route::get('profile/change-password', 'ShoppingController@changePassword')->name('.profile.password');
            Route::put('profile/{profile}/change-password', 'ShoppingController@updatePassword')->name('.profile.password.update');

            // Customer transaction routes
            Route::group(['prefix' => 'transaction', 'as' => '.transaction'], function () {
                Route::get('/', 'ShoppingController@transactions');
                Route::get('{transaction}', 'ShoppingController@showTransaction')->name('.detail');
                Route::put('{transaction}/succeed', 'ShoppingController@setSucceedTransaction')->name('.succeed');
                Route::put('{transaction}/payment', 'ShoppingController@paymentTransaction')->name('.payment');
                Route::put('{transaction}', 'ShoppingController@setFailedTransaction')->name('.cancel');
            });
        });
    });

});


// Admin routes
Route::group(['prefix' => 'admin', 'as' => 'admins.'], function () {
    // Admin auth route
    Route::get('login', 'Auth\AdminAuthController@index')->name('login.index');
    Route::post('login', 'Auth\AdminAuthController@login')->name('login');
    Route::get('logout', 'Auth\AdminAuthController@logout')->name('logout');

    // Admin routes require login
    Route::middleware('auth:admin')->group(function () {
        // Admin dashboard route
        Route::get('/', 'DashboardController@index')->name('dashboard.index'); 

        // Admin order routes
        Route::resource('orders', OrderController::class)->except('store');

        // Admin transaction routes
        Route::resource('transactions', TransactionController::class);
        Route::put('{transaction}/failed', 'TransactionController@setFailedTransaction')->name('transactions.failed');
        Route::put('{transaction}/shipped', 'TransactionController@setShippedTransaction')->name('transactions.shipped');

        // Admin category routes
        Route::resource('categories', CategoryController::class); 

        // Admin product routes
        Route::resource('products', ProductController::class);
        Route::get('products/{product}/product-galleries', 'ProductController@showGalleries')->name('products.show-galleries'); 

        // Admin product galleries routes
        Route::resource('product-galleries', ProductGalleryController::class);
        Route::put('product-galleries/{product_gallery}/status', 'ProductGalleryController@updateStatus')->name('product-galleries.update-status');

        // Admin testimony routes
        Route::resource('testimonies', TestimonyController::class);
        Route::put('testimonies/{testimony}/status', 'TestimonyController@updateStatus')->name('testimonies.update-status');

        // Admin banner routes
        Route::resource('banners', BannerController::class);
        Route::put('banners/{banner}/status', 'BannerController@updateStatus')->name('banners.update-status');

        // Admin description routes
        Route::resource('descriptions', DescriptionController::class);
        Route::put('descriptions/{description}/status', 'DescriptionController@updateStatus')->name('descriptions.update-status');
    });
});

