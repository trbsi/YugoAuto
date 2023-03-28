<?php

if (!function_exists('user_profile_url')) {
    function user_profile_url(int $userId): string
    {
        return route('user.show', ['id' => $userId]);
    }
}

if (!function_exists('conversation_url')) {
    function conversation_url(int $messageId): string
    {
        return route('messaging.message.single', ['id' => $messageId]);
    }
}

if (!function_exists('rating_url')) {
    function rating_url(int $rideId): string
    {
        return route('rating.show', ['rideId' => $rideId]);
    }
}

if (!function_exists('single_ride_requests_url')) {
    function single_ride_requests_url(int $rideId): string
    {
        return route('ride-request.my-requests', ['rideId' => $rideId]);
    }
}

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


