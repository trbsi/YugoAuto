<?php

declare(strict_types=1);

namespace App\Source\SystemCommunication\PushNotification\Infra\Builder;

use App\Source\SystemCommunication\PushNotification\Infra\Value\PushNotificationValueInterface;
use Kreait\Firebase\Messaging\AndroidConfig;

class AndroidPushMessageBuilder
{
    public function build(PushNotificationValueInterface $payload): AndroidConfig
    {
        $configArray = [
            'priority' => 'normal',
            'notification' => [
                'title' => $payload->getTitle(),
                'body' => $payload->getBody(),
                'sound' => $payload->getSoundForAndroid(),
            ],
        ];

        return AndroidConfig::fromArray($configArray);
    }
}
