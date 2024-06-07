<?php

namespace App\Enums;

abstract class ResponseStatus
{
    const SUCCESS = 1;
    const ERROR = 2;
    const UNAUTHENTICATED = 3;
    const UNAUTHORIZED = 4;
}
