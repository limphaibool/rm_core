<?php

namespace App\Data;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Attributes\MapInputName;

class UserData extends Data
{
    #[MapInputName(SnakeCaseMapper::class)]
    public function __construct(
        #[MapInputName('user_id')]
        public int $id,
        public string $username,
        public string $nameThai,
        public string $nameEng,
        public string $email,
        public bool $enabled
    ) {
    }
}
