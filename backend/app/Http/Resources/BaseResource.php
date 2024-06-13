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
        $camelCaseArray = [];
        foreach ($array as $key => $value) {
            // Here we use the Str::camel() method from Laravel
            $camelKey = Str::camel($key);
            // Recursively convert nested arrays
            $camelCaseArray[$camelKey] = is_array($value) ? $this->toCamelCase($key) : $value;
        }
        return $camelCaseArray;
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
