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
        #[MapName('role_id')]
        public int $id,
        #[MapName('role_name')]
        public string $name
    ) {
    }
}
