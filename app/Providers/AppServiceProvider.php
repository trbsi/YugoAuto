<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View as FacadeView;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        FacadeView::composer('*', function (View $view) {
            $unreadMessages = $pendingRequestsCount = 0;
            if ($user = Auth::user()) {
                $profile = $user->profile;
                $unreadMessages = $profile->getUnreadMessagesCount();
                $pendingRequestsCount = $profile->getPendingRequestsCount();
            }
            $view->with('unreadMessages', $unreadMessages);
            $view->with('pendingRequestsCount', $pendingRequestsCount);
        });
    }
}
