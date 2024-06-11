<?php

namespace App\Http\Resources;

use App\Data\UserData;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'username' => $this->username,
            'nameThai' => $this->name_thai,
            'nameEng' => $this->name_eng,
            'email' => $this->email,
            'enabled' => $this->enabled,
        ];
    }
}
