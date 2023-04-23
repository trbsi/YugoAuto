<?php

namespace App\Source\PushToken\Infra\SavePushToken\Services;

use App\Models\PushToken;
use Illuminate\Support\Carbon;

class SavePushToken
{
    public function save(
        int $userId,
        string $deviceId,
        string $platform,
        string $token,
        string $tokenType
    ) {
        $deviceIdSha512 = hash('sha512', $deviceId);

        //TODO remove this implementation when everyone move to sha512
        //START remove this also
        $deviceIdMd5 = md5($deviceId);

        /** @var PushToken $pushToken */
        $pushToken = PushToken::where('user_id', $userId)
            ->where('platform', $platform)
            ->where('device_id', $deviceIdMd5)
            ->first();

        if (null !== $pushToken) {
            $pushToken
                ->setToken($token)
                ->setTokenType($tokenType)
                ->setDeviceId($deviceIdSha512)
                ->setUpdatedAt(Carbon::now())
                ->save();
            return;
        }
        //END remove this also


        /** @var PushToken $pushToken */
        $pushToken = PushToken::where('user_id', $userId)
            ->where('platform', $platform)
            ->where('device_id', $deviceIdSha512)
            ->first();

        if (null !== $pushToken) {
            $pushToken
                ->setToken($token)
                ->setTokenType($tokenType)
                ->setUpdatedAt(Carbon::now())
                ->save();
            return;
        }

        $pushToken = new PushToken();
        $pushToken
            ->setUserId($userId)
            ->setDeviceId($deviceIdSha512)
            ->setPlatform($platform)
            ->setToken($token)
            ->setTokenType($tokenType)
            ->setUpdatedAt(Carbon::now());

        $pushToken->save();
    }
}
