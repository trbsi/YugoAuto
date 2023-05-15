<?php

declare(strict_types=1);

namespace App\Source\Staging;

use Illuminate\Support\Facades\Cookie;

class StagingHelper
{
    public static function isStaging(): bool
    {
        return Cookie::get('staging_access') === config('staging.access_key');
    }
}
