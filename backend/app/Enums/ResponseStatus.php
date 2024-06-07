<?php

namespace App\Enums;

abstract class ResponseStatus
{
    const SUCCESS = 0;
    const ERROR = 1;
    const UNAUTHENTICATED = 2;
    const UNAUTHORIZED = 3;
}
