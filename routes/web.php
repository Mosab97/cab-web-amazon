<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use  Illuminate\Support\Facades\Route;

// Route::get('/' , function(){
// 	Cache::remember('test', Carbon::parse('20 seconds') , function(){
// 		return 'test';
// 	});
// });

Route::group(
[
	'prefix' => LaravelLocalization::setLocale(),
	'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ,'throttle' ]
], function(){


		// Dashboard (Has Role)
		Route::get('dashboard/login', "Auth\LoginController@showLoginForm")->name("dashboard.login");
		Route::post('dashboard/login', "Auth\LoginController@login")->name("dashboard.post_login");


		// For All
		Route::get('activate/{confirmationCode}', 'Auth\LoginController@confirm')->name('confirmation_path');
		Route::post('setPassword', "Auth\LoginController@storePassword")->name('setPassword');
		Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('forget');
		Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('email');
		Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
		Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('resetToNew');

		Route::middleware('auth')->group(function () {
			Route::post('logout',"Auth\LoginController@logout")->name('logout');
		});
		Route::view('/',"site.index")->name('site.home');
		Route::view('terms',"site.terms")->name('site.terms');
		Route::view('policy',"site.policy")->name('site.policy');
		Route::view('faqs',"site.faqs",['faqs'=>\App\Models\Faq::Active()->latest()->get() ])->name('site.faqs');

		/*Route::get('update_database',function () {
			\App\Models\PackageDriver::whereNotNull('transaction_id')->where('transaction_id',"<>",'Paid_By_Default_Free')->chunk(200, function ($package_drivers){
				foreach ($package_drivers as $package_driver) {
					if (\App\Models\WalletTransaction::where(['transaction_id' => $package_driver->transaction_id, 'user_id' => $package_driver->driver_id])->first()) {
				           continue;
				     }
					 \DB::table('wallet_transactions')->insert([
								'transaction_id' => $package_driver->transaction_id,
								'transaction_type' => 'charge',
								'amount' => $package_driver->price,
								'added_by_id' => $package_driver->driver_id,
								'user_id' => $package_driver->driver_id,
								'transfer_status' => 'transfered',
								'app_typeable_type' => 'App\Models\PackageDriver',
								'app_typeable_id' => $package_driver->id,
		 						'created_at' => $package_driver->created_at,
		 						'updated_at' => $package_driver->updated_at,
		 					]);
				}
			});
		});*/
});
