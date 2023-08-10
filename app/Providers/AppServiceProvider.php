<?php

namespace App\Providers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $smtp = [
            'driver'    => 'smtp',
            'host'    => getSetting('smtp_host'),
            'port'    => getSetting('smtp_port'),
            'encryption'    => getSetting('smtp_encryption'),
            'username'    => getSetting('smtp_username'),
            'password'    => getSetting('smtp_password'),
            'from'    => [
                'address' => getSetting('smtp_sender_email'),
                'name' => getSetting('smtp_sender_name')
            ]
        ];
        Config::set('mail', $smtp);

        Config::set('app.name', getSetting('website_name'));
        Config::set('app.url', getSetting('website_url'));
        Config::set('app.timezone', getSetting('timezone'));
        Config::set('app.locale', getSetting('website_language'));
    }
}
