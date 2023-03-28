<?php

namespace App\Source\Ride\Enum;

use ArchTech\Enums\Values;

enum RideFiltersEnum: string
{
    use Values;

    case PRICE_LOWEST = 'price_lowest';
    case PRICE_HIGHEST = 'price_highest';
    case TIME_EARLIEST = 'time_earliest';
    case TIME_LATEST = 'time_latest';
}
