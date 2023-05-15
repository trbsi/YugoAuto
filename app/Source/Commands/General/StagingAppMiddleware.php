<?php

declare(strict_types=1);

namespace App\Source\Commands\General;

use App\Source\Staging\StagingHelper;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class StagingAppMiddleware
{
    /**
     * @param Request $request
     * @param Closure $next
     * @return void
     */
    public function handle($request, Closure $next)
    {
        $stagingHost = str_replace(['https://', 'http://'], '', config('staging.staging_url'));

        if ($request->getHost() !== $stagingHost) {
            return $next($request);
        }

        //so we can set cookie from StagingController
        if (
            $request->is('staging/setcookie') &&
            $request->get('staging_access') === config('staging.access_key')
        ) {
            return $next($request);
        }

        if (!StagingHelper::isStaging()) {
            abort(403);
        }

        Config::set('app.url', config('staging.staging_url'));
        Config::set('database.default', 'staging_mysql');
        DB::reconnect();

        return $next($request);
    }
}
