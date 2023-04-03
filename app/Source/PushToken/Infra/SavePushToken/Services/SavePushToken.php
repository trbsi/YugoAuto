<?php

namespace App\Source\PushToken\Infra\SavePushToken\Services;

use App\Models\PushToken;

class SavePushToken
{
    public function save(
        int $userId,
        string $deviceId,
        string $platform,
        string $token,
        string $tokenType
    ) {
        $deviceId = md5($deviceId);

        /** @var PushToken $pushToken */
        $pushToken = PushToken::where('user_id', $userId)
            ->where('platform', $platform)
            ->where('device_id', $deviceId)
            ->first();

        if (null !== $pushToken) {
            $pushToken
                ->setToken($token)
                ->setTokenType($tokenType);

            $pushToken->save();
            return;
        }

        $pushToken = new PushToken();
        $pushToken
            ->setUserId($userId)
            ->setDeviceId($deviceId)
            ->setPlatform($platform)
            ->setToken($token)
            ->setTokenType($tokenType);

        $pushToken->save();
    }
}
