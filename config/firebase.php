<?php

return [
    'config' => [
        'apiKey' => env('FIREBASE_WEB_API_KEY'),
        'authDomain' => env('FIREBASE_WEB_AUTH_DOMAIN'),
        'projectId' => env('FIREBASE_WEB_PROJECT_ID'),
        'storageBucket' => env('FIREBASE_WEB_STORAGE_BUCKET'),
        'messagingSenderId' => env('FIREBASE_WEB_MESSAGING_SENDER_ID'),
        'appId' => env('FIREBASE_WEB_APP_ID'),
    ],
    'phone_verification_daily_limit' => env('FIREBASE_PHONE_VERIFICATION_DAILY_LIMIT', 50),
    'phone_verification_user_daily_limit' => env('FIREBASE_PHONE_VERIFICATION_USER_DAILY_LIMIT', 2),
];
