<?php

declare(strict_types=1);

namespace App\Source\SystemCommunication\PushNotification\Infra\Value;


use App\Source\SystemCommunication\Base\Infra\Value\SystemCommunicationValueInterface;

class PushNotificationGenericValue implements SystemCommunicationValueInterface, PushNotificationValueInterface
{
    public const DEFAULT_SOUND = 'default';
    public const CUSTOM_SOUND = 'sound';
    public const OPEN_SCREEN_HOME = 'home';
    public const OPEN_SCREEN_CONVERSATIONS = 'conversations';
    public const OPEN_SCREEN_NOTIFICATIONS = 'notifications';
    public const OPEN_SCREEN_MY_RIDES = 'my_rides';
    private const NOTIFICATION_TYPE_GENERIC = 'generic';

    private string $body;
    private string $title;
    private int $receiverId;
    private array $additionalData;
    private string $sound = self::DEFAULT_SOUND;
    private int $badge = 0;
    private string $iOSCategory = '';
    private string $image = '';
    private string $video = '';
    private string $openScreen;

    public function __construct(
        string $title,
        string $body,
        int $receiverId,
        array $additionalData = [],
        string $openScreen = self::OPEN_SCREEN_HOME
    ) {
        $this->title = $title;
        $this->body = $body;
        $this->receiverId = $receiverId;
        $this->additionalData = $additionalData;
        $this->openScreen = $openScreen;
    }

    public function getBody(): string
    {
        return $this->body;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getReceiverId(): int
    {
        return $this->receiverId;
    }

    public function setReceiverId(int $receiverId): self
    {
        $this->receiverId = $receiverId;
        return $this;
    }

    public function getAdditionalData(): array
    {
        return $this->additionalData;
    }

    public function setAdditionalData(array $additionalData): self
    {
        $this->additionalData = $additionalData;
        return $this;
    }

    public function getSoundForAndroid(): string
    {
        if ($this->sound === self::DEFAULT_SOUND) {
            return $this->sound;
        }

        return $this->sound . '.mp3';
    }

    public function getSoundForIos(): string
    {
        if ($this->sound === self::DEFAULT_SOUND) {
            return $this->sound;
        }

        return $this->sound . '.caf';
    }

    public function setSound(string $sound): self
    {
        $this->sound = $sound;
        return $this;
    }

    public function getBadge(): int
    {
        return $this->badge;
    }

    public function setBadge(int $badge): self
    {
        $this->badge = $badge;
        return $this;
    }

    public function getIOSCategory(): string
    {
        return $this->iOSCategory;
    }

    public function setIOSCategory(string $iOSCategory): self
    {
        $this->iOSCategory = $iOSCategory;
        return $this;
    }

    public function getImage(): string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;
        return $this;
    }

    public function getVideo(): string
    {
        return $this->video;
    }

    public function setVideo(string $video): self
    {
        $this->video = $video;
        return $this;
    }

    public function getOpenScreen(): string
    {
        return $this->openScreen;
    }

    public function setOpenScreen(string $openScreen): self
    {
        $this->openScreen = $openScreen;
        return $this;
    }

    public function getNotificationType(): string
    {
        return self::NOTIFICATION_TYPE_GENERIC;
    }
}
