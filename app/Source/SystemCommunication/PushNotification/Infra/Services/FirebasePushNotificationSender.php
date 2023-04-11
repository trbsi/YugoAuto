<?php

declare(strict_types=1);

namespace App\Source\SystemCommunication\PushNotification\Infra\Services;

use App\Models\PushToken;
use App\Source\SystemCommunication\PushNotification\Infra\Builder\PushMessageBuilder;
use App\Source\SystemCommunication\PushNotification\Infra\Value\PushNotificationValueInterface;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;
use Kreait\Firebase\Contract\Messaging;
use Kreait\Firebase\Exception\FirebaseException;
use Kreait\Firebase\Exception\Messaging\InvalidMessage;

final class FirebasePushNotificationSender
{
    private Messaging $messaging;
    private PushMessageBuilder $pushMessageBuilder;

    public function __construct(
        Messaging $messaging,
        PushMessageBuilder $pushMessageBuilder
    ) {
        $this->messaging = $messaging;
        $this->pushMessageBuilder = $pushMessageBuilder;
    }

    public function sendPushNotification(
        PushNotificationValueInterface $payload,
        Collection $tokens
    ): void {
        /** @var PushToken $token */
        foreach ($tokens as $token) {
            try {
                $message = $this->pushMessageBuilder->build(
                    $payload,
                    $token,
                );

                $this->messaging->validate($message);
                $this->messaging->send($message);
            } catch (InvalidMessage $e) {
                if (str_contains($e->getMessage(), 'token is not a valid')) {
                    $token->delete();
                }
                Log::error('Firebase error InvalidMessage', [
                    'message' => $e->getMessage(),
                    'trace' => $e->getTraceAsString()
                ]);
            } catch (FirebaseException $e) {
                Log::error('Firebase error FirebaseException', [
                    'message' => $e->getMessage(),
                    'trace' => $e->getTraceAsString()
                ]);
            } catch (Exception $e) {
                Log::error('Firebase error Exception', [
                    'message' => $e->getMessage(),
                    'trace' => $e->getTraceAsString()
                ]);
            }
        }
    }
}
