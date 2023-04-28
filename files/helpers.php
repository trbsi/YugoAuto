<?php

use App\Source\Localization\Infra\Helpers\LocalizationHelper;

/* URL GENERATOR */
if (!function_exists('user_profile_url')) {
    function user_profile_url(int $userId): string
    {
        return route('user.show', ['id' => $userId]);
    }
}

if (!function_exists('my_profile_url')) {
    function my_profile_url(): string
    {
        return user_profile_url(\Illuminate\Support\Facades\Auth::id());
    }
}

if (!function_exists('conversation_url')) {
    function conversation_url(int $messageId): string
    {
        return route('messaging.message.single', ['id' => $messageId]);
    }
}

if (!function_exists('rating_for_ride_url')) {
    function rating_for_ride_url(int $rideId): string
    {
        return route('rating.show-for-ride', ['rideId' => $rideId]);
    }
}

if (!function_exists('rating_for_user_url')) {
    function rating_for_user_url(int $userId): string
    {
        return route('rating.show-for-user', ['userId' => $userId]);
    }
}

if (!function_exists('single_ride_requests_url')) {
    function single_ride_requests_url(int $rideId): string
    {
        return route('ride-request.my-requests', ['rideId' => $rideId]);
    }
}

if (!function_exists('change_country_url')) {
    function change_country_url(string $countryNameInEnglish): string
    {
        return route('change.localization', ['country' => $countryNameInEnglish]);
    }
}

/* VARIOUS */
if (!function_exists('build_ride_search_base_query')) {
    function build_ride_search_base_query(): string
    {
        $query = [];
        foreach (\App\Source\Ride\Enum\RideBaseFiltersEnum::values() as $value) {
            $query[$value] = request()->query($value);
        }

        return http_build_query($query);
    }
}

if (!function_exists('get_available_countries')) {
    function get_available_countries(): array
    {
        $data = config('app.available_countries');
        asort($data);
        return $data;
    }
}

if (!function_exists('is_country_chosen')) {
    function is_country_chosen(): bool
    {
        return LocalizationHelper::hasLocaleExtended();
    }
}

if (!function_exists('get_user_currency')) {
    function get_user_currency(): string
    {
        return LocalizationHelper::getCurrencyWithDefaultFallback();
    }
}



