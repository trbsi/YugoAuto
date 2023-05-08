<?php

declare(strict_types=1);

namespace App\Source\Public\App\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class StagingController
{
    public function setCookie(
        Request $request
    ) {
        if ($request->get('staging_access') !== config('staging.access_key')) {
            abort(403);
        }

        if (Cookie::get('staging_access')) {
            echo 'OK';
            return;
        }

        $cookie = Cookie::make(
            'staging_access',
            config('staging.access_key'),
            60
        );

        return redirect(
            route('staging.setcookie', ['staging_access' => $request->get('staging_access')])
        )->withCookie($cookie);
    }
}
