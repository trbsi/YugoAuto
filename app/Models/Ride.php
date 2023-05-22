<?php

namespace App\Models;

use App\Source\RideRequest\Enum\RideRequestEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

/**
 * App\Models\Ride
 *
 * @property int $id
 * @property int $driver_id
 * @property int $country_id
 * @property int $from_place_id
 * @property int $to_place_id
 * @property Carbon $time
 * @property Carbon $time_utc
 * @property int $price
 * @property string $currency
 * @property int $number_of_seats
 * @property string|null $description
 * @property bool $is_accepting_package
 * @property string|null $car
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\RideRequest> $acceptedRideRequests
 * @property-read int|null $accepted_ride_requests_count
 * @property-read \App\Models\User $driver
 * @property-read \App\Models\Place $fromPlace
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\RideRequest> $pendingRideRequests
 * @property-read int|null $pending_ride_requests_count
 * @property-read \App\Models\RideRequest|null $rideRequestForAuthUser
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\RideRequest> $rideRequests
 * @property-read int|null $ride_requests_count
 * @property-read \App\Models\Place $toPlace
 * @method static \Database\Factories\RideFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Ride newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Ride newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Ride onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Ride query()
 * @method static \Illuminate\Database\Eloquent\Builder|Ride whereCar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ride whereCountryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ride whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ride whereCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ride whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ride whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ride whereDriverId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ride whereFromPlaceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ride whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ride whereIsAcceptingPackage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ride whereNumberOfSeats($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ride wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ride whereTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ride whereTimeUtc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ride whereToPlaceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ride whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ride withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Ride withoutTrashed()
 * @mixin \Eloquent
 */
class Ride extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $casts = [
        'time' => 'datetime',
        'time_utc' => 'datetime',
        'is_accepting_package' => 'boolean',
    ];

    public function fromPlace(): BelongsTo
    {
        return $this->belongsTo(Place::class, 'from_place_id', 'id');
    }

    public function toPlace(): BelongsTo
    {
        return $this->belongsTo(Place::class, 'to_place_id', 'id');
    }

    public function driver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'driver_id', 'id');
    }

    public function rideRequests(): HasMany
    {
        return $this->hasMany(RideRequest::class, 'ride_id', 'id');
    }

    public function pendingRideRequests(): HasMany
    {
        return $this->hasMany(RideRequest::class, 'ride_id', 'id')
            ->where('status', RideRequestEnum::PENDING->value);
    }

    public function acceptedRideRequests(): HasMany
    {
        return $this->hasMany(RideRequest::class, 'ride_id', 'id')
            ->where('status', RideRequestEnum::ACCEPTED->value);
    }

    public function rideRequestForAuthUser(): HasOne
    {
        return $this->hasOne(RideRequest::class, 'ride_id', 'id')
            ->where('passenger_id', Auth::id());
    }

    public function transitCities(): BelongsToMany
    {
        return $this->belongsToMany(Place::class, 'transit_cities');
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getDriverId(): int
    {
        return $this->driver_id;
    }

    public function isOwner(): int
    {
        return $this->getDriverId() === Auth::id();
    }

    public function setDriverId(int $driver_id): self
    {
        $this->driver_id = $driver_id;
        return $this;
    }

    public function getFromPlaceId(): int
    {
        return $this->from_place_id;
    }

    public function setFromPlaceId(int $from_place_id): self
    {
        $this->from_place_id = $from_place_id;
        return $this;
    }

    public function getToPlaceId(): int
    {
        return $this->to_place_id;
    }

    public function setToPlaceId(int $to_place_id): self
    {
        $this->to_place_id = $to_place_id;
        return $this;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;
        return $this;
    }

    public function getNumberOfSeats(): int
    {
        return $this->number_of_seats;
    }

    public function setNumberOfSeats(int $number_of_seats): self
    {
        $this->number_of_seats = $number_of_seats;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getDescriptionFormatted(): ?string
    {
        return strip_tags(nl2br($this->description), '<br>');
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function getRideTime(): Carbon
    {
        return $this->time;
    }

    public function getRideTimeFormatted(): string
    {
        return $this->getRideTime()->format('d.m.Y. H:i');
    }

    public function setRideTime(Carbon $time): self
    {
        $this->time = $time;
        return $this;
    }

    public function getRideTimeUtc(): Carbon
    {
        return $this->time_utc;
    }

    public function setRideTimeUtc(Carbon $time_utc): self
    {
        $this->time_utc = $time_utc;
        return $this;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function setCurrency(string $currency): self
    {
        $this->currency = $currency;
        return $this;
    }

    private int $accepting_package;

    public function getIsAcceptingPackage(): bool
    {
        return $this->is_accepting_package;
    }

    public function setIsAcceptingPackage(bool $accepting_package): self
    {
        $this->is_accepting_package = $accepting_package;
        return $this;
    }

    public function getCountryId(): int
    {
        return $this->country_id;
    }

    public function setCountryId(int $country_id): self
    {
        $this->country_id = $country_id;
        return $this;
    }

    public function getCar(): ?string
    {
        return $this->car;
    }

    public function setCar(?string $car): self
    {
        $this->car = $car;
        return $this;
    }


    /* HELPER METHODS */
    public function canLeaveRating(): bool
    {
        return
            $this->isNonActiveRide() &&
            (
                //user is driver and has accepted ride requests
                $this->isOwner() ||
                (
                    //user is passenger and status is accepted
                    $this->rideRequestForAuthUser &&
                    (
                        $this->rideRequestForAuthUser->isAccepted() ||
                        $this->rideRequestForAuthUser->isCancelledAtLastMinute()
                    )
                )
            );
    }

    public function isFilled(): bool
    {
        return $this->acceptedRideRequests->count() >= $this->getNumberOfSeats();
    }

    public function isMyRide(): bool
    {
        return $this->getDriverId() === Auth::id();
    }

    public function isNonActiveRide(): bool
    {
        return $this->getRideTimeUtc() < Carbon::now();
    }

    public function isActiveRide(): bool
    {
        return $this->getRideTimeUtc() > Carbon::now();
    }
}

