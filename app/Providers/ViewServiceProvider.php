<?php

namespace App\Providers;


use App\Models\Message;
use App\Models\Setting;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer('partials.breadcrumb', 'App\Http\ViewComposers\BreadcrumbComposer');
        // View::composer('*', function ($view) {
        //     $view->with('title', $this->getTitle());
        // });



               // Fetch all settings
               $settings = Setting::pluck('value', 'key')->all();

               // Share settings with all views
               View::share('settings', $settings);






               view()->composer('*', function ($view) {
                $unopenedMessagesCount = Message::where('is_opened', false)->count();
                $view->with('unopenedMessagesCount', $unopenedMessagesCount);
            });

            View::composer('*', function ($view) {
                $messages = Message::paginate(12);
                $view->with('messages', $messages);
            });
    }

    // protected function getTitle()
    // {
    //     // Get the current route name
    //     $routeName = Route::currentRouteName();

    //     // Define titles based on route names
    //     $titles = [
    //         'admin.dashboard' => 'Dashboard',
    //         'admin.login' => 'Admin Login',
    //         // Add other routes and their titles here
    //     ];

    //     // Return the title based on the current route
    // }
}
