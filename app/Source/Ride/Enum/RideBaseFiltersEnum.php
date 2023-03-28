<?php

namespace App\Source\Ride\Enum;

use ArchTech\Enums\Values;

enum RideBaseFiltersEnum: string
{
    use Values;

    case FROM_PLACE = 'from_place_id';
    case TO_PLACE = 'to_place_id';
    case TIME = 'time';
}
