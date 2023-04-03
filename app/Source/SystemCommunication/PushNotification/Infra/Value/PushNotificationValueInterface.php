<?php

namespace App\Source\SystemCommunication\PushNotification\Infra\Value;

interface PushNotificationValueInterface
{
    public function getBody(): string;

    public function getTitle(): string;

    public function getReceiverId(): int;

    public function getAdditionalData(): array;

    public function getSoundForAndroid(): string;

    public function getSoundForIos(): string;

    public function getBadge(): int;

    public function getIOSCategory(): string;

    public function getImage(): string;

    public function getVideo(): string;

    public function getOpenScreen(): string;

    public function getNotificationType(): string;
}
