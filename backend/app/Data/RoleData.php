<?php

namespace App\Data;

use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\Validation\Required;

class RoleData extends Data
{
    public function __construct(
        #[MapInputName('role_id')]
        public int $id,
        #[MapInputName('role_name')]
        public string $name
    ) {
    }
}
