<?php

namespace App\Http\Resources;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BaseResource extends JsonResource
{
    /**
     * Convert array keys from snake_case to camelCase.
     *
     * @param array $array
     * @return array
     */
    protected function toCamelCase($array)
    {
        $result = [];
        foreach ($array as $key => $value) {
            $camelKey = Str::camel($key);
            $result[$camelKey] = is_array($value) ? $this->toCamelCase($value) : $value;
        }
        return $result;
    }

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->toCamelCase(parent::toArray($request));
    }
}
