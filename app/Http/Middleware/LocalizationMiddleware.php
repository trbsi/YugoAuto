<?php

namespace App\Http\Middleware;

use App\Source\Localization\Infra\Helpers\LocalizationHelper;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class LocalizationMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($locale = LocalizationHelper::getLocale()) {
            App::setLocale($locale);
            return $next($request);
        }

        return $next($request);
    }
}
