<?php

if (!function_exists('user_profile')) {
    /**
     * Create a new Carbon instance for the current time.
     *
     * @param \DateTimeZone|string|null $tz
     * @return \Illuminate\Support\Carbon
     */
    function user_profile(int $userId): string
    {
        return route('user.show', ['id' => $userId]);
    }
}
