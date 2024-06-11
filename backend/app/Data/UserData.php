<?php

namespace App\Data;

use Exception;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\MapOutputName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\CamelCaseMapper;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;
use Spatie\LaravelData\Optional;
use Illuminate\Contracts\Validation\Validator;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\Validation\Required;

class UserData extends Data
{
    public function __construct(
        #[MapName('user_id'), Required]
        public int|Optional $id,
        #[Required]
        public string|Optional $username,
        #[Required]
        public string|Optional $name_thai,
        #[Required]
        public string|Optional $name_eng,
        #[Required]
        public string|Optional $email,
        #[Required]
        public bool|Optional $enabled
    ) {
    }

}
