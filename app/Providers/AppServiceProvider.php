<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        date_default_timezone_set('Asia/Riyadh');

        if (\Schema::hasTable('settings')) {
                $config = [
                    'driver'     => optional(\DB::table('settings')->where('key','driver')->first())->value,
                    'host'       => optional(\DB::table('settings')->where('key','host')->first())->value,
                    'port'       => optional(\DB::table('settings')->where('key','port')->first())->value,
                    'from'       => array('address' => optional(\DB::table('settings')->where('key','from_address')->first())->value, 'name' => optional(\DB::table('settings')->where('key','from_name')->first())->value),
                    'encryption' => optional(\DB::table('settings')->where('key','encry')->first())->value,
                    'username'   => optional(\DB::table('settings')->where('key','username')->first())->value,
                    'password'   => optional(\DB::table('settings')->where('key','password')->first())->value,
                    'sendmail'   => '/usr/sbin/sendmail -bs',
                    'pretend'    => false,
                ];
                \Config::set('mail', $config);
            }

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \Carbon\Carbon::setLocale(LC_TIME, app()->getLocale());

        view()->composer([
            'dashboard.layout.sidebar'
        ], function ($view) {
            $view->with('locale', app()->getLocale());
        });

        view()->composer([
            'dashboard.layout.navbar',
            'dashboard.layout.script'
        ], function ($view) {
            $view->with('notifications', auth()->check() ? auth()->user()->unreadnotifications()->paginate(50) : null);
        });
    }
}
