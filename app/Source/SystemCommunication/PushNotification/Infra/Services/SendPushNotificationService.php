<?php

declare(strict_types=1);

namespace App\Source\SystemCommunication\PushNotification\Infra\Services;

use App\Models\PushToken;
use App\Source\SystemCommunication\Base\Infra\Services\SendSystemCommunicationInterface;
use App\Source\SystemCommunication\Base\Infra\Value\SystemCommunicationValueInterface;
use App\Source\SystemCommunication\PushNotification\Infra\Value\PushNotificationConversationValue;
use App\Source\SystemCommunication\PushNotification\Infra\Value\PushNotificationGenericValue;
use App\Source\SystemCommunication\PushNotification\Infra\Value\PushNotificationValueInterface;
use Illuminate\Support\Collection;

class SendPushNotificationService implements SendSystemCommunicationInterface
{
    private FirebasePushNotificationSender $firebasePushNotificationSender;
    private GetPushTokensService $getPushTokensService;
    private UpdatePushTokenDataService $updatePushTokenDataService;

    public function __construct(
        FirebasePushNotificationSender $firebasePushNotificationSender,
        GetPushTokensService $getPushTokensService,
        UpdatePushTokenDataService $updatePushTokenDataService
    ) {
        $this->firebasePushNotificationSender = $firebasePushNotificationSender;
        $this->getPushTokensService = $getPushTokensService;
        $this->updatePushTokenDataService = $updatePushTokenDataService;
    }

    public function send(
        SystemCommunicationValueInterface|PushNotificationValueInterface $payload
    ): void {
        $tokenType = PushToken::TOKEN_TYPE_FIREBASE;

        $tokens = new Collection();
        if ($payload instanceof PushNotificationConversationValue) {
            $tokens = $this->getPushTokensService->getPushTokensFromConversation(
                $payload->getConversationId(),
                $payload->getSenderId(),
                $tokenType
            );
        } elseif ($payload instanceof PushNotificationGenericValue) {
            $tokens = $this->getPushTokensService->getPushTokensByUser(
                $payload->getReceiverId(),
                $tokenType
            );
        }

        if ($tokens->isNotEmpty()) {
            $this->firebasePushNotificationSender->sendPushNotification($payload, $tokens);
            $this->updatePushTokenDataService->update($tokens);
        }
    }
}
