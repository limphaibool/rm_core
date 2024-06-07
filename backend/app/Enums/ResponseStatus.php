<?php

namespace App\Enums;

enum ResponseStatus: int
{
    case SUCCESS = 0;
    case ERROR = 1;
    case UNAUTHENTICATED = 2;
    case UNAUTHORIZED = 3;
}
