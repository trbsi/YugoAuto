<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
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
        $unreadMessages = 0;
        if ($user = Auth::user()) {
            $unreadMessages = $user->profile->getUnreadMessagesCount();
        }
        View::share('unreadMessages', $unreadMessages);
    }
}
