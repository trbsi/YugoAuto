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
