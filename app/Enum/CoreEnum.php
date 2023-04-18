<?php

namespace App\Enum;

enum CoreEnum: string
{
    case PHONE_REGEX = '/^\+[1-9][0-9]{7,14}$/';
}
