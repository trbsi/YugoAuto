<?php

declare(strict_types=1);

namespace App\Source\SystemCommunication\PushNotification\Infra\Builder;

use App\Source\SystemCommunication\PushNotification\Infra\Value\PushNotificationValueInterface;
use Kreait\Firebase\Messaging\ApnsConfig;

class IphonePushMessageBuilder
{
    public function build(PushNotificationValueInterface $payload): ApnsConfig
    {
        $configArray = [
            'payload' => [
                'aps' => [
                    'content-available' => 1,
                    'alert' => [
                        'title' => $payload->getTitle(),
                        'body' => $payload->getBody(),
                    ],
                    'sound' => $payload->getSoundForIos(),
                    'badge' => $payload->getBadge(),

                ],
            ],
        ];

        if ('' !== $payload->getIOSCategory()) {
            $configArray['payload']['aps']['category'] = $payload->getIOSCategory();
        }

        return ApnsConfig::fromArray($configArray);
    }
}
