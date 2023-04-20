<?php

namespace App\Source\Public\App\Controllers;

use Detection\MobileDetect;
use Illuminate\Support\Facades\Route;

class PublicController
{
    /**
     * @see https://lokalise.com/blog/laravel-localization-step-by-step/
     */
    public function changeLanguage(
        string $locale
    ) {
        app()->setLocale($locale);
        session()->put('locale', $locale);
        return redirect()->back();
    }

    public function androidStore()
    {
        return redirect(config('app.android_url'));
    }

    public function iphoneStore()
    {
        return redirect(config('app.ios_url'));
    }


    public function app(MobileDetect $mobileDetect)
    {
        if ($mobileDetect->isiOS()) {
            return redirect(config('app.ios_url'));
        }

        if ($mobileDetect->isAndroidOS()) {
            return redirect(config('app.android_url'));
        }

        return redirect(route('home'));
    }

    /**
     * Add possibility to open and redirect to another route because sometimes we want to open yugoauto.com from mobile app in mobile browser.
     * This is because on Android we cannot choose profile pic from Webview (it just does not work)
     * thus people need to use mobile browser to do that
     */
    public function openAndRedirect(
        string $route
    ) {
        if (empty($route) || !Route::has($route)) {
            abort(404);
        }
        return redirect(route($route));
    }
}
