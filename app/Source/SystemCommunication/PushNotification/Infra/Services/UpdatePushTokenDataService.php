<?php

namespace App\Source\SystemCommunication\PushNotification\Infra\Services;

use App\Models\PushToken;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;

class UpdatePushTokenDataService
{
    public function update(Collection $tokens): void
    {
        $now = Carbon::now();

        /** @var PushToken $token */
        foreach ($tokens as $token) {
            $token
                ->setLastPushSentAt($now)
                ->save();
        }
    }
}
