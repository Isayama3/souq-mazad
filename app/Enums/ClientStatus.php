<?php

namespace App\Enums;

use App\Traits\EnumCustom;

enum ClientStatus: string
{
    use EnumCustom;
    case BLOCKED  = 'blocked';
    case ACTIVE   = 'active';
}
