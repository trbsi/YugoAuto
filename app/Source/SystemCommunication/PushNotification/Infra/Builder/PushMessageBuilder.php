<?php

declare(strict_types=1);

namespace App\Source\SystemCommunication\PushNotification\Infra\Builder;

use App\Models\PushToken;
use App\Source\SystemCommunication\PushNotification\Infra\Value\PushNotificationValueInterface;
use Exception;
use Kreait\Firebase\Messaging\CloudMessage;

class PushMessageBuilder
{
    private AndroidPushMessageBuilder $androidBuilder;
    private IphonePushMessageBuilder $iphoneBuilder;

    public function __construct(
        AndroidPushMessageBuilder $androidBuilder,
        IphonePushMessageBuilder $iphoneBuilder
    ) {
        $this->androidBuilder = $androidBuilder;
        $this->iphoneBuilder = $iphoneBuilder;
    }

    public function build(
        PushNotificationValueInterface $payload,
        PushToken $pushToken
    ): CloudMessage {
        $message = CloudMessage::withTarget('token', $pushToken->getToken());

        $message = $message
            ->withNotification([
                'title' => $payload->getTitle(),
                'body' => $payload->getBody(),
            ]);

        switch ($pushToken->getPlatform()) {
            case PushToken::PLATFORM_ANDROID:
                $message = $message->withAndroidConfig(
                    $this->androidBuilder->build($payload)
                );
                break;
            case PushToken::PLATFORM_IOS:
                $message = $message->withApnsConfig($this->iphoneBuilder->build($payload));
                break;
            default:
                throw new Exception(
                    sprintf('[FIREBASE] "%s" is unsupported mobile platform', $pushToken->getPlatform())
                );
        }

        $additionalData = array_merge($payload->getAdditionalData(), [
            'openScreen' => $payload->getOpenScreen(),
            'notificationType' => $payload->getNotificationType(),
        ]);
        $message = $message->withData($additionalData);

        return $message;
    }
}
