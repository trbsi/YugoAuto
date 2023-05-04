<?php

namespace App\Models;

use App\Models\DriverProfile\AdditionalCarsCollection;
use App\Models\DriverProfile\AdditionalCarValue;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\DriverProfile
 *
 * @method static \Illuminate\Database\Eloquent\Builder|DriverProfile newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DriverProfile newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DriverProfile query()
 * @property int $id
 * @property int $user_id
 * @property string $car_name
 * @property string $car_plate
 * @property int $animals
 * @property int $smoking
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|DriverProfile whereAnimals($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DriverProfile whereCarName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DriverProfile whereCarPlate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DriverProfile whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DriverProfile whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DriverProfile whereSmoking($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DriverProfile whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DriverProfile whereUserId($value)
 * @property array|null $additional_cars
 * @method static \Illuminate\Database\Eloquent\Builder|DriverProfile whereAdditionalCars($value)
 * @mixin \Eloquent
 */
class DriverProfile extends Model
{
    use HasFactory;

    protected $casts = [
        'additional_cars' => 'array'
    ];

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

    public function getCarName(): string
    {
        return $this->car_name;
    }

    public function setCarName(string $car_name): self
    {
        $this->car_name = $car_name;
        return $this;
    }

    public function getCarPlate(): string
    {
        return $this->car_plate;
    }

    public function setCarPlate(string $car_plate): self
    {
        $this->car_plate = $car_plate;
        return $this;
    }

    public function animalsAllowed(): bool
    {
        return $this->animals;
    }

    public function setAnimals(bool $animals): self
    {
        $this->animals = $animals;
        return $this;
    }

    public function smokingAllowed(): bool
    {
        return $this->smoking;
    }

    public function setSmoking(bool $smoking): self
    {
        $this->smoking = $smoking;
        return $this;
    }

    public function getCarNameAndPlate(): string
    {
        return sprintf('%s (%s)', $this->getCarName(), $this->getCarPlate());
    }

    public function getAdditionalCars(): array
    {
        return $this->additional_cars ?: [];
    }

    public function getAdditionalCarsCollection(): AdditionalCarsCollection
    {
        if (!$this->getAdditionalCars()) {
            return new AdditionalCarsCollection();
        }

        return new AdditionalCarsCollection(
            ...array_map(
                fn(array $value): AdditionalCarValue => new AdditionalCarValue(
                    carName: $value['carName'],
                    carPlate: $value['carPlate']
                ),
                $this->getAdditionalCars()
            )
        );
    }

    public function setAdditionalCars(AdditionalCarsCollection $carsCollection): self
    {
        if ($carsCollection->isEmpty()) {
            $this->additional_cars = null;
        } else {
            $this->additional_cars = $carsCollection->toArray();
        }
        return $this;
    }
}
