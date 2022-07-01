<?php

// use Illuminate\Http\Request;

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

Route::get('test', function () {
//            966555281286
    return send_sms('966555281286', 'sdfsdf');
});
Route::namespace('Api')->middleware(['setLocale', 'throttle'])->group(function () {
    Route::namespace('User')->group(function () {
        Route::post('register', 'AuthController@signup');
        Route::post('check_driver_register', 'AuthController@checkDriverRegister');

        Route::post('login', 'AuthController@login');

        Route::post('verify', 'AuthController@confirm');

        Route::post('send_code', 'AuthController@sendCode');

        Route::post('check_code', "AuthController@checkCode");

        Route::post('reset_password', "AuthController@resetPassword");
        Route::post('update_location', "UserController@updateUserLocation");

        Route::group(['middleware' => 'auth:api'], function () {
            // Logout
            Route::post('logout', 'AuthController@logout');
            // Profile
            Route::get('profile', 'UserController@index');
            Route::post('profile', 'UserController@store');
            Route::post('edit_password', 'UserController@editPassword');

            // Chat
            Route::get('chats/{order_id}/{receiver_id}', 'ChatController@show');
            Route::apiResource('chats', 'ChatController')->only('index', 'store');
            Route::put('chats/{chat_id}/message_is_seen', 'ChatController@messageIsSeen');
            // Notification
            Route::apiResource('notifications', 'NotificationController')->only('index', 'show', 'destroy');

            // Wallet
            Route::apiResource('wallet_transfers', 'WalletTransfersController')->only('index', 'show', 'store');
            Route::get('wallet', 'WalletController@index');
            Route::get('my_ibans', 'WalletController@getIbans');
            Route::post('charge_wallet', 'WalletController@chargeWallet');
            Route::post('withdrawal_wallet', 'WalletController@withdrawalWallet');


        });
    });
    // Client
    Route::namespace('Client')->prefix('client')->group(function () {
        Route::middleware(['auth:api', 'client_middleware'])->group(function () {
            // Orders
            Route::apiResource('food_tracks', 'FoodTrackController')->only('index', 'show');
            Route::apiResource('orders', 'OrderController')->only('index', 'show', 'store');
            Route::post('orders/{order_id}/tip', 'OrderController@sendTip');
            Route::post('change_order_status', 'OrderController@changeOrderStatus');
            Route::post('received_orders', 'OrderController@clientRecieveOrder');
            Route::post('resend_order', 'OrderController@resendOrder');
            // Offers
            Route::get('offers/{order_id}', 'OfferController@offers');
            Route::get('offers/{order_id}/{offer_id}', 'OfferController@showOffer');
            Route::post('offers', 'OfferController@acceptOffer');
            //Borrow Serivce
            Route::post('borrow_from_app', 'ClientController@borrowFromApp');
            // Neareast Drivers
            Route::get('nearest_drivers/{number_of_drivers?}', 'LocationController@nearestDrivers');


            Route::get('getAdd', 'ClinteController@getAdd');
            // Rate && Review
            Route::post('rates', 'OrderController@SetRate');
        });
    });
    // Driver
    Route::namespace('Driver')->prefix('driver')->group(function () {
        Route::middleware(['auth:api', 'driver_middleware'])->group(function () {
            // Order
            Route::apiResource('orders', 'OrderController')->only('index', 'show');
            Route::get('live_orders', 'OrderController@getCurrentOrder');
            Route::apiResource('offers', 'OfferController')->only('index', 'show', 'store');
            Route::post('change_order_status', 'OrderController@changeOrderStatus');
            // Update Driver Location
            Route::post('update_location', 'LocationController@updateLocation');
            // Package
            Route::apiResource('packages', 'PackageController')->only('store', 'index');
            Route::get('renew_subscription_from_wallet', 'PackageController@checkRenewSubscribtionFromWallet');
            Route::post('renew_subscription_from_wallet', 'PackageController@renewSubscribtionFromWallet');
            Route::get('driver_car', 'CarController@getCarData');
            Route::post('update_driver_car', 'CarController@updateDriver');
            Route::post('toggle_is_available', 'DriverController@toggleAvailable');
            Route::post('extend_packages', 'PackageController@extendPackage');
            Route::get('check_subscribtions', 'PackageController@checkSubscribtion');
            // Rate && Review
            Route::post('rates', 'ConsultantController@SetRate');

        });
        Route::get('min_manufacture_years', 'CarController@getMinManufactureYears');
        Route::get('plate_types', 'CarController@getPlateTypes');
    });
    Route::namespace('Help')->group(function () {
        // Country
        Route::get('countries', "CountryController@index");
        // Cancel Reasons
        Route::get('cancel_reasons', "HelpController@getCancelReasons")->middleware('auth:api');
        // Lucky Box
        Route::apiResource('lucky_boxes', 'LuckyBoxController')->middleware('auth:api', 'normal_user');
        // App Ad
        Route::get('app_ads', "HelpController@getAppAd")->middleware('auth:api');
        // City
        Route::get('cities/{country_id}', "CountryController@show");
        // About
        Route::get('about', 'HomeController@getAbout');
        // Policy
        Route::get('policy', 'HomeController@getPolicy');
        // Terms
        Route::get('terms', 'HomeController@getTerms');
        // Tax
        Route::get('tax', 'HomeController@getTax')->middleware('auth:api');
        // Contact
        Route::get('contact', 'HomeController@getContact');
        // Contact Us & Complaints
        Route::post('contact', 'HomeController@contact')->middleware('auth:api');

        // Delete Images
        Route::delete('delete_app_image/{image_id}', 'HomeController@deleteAppImage')->middleware("auth:api");

        // Search
        Route::get('search', 'HomeController@search');

        // Brand
        Route::apiResource('brands', 'BrandController')->only('index', 'show');
        // Point Package
        Route::apiResource('point_packages', 'PointPackageController')->only('index', 'show', 'store')->middleware('auth:api');
        // Car Types
        Route::get('car_types', 'HelpController@carTypes');
        // Packages
        Route::get('packages', 'HelpController@getPackages');
        // Slider
        Route::get('sliders', 'SliderController@index');
        //app offers
        Route::get('app_offers', 'HelpController@appOffers')->middleware('auth:api');;
        //faqs
        Route::get('faqs', 'HelpController@getFaqs');

    });
});
