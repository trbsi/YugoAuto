<?php

declare(strict_types=1);

namespace App\Source\RideRequest\Domain\SendEmail;

use App\Models\Ride;
use App\Models\RideRequest;
use App\Source\RideRequest\Enum\RideRequestEnum;
use App\Source\SystemCommunication\Base\Infra\Events\SystemCommunicationEvent;
use App\Source\SystemCommunication\Email\Infra\Value\EmailSystemCommunicationValue;

class SendEmailLogic
{
    public static function sendEmailToPassenger(RideRequest $rideRequest): void
    {
        $subject = $body = match ($rideRequest->getStatus()) {
            RideRequestEnum::ACCEPTED->value => __('Driver accepted your request'),
            RideRequestEnum::REJECTED->value => __('Driver rejected your request'),
            RideRequestEnum::CANCELLED->value => __('Driver cancelled your request'),
        };

        $viewData = [
            'body' => $body,
            'buttonUrl' => route('ride.my-rides'),
            'buttonText' => __('View ride requests')
        ];
        $event = new EmailSystemCommunicationValue(
            toEmails: [$rideRequest->passenger->getEmail()],
            subject: $subject,
            viewData: $viewData
        );
        SystemCommunicationEvent::dispatch($event);
    }

    public static function sendEmailToDriver(Ride $ride, RideRequest $rideRequest): void
    {
        $viewData = [
            'body' => __('Somebody left you a request', ['name' => $rideRequest->passenger->getName()]),
            'buttonUrl' => single_ride_requests_url($ride->getId()),
            'buttonText' => __('View ride requests')
        ];
        $event = new EmailSystemCommunicationValue(
            toEmails: [$ride->driver->getEmail()],
            subject: __('You have a new ride request'),
            viewData: $viewData
        );
        SystemCommunicationEvent::dispatch($event);
    }
}
