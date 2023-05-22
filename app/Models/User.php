<?php

namespace App\Models;

use App\Models\User\AdditionalPhonesCollection;
use App\Models\User\AdditionalPhoneValue;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string|null $phone_number
 * @property array|null $additional_phones
 * @property bool $is_phone_number_verified
 * @property int $is_phone_number_public
 * @property Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $two_factor_secret
 * @property string|null $two_factor_recovery_codes
 * @property string|null $two_factor_confirmed_at
 * @property string|null $remember_token
 * @property int|null $current_team_id
 * @property string|null $profile_photo_path
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read \App\Models\DriverProfile|null $driverProfile
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \App\Models\UserProfile|null $profile
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\SocialLogin> $socialLogins
 * @property-read int|null $social_logins_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAdditionalPhones($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCurrentTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIsPhoneNumberPublic($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIsPhoneNumberVerified($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhoneNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereProfilePhotoPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTwoFactorConfirmedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTwoFactorRecoveryCodes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTwoFactorSecret($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|User withoutTrashed()
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\SocialLogin> $socialLogins
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\SocialLogin> $socialLogins
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @mixin \Eloquent
 */
class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_phone_number_verified' => 'boolean',
        'additional_phones' => 'array',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function profile(): HasOne
    {
        return $this->hasOne(UserProfile::class, 'user_id', 'id');
    }

    public function driverProfile(): HasOne
    {
        return $this->hasOne(DriverProfile::class, 'user_id', 'id');
    }

    public function socialLogins(): HasMany
    {
        return $this->hasMany(SocialLogin::class, 'user_id', 'id');
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getProfilePhotoPath(): string
    {
        return $this->profile_photo_path;
    }

    public function setProfilePhotoPath(string $profile_photo_path): self
    {
        $this->profile_photo_path = $profile_photo_path;
        return $this;
    }

    public function getProfilePhotoUrl(): string
    {
        return $this->profile_photo_url;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phone_number;
    }

    public function hasPhoneNumber(): bool
    {
        return $this->getPhoneNumber() !== null;
    }

    public function setPhoneNumber(?string $phone_number): self
    {
        $this->phone_number = $phone_number;
        return $this;
    }

    public function isPhoneNumberPublic(): bool
    {
        return $this->is_phone_number_public;
    }

    public function setIsPhoneNumberPublic(bool $isPhoneNumberPublic): self
    {
        $this->is_phone_number_public = $isPhoneNumberPublic;
        return $this;
    }

    public function isPhoneNumberVerified(): bool
    {
        return $this->is_phone_number_verified;
    }

    public function setIsPhoneNumberVerified(bool $is_phone_number_verified): self
    {
        $this->is_phone_number_verified = $is_phone_number_verified;
        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }

    public function getEmailVerifiedAt(): Carbon
    {
        return $this->email_verified_at;
    }

    public function setEmailVerifiedAt(Carbon $email_verified_at): self
    {
        $this->email_verified_at = $email_verified_at;
        return $this;
    }

    public function getAdditionalPhones(): array
    {
        return $this->additional_phones ?: [];
    }

    public function getAdditionalPhonesCollection(): AdditionalPhonesCollection
    {
        if (!$this->getAdditionalPhones()) {
            return new AdditionalPhonesCollection();
        }

        return new AdditionalPhonesCollection(
            ...array_map(
                fn(array $value): AdditionalPhoneValue => new AdditionalPhoneValue(
                    phoneNumber: $value['phoneNumber'],
                    isVerified: $value['isVerified']
                ),
                $this->getAdditionalPhones()
            )
        );
    }

    public function setAdditionalPhones(AdditionalPhonesCollection $phoneCollection): self
    {
        if ($phoneCollection->isEmpty()) {
            $this->additional_phones = null;
        } else {
            $this->additional_phones = $phoneCollection->toArray();
        }
        return $this;
    }
}
