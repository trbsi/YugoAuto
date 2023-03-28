<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use ReflectionClass;

/**
 * App\Models\SocialLogin
 *
 * @property int $id
 * @property int $user_id
 * @property string $provider
 * @property string $provider_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|SocialLogin newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SocialLogin newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SocialLogin query()
 * @method static \Illuminate\Database\Eloquent\Builder|SocialLogin whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SocialLogin whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SocialLogin whereProvider($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SocialLogin whereProviderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SocialLogin whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SocialLogin whereUserId($value)
 * @mixin \Eloquent
 */
class SocialLogin extends Model
{
    public const PROVIDER_TWITTER = 'twitter';
    public const PROVIDER_FACEBOOK = 'facebook';
    public const PROVIDER_GOOGLE = 'google';
    public const PROVIDER_DISCORD = 'discord';
    public const PROVIDER_REDDIT = 'reddit';
    public const PROVIDER_SNAPCHAT = 'snapchat';

    use HasFactory;

    public static function getProviders()
    {
        $oClass = new ReflectionClass(__CLASS__);
        $return = [];
        foreach ($oClass->getConstants() as $key => $constant) {
            if (str_starts_with($key, 'PROVIDER_')) {
                $return[] = $constant;
            }
        }
        return $return;
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getUserId(): int
    {
        return $this->user_id;
    }

    public function setUserId(int $user_id): self
    {
        $this->user_id = $user_id;
        return $this;
    }

    public function getProvider(): string
    {
        return $this->provider;
    }

    public function setProvider(string $provider): self
    {
        $this->provider = $provider;
        return $this;
    }

    public function getProviderId(): string
    {
        return $this->provider_id;
    }

    public function setProviderId(string $provider_id): self
    {
        $this->provider_id = $provider_id;
        return $this;
    }
}
