<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ConvertToSnakeCaseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $snakeCased = $this->convertKeysToSnakeCase($request->all());
        $request->replace($snakeCased);
        return $next($request);
    }

    /**
     * Recursively convert array keys to snake_case
     *
     * @param  array  $array
     * @return array
     */
    private function convertKeysToSnakeCase(array $array)
    {
        $result = [];
        foreach ($array as $key => $value) {
            $key = \Illuminate\Support\Str::snake($key);
            $result[$key] = is_array($value) ? $this->convertKeysToSnakeCase($value) : $value;
        }
        return $result;
    }
}
