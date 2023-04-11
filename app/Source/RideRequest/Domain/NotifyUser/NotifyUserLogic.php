<?php

declare(strict_types=1);

namespace App\Source\RideRequest\Domain\NotifyUser;

use App\Models\Conversation;
use App\Models\Message;
use App\Models\Ride;
use App\Models\RideRequest;
use App\Models\User;
use App\Source\RideRequest\Enum\RideRequestEnum;
use App\Source\SystemCommunication\Base\Infra\Events\SystemCommunicationEvent;
use App\Source\SystemCommunication\Email\Infra\Value\EmailSystemCommunicationValue;
use App\Source\SystemCommunication\Email\Infra\Value\ViewDataValue;
use App\Source\SystemCommunication\PushNotification\Infra\Value\PushNotificationConversationValue;
use App\Source\SystemCommunication\PushNotification\Infra\Value\PushNotificationGenericValue;

class NotifyUserLogic
{
    public static function notifyPassengerAboutAcceptOrReject(RideRequest $rideRequest): void
    {
        $subject = $body = match ($rideRequest->getStatus()) {
            RideRequestEnum::ACCEPTED->value => __('Driver accepted your request'),
            RideRequestEnum::REJECTED->value => __('Driver rejected your request'),
        };

        $passenger = $rideRequest->passenger;

        $viewData = new ViewDataValue(
            body: $body,
            buttonUrl: route('ride.my-rides'),
            buttonText: __('View ride requests')
        );
        $emailEvent = new EmailSystemCommunicationValue(
            toEmails: [$passenger->getEmail()],
            subject: $subject,
            viewData: $viewData
        );

        $pushEvent = new PushNotificationGenericValue(
            title: $subject,
            body: $body,
            receiverId: $passenger->getId(),
            additionalData: [
                'rideId' => $rideRequest->getRideId()
            ],
            openScreen: PushNotificationGenericValue::OPEN_SCREEN_MY_RIDES
        );

        SystemCommunicationEvent::dispatch($emailEvent, $pushEvent);
    }

    public static function sendCancellationNotification(RideRequest $rideRequest, int $authUserId): void
    {
        $toPerson = ($rideRequest->getPassengerId() === $authUserId) ?
            $rideRequest->ride->driver :
            $rideRequest->passenger;

        $cancelledBy = ($rideRequest->getPassengerId() === $authUserId) ?
            $rideRequest->passenger :
            $rideRequest->ride->driver;

        $subject = __('Your ride is cancelled');
        $body = __('Person cancelled a ride', ['name' => $cancelledBy->getName()]);

        $viewData = new ViewDataValue(
            body: $body,
            buttonUrl: route('ride.my-rides'),
            buttonText: __('View ride requests')
        );

        $emailEvent = new EmailSystemCommunicationValue(
            toEmails: [$toPerson->getEmail()],
            subject: $subject,
            viewData: $viewData
        );

        $pushEvent = new PushNotificationGenericValue(
            title: $subject,
            body: $body,
            receiverId: $toPerson->getId(),
            additionalData: [
                'rideId' => $rideRequest->getRideId()
            ],
            openScreen: PushNotificationGenericValue::OPEN_SCREEN_MY_RIDES
        );

        SystemCommunicationEvent::dispatch($emailEvent, $pushEvent);
    }

    public static function notifyDriverAboutRideRequest(Ride $ride, RideRequest $rideRequest): void
    {
        $toPerson = $ride->driver;
        $subject = __('You have a new ride request');
        $body = __('Somebody left you a request', ['name' => $rideRequest->passenger->getName()]);

        $viewData = new ViewDataValue(
            body: $body,
            buttonUrl: single_ride_requests_url($ride->getId()),
            buttonText: __('View ride requests')
        );
        $emailEvent = new EmailSystemCommunicationValue(
            toEmails: [$toPerson->getEmail()],
            subject: $subject,
            viewData: $viewData
        );

        $pushEvent = new PushNotificationGenericValue(
            title: $subject,
            body: $body,
            receiverId: $toPerson->getId(),
            additionalData: [
                'rideId' => $rideRequest->getRideId()
            ],
            openScreen: PushNotificationGenericValue::OPEN_SCREEN_MY_RIDES
        );

        SystemCommunicationEvent::dispatch($emailEvent, $pushEvent);
    }

    private static function sendPush(
        Conversation $conversation,
        Message $lastMessage,
        User $sender
    ): void {
        $event = new PushNotificationConversationValue(
            title: $sender->getName(),
            body: substr($lastMessage->getContent(), 0, 200),
            conversationId: $conversation->getId(),
            senderId: $sender->getId()
        );

        SystemCommunicationEvent::dispatch($event);
    }
}
