<?php

namespace App\Data;

use Exception;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;
use Illuminate\Contracts\Validation\Validator;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\Validation\Required;

class UserData extends Data
{
    #[MapInputName(SnakeCaseMapper::class)]
    public function __construct(
        #[MapInputName('user_id'), Required]
        public int|Optional $id,
        #[Required]
        public string|Optional $username,
        #[Required]
        public string|Optional $nameThai,
        #[Required]
        public string|Optional $nameEng,
        #[Required]
        public string|Optional $email,
        #[Required]
        public bool|Optional $enabled
    ) {
    }
}
