<?php

use  Illuminate\Support\Facades\Route;

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'as' => 'dashboard.',
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth' , 'admin']
    ],
    function () {

        Route::prefix('dashboard')->group(function () {
            // Update Temp Wallet
            /*Route::get("update_temp_wallet_static",function() {
                // $wallet_temps = \App\Models\TemporaryWallet::finished()->where('is_expired',false)->get();
                // foreach ($wallet_temps as $wallet) {
                //     $wallet->user->update(['wallet' => \DB::raw('wallet -'.$wallet->rest_amount)]);
                //     $wallet->update(['is_expired' => true]);
                // }
                // $clients = User::where('user_type','client')->get();
                // foreach ($users as $user) {
                //     // code...
                // }
            });*/
            // Home
            Route::get('/','HomeController@index')->name('home');
            // Route::get('import','HomeController@importDrivers');
            // Role
            Route::resource('role','RoleController');
            // Slider
            Route::resource('app_ad','AppAdController');
            // LuckyBox
            Route::resource('lucky_box','LuckyBoxController');

            // ====================Car===========================================
            // Package
            Route::resource('package','PackageController');
            // Brand
            Route::resource('brand','BrandController');
            // CarType
            Route::resource('car_type','CarTypeController');
            // CarModel
            Route::resource('car_model','CarModelController');
            // Car
            Route::resource('car','CarController');
            // Update Requests
            Route::resource('update_request','UpdateRequestController')->only('index','show','update');
            // Renew Subscribtion Request
            Route::resource('renew_subscribtion_request','RenewRequestController')->only('index','show','update');
            // ====================Points==============================
            // Point Packages
            Route::resource('point_package','PointPackageController');
            // Point Offer
            Route::resource('point_offer','PointOfferController');
            // ====================Order==============================
            // CancelReason
            Route::resource('cancel_reason','CancelReasonController');
            // Order
            Route::resource('order','OrderController')->only('index','show');
            // Trip
            Route::resource('trip','TripController')->only('index');
            // Report
            Route::resource('report','ReportController')->only('index');
            // Ambassador
            Route::resource('ambassador','AmbassadorController')->only('index','show');
            // General Invite Codes
            Route::resource('invite_code','GeneralInviteCodeController');

            // ====================HR===========================================
            // Manager
            Route::resource('manager','ManagerController');
            // Driver
            Route::resource('driver','DriverController');
            // Client
            Route::resource('client','ClientController');
            // =====================Location====================================
            // Country
            Route::resource('country','CountryController');
            // City
            Route::resource('city','CityController');
            // ======================Setting====================================
            // Notification
            Route::resource('notification','NotificationController')->only('index','show','store');
            // Balance Transfer
            Route::resource('balance_transfer','BalanceTransferController')->only('index');
            // Setting
            Route::resource('setting','SettingController')->only('index','store');

            // Contact
            Route::resource('contact','ContactController')->only('index','show','store','destroy');
            Route::delete('reply/{reply_id}/delete','ContactController@deleteReply');

            //Faqs
            // Route::resource('faq','FaqController');
            //app_offers
            Route::resource('app_offer','AppOfferController');
            // predecessor_service

            Route::resource('predecessor_service','PredecessorServiceController')->only('index','show');

           //point_use
            Route::resource('point_use','PointUseController')->only('index','show');

            // =============================Utilities=============================


            Route::get('search','HomeController@getSearch');

            Route::get('get_profile','ProfileController@create')->name('profile.get_profile');
            Route::post('update_profile','ProfileController@store')->name('profile.update_profile');
            Route::post('update_password','ProfileController@updatePassword')->name('profile.update_password');

            // ===========================AJAX==================================
            Route::prefix('ajax')->group(function () {

                Route::get('get_cities_by_country/{country_id}','AjaxController@getCitiesByCountry');

                Route::post('get_elm_reply/{driver_id}','AjaxController@getElmReply');
                Route::post('register_driver_to_elm/{driver_id}','AjaxController@registerDriverToElm');

                Route::post('enable_package_active/{package_id}','AjaxController@enablePackageActive');
                Route::post('enable_app_ad_active/{app_ad_id}','AjaxController@enableAppAdActive');
                Route::post('enable_invite_code_active/{invite_code_id}','AjaxController@enableInviteCodeActive');

                Route::get('get_car_search','AjaxController@getCarSearch');
                Route::get('get_users_by_type/{user_type}','AjaxController@getUsersByType');

                Route::get('get_user_by_type_search/{user_type}','AjaxController@getUsersByTypeSearch');

                Route::get('get_car_models_by_brand/{brand_id}','AjaxController@getCarModelsByBrand');

                Route::post('user_health_status_data/{driver_id}','AjaxController@userHealthStatus');

                Route::post('convert_unavailable_drivers_to_available','AjaxController@convertUnavailableDriversToAvailable');

                // Route::post('check_if_temp_balance','AjaxController@checkIfTempBalance');
                Route::post('enable_driver_data/{driver_id}','AjaxController@EnableDriverData');
                Route::post('change_driver_type/{driver_id}','AjaxController@changeDriverType');
                Route::post('enable_driver_subscribe/{driver_id}','AjaxController@EnableDriverPackageSubscribe');
                Route::post('set_subscribe_package_to_not_available_drivers','AjaxController@setSubscribePackageToNotAvailableDrivers');
                Route::post('set_new_package_to_driver/{driver_id}','AjaxController@setNewPackageToDriver');
                Route::post('set_new_package_to_drivers','AjaxController@setNewPackageToDrivers');
                Route::post('set_subscribe_package_to_driver/{package_id}/{driver_id}','AjaxController@setSubscribePackageToDriver');
                Route::post('update_package_end_date/{package_id}/{driver_id}','AjaxController@UpdatePackageEndDate');

                Route::post('update_user_dept/{user_id}','AjaxController@updateUserDept');
                Route::post('update_user_wallet/{user_id}','AjaxController@updateUserWallet');
                Route::post('add_balance_to_all','AjaxController@addBalanceToAll');

                Route::post('add_temp_balance_to_all','AjaxController@addTempBalanceToAll');
                Route::post('set_wallet_of_user_zero/{user_id}','AjaxController@setUserWalletZero');

                Route::get('main_search','AjaxController@getSearch');
                Route::get('get_new_orders','AjaxController@getNewOrders');
                Route::get('get_current_orders','AjaxController@getCurrentOrders');
                Route::get('get_finished_orders','AjaxController@getFinishedOrders');

                Route::post('update_order_status/{order_id}','AjaxController@updateOrderStatus');
                Route::post('update_wallet_transfer_status/{order_id}','AjaxController@updateWalletTransferStatus');
                // Delete Images
                Route::delete('delete_app_image/{image_id}','AjaxController@deleteAppImage');

                // Generate Code
                Route::get('generate_code/{char_length?}/{char_type?}/{model?}/{col?}/{letter_type?}','AjaxController@generateCode');
            });
        });
    });
