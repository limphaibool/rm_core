<?php

namespace App\Data;

use Exception;
use App\Models\User;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;
use Spatie\LaravelData\Attributes\MapName;
use Illuminate\Contracts\Validation\Validator;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Mappers\CamelCaseMapper;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;
use Spatie\LaravelData\Attributes\MapOutputName;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Support\Validation\ValidationContext;

class UserData extends Data
{
    public function __construct(
        #[MapInputName('user_id')]
        public int $id,
        public string $username,
        public string $name_thai,
        public string $name_eng,
        public string $email,
        public ?RoleData $role,
        public bool $enabled
    ) {
    }

    public static function fromModel(User $user): self
    {
        return new self(
            id: $user->user_id,
            username: $user->username,
            name_thai: $user->name_thai,
            name_eng: $user->name_eng,
            email: $user->email,
            enabled: $user->enabled,
            role: $user->role != null ? RoleData::from($user->role) : null
        );
    }

}
