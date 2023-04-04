<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use ReflectionClass;

/**
 * App\Models\PushToken
 *
 * @method static \Illuminate\Database\Eloquent\Builder|PushToken newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PushToken newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PushToken query()
 * @property int $id
 * @property int $user_id
 * @property string $platform
 * @property string $device_id
 * @property string $token
 * @property string $token_type
 * @property Carbon|null $last_push_sent_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|PushToken whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PushToken whereDeviceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PushToken whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PushToken whereLastPushSentAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PushToken wherePlatform($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PushToken whereToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PushToken whereTokenType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PushToken whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PushToken whereUserId($value)
 * @mixin \Eloquent
 */
class PushToken extends Model
{
    use HasFactory;

    public const TOKEN_TYPE_FIREBASE = 'fcm';
    public const PLATFORM_IOS = 'ios';
    public const PLATFORM_ANDROID = 'android';

    protected $fillable = [
        'user_id',
        'device_id',
        'platform',
        'token',
        'token_type'
    ];

    protected $casts = [
        'last_push_sent_at' => 'datetime'
    ];

    public static function getTokenTypes(): array
    {
        $reflectionClass = new ReflectionClass(__CLASS__);

        $constants = [];
        foreach ($reflectionClass->getConstants() as $key => $constant) {
            if (Str::startsWith($key, 'TOKEN_TYPE')) {
                $constants[] = $constant;
            }
        }

        return $constants;
    }

    public function getUser()
    {
        return $this->belongsTo(User::class);
    }

    public function getUserId(): int
    {
        return $this->user_id;
    }

    public function setUserId(int $userId): self
    {
        $this->user_id = $userId;
        return $this;
    }

    public function getToken(): string
    {
        return $this->token;
    }

    public function setToken(string $token): self
    {
        $this->token = $token;
        return $this;
    }

    public function getPlatform(): string
    {
        return $this->platform;
    }

    public function setPlatform(string $platform): self
    {
        $this->platform = $platform;
        return $this;
    }

    public function getDeviceId(): string
    {
        return $this->device_id;
    }

    public function setDeviceId(string $deviceId): self
    {
        $this->device_id = $deviceId;
        return $this;
    }

    public function getTokenType(): string
    {
        return $this->token_type;
    }

    public function setTokenType(string $tokenType): self
    {
        $this->token_type = $tokenType;
        return $this;
    }

    public function getLastPushSentAt(): ?Carbon
    {
        return $this->last_push_sent_at;
    }

    public function setLastPushSentAt(Carbon $last_push_sent_at): self
    {
        $this->last_push_sent_at = $last_push_sent_at;
        return $this;
    }
}
