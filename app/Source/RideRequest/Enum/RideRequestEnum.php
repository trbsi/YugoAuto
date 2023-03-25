<?php

namespace App\Source\RideRequest\Enum;

use ArchTech\Enums\Values;

enum RideRequestEnum: string
{
    use Values;

    case PENDING = 'pending';
    case ACCEPTED = 'accepted';
    case REJECTED = 'rejected';
    case CANCELLED = 'cancelled';
}
