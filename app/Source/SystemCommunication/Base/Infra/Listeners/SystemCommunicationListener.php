<?php

namespace App\Source\SystemCommunication\Base\Infra\Listeners;

use App\Source\SystemCommunication\Base\Infra\Events\SystemCommunicationEvent;
use App\Source\SystemCommunication\Base\Infra\Exceptions\SystemCommunicationTypeNotSupportedException;
use App\Source\SystemCommunication\Email\Infra\Services\SendEmailSystemCommunicationService;
use App\Source\SystemCommunication\Email\Infra\Value\EmailSystemCommunicationValue;
use App\Source\SystemCommunication\PushNotification\Infra\Services\SendPushNotificationService;
use App\Source\SystemCommunication\PushNotification\Infra\Value\PushNotificationConversationValue;
use App\Source\SystemCommunication\PushNotification\Infra\Value\PushNotificationGenericValue;
use App\Source\SystemCommunication\Socket\Infra\Services\SendSocketSystemCommunicationService;
use App\Source\SystemCommunication\Socket\Infra\Value\SocketSystemCommunicationValueInterface;
use Illuminate\Contracts\Queue\ShouldQueue;

class SystemCommunicationListener implements ShouldQueue
{
    /**
     * The name of the queue the job should be sent to.
     *
     * @var string|null
     */
    //public $queue = 'system_notifications_queue';

    private SendEmailSystemCommunicationService $sendEmailSystemCommunicationService;
    private SendSocketSystemCommunicationService $sendSocketSystemCommunicationService;
    private SendPushNotificationService $sendPushNotificationService;

    public function __construct(
        SendEmailSystemCommunicationService $sendEmailSystemCommunicationService,
        SendSocketSystemCommunicationService $sendSocketSystemCommunicationService,
        SendPushNotificationService $sendPushNotificationService
    ) {
        $this->sendEmailSystemCommunicationService = $sendEmailSystemCommunicationService;
        $this->sendSocketSystemCommunicationService = $sendSocketSystemCommunicationService;
        $this->sendPushNotificationService = $sendPushNotificationService;
    }

    /**
     * Handle the event.
     *
     * @param SystemCommunicationEvent $event
     * @return void
     */
    public function handle(SystemCommunicationEvent $event)
    {
        foreach ($event->communicationValues as $communicationValue) {
            switch (true) {
                case ($communicationValue instanceof EmailSystemCommunicationValue):
                    $notificationService = $this->sendEmailSystemCommunicationService;
                    break;
                case ($communicationValue instanceof SocketSystemCommunicationValueInterface):
                    $notificationService = $this->sendSocketSystemCommunicationService;
                    break;
                case ($communicationValue instanceof PushNotificationConversationValue):
                case ($communicationValue instanceof PushNotificationGenericValue):
                    $notificationService = $this->sendPushNotificationService;
                    break;
                default:
                    throw new SystemCommunicationTypeNotSupportedException('Notification type not supported');
            }

            $notificationService->send($communicationValue);
        }
    }
}
