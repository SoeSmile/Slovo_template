<?php
declare(strict_types=1);

use Illuminate\Support\Str;

if (!function_exists('camelKeys')) {
    /**
     * Convert array keys to camel case recursively.
     *
     * @param array $array
     * @return array
     */
    function camelKeys($array)
    {
        $result = [];

        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $value = camelKeys($value);
            }
            $result[Str::camel($key)] = $value;
        }
        return $result;
    }
}

if (!function_exists('snakeKeys')) {
    /**
     * Convert array keys to snake case recursively.
     *
     * @param array $array
     * @param string $delimiter
     * @return array
     */
    function snakeKeys($array, $delimiter = '_')
    {
        $result = [];

        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $value = snakeKeys($value, $delimiter);
            }
            $result[Str::snake($key, $delimiter)] = $value;
        }
        return $result;
    }
}
