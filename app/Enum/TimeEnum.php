<?php

namespace App\Enum;

enum TimeEnum: string
{
    case DATE_FORMAT = 'd.m.Y';
    case DATETIME_FORMAT = 'd.m.Y H:i';
}
