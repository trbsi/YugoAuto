<?php

namespace App\Source\Ride\Domain\Traits;

use App\Enum\TimeEnum;
use DateTimeZone;
use Illuminate\Support\Carbon;

trait RideTimeTrait
{
    public function getTimezonedTime(
        string $time,
        string $countryCode
    ): Carbon {
        $timezones = DateTimeZone::listIdentifiers(DateTimeZone::PER_COUNTRY, $countryCode);
        return Carbon::createFromFormat(TimeEnum::DATETIME_FORMAT->value, $time, $timezones[0] ?? 'UTC');
    }
}
