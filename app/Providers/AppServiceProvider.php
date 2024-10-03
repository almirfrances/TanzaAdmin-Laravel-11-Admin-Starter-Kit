<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
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

        Blade::if('isGuest', function () {
            return !Auth::guard('admin')->check() && !Auth::guard('web')->check() && !Auth::guard('vendor')->check();
        });

         Blade::if('isAdmin', function () {
            return Auth::guard('admin')->check();
        });

        Blade::if('isVendor', function () {
            return Auth::guard('vendor')->check();
        });

        Blade::if('isUser', function () {
            return Auth::guard('web')->check();
        });


        Blade::if('isGuest', function () {
            return !Auth::guard('admin')->check() &&
                   !Auth::guard('vendor')->check() &&
                   !Auth::guard('web')->check();
        });





        $emailSettings = DB::table('settings')->whereIn('key', [
            'email_method', 'smtp_host', 'smtp_port', 'smtp_username', 'smtp_password', 'smtp_encryption', 'smtp_from_email', 'smtp_from_name'
        ])->pluck('value', 'key')->toArray();

        // Set the mailer dynamically based on the settings
        Config::set('mail.default', $emailSettings['email_method'] ?? 'smtp');
        Config::set('mail.mailers.smtp.host', $emailSettings['smtp_host'] ?? 'smtp.mailtrap.io');
        Config::set('mail.mailers.smtp.port', $emailSettings['smtp_port'] ?? 2525);
        Config::set('mail.mailers.smtp.username', $emailSettings['smtp_username'] ?? null);
        Config::set('mail.mailers.smtp.password', $emailSettings['smtp_password'] ?? null);
        Config::set('mail.mailers.smtp.encryption', $emailSettings['smtp_encryption'] ?? null);
        Config::set('mail.from.address', $emailSettings['smtp_from_email'] ?? 'no-reply@example.com');
        Config::set('mail.from.name', $emailSettings['smtp_from_name'] ?? 'Example');

    }
}