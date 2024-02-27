<?php

namespace App\Traits;

use Illuminate\Support\Str;
use ReflectionClass;

trait HasConstants
{
    /**
     * @param string $prefix
     * @return array
     */
    public static function getConstantsWithPrefix(string $prefix): array
    {
        $constants = [];

        foreach ((new ReflectionClass(__CLASS__))->getConstants() as $constant => $value) {
            if (Str::startsWith($constant, $prefix)) {
                $constants[] = $value;
            }
        }

        return $constants;
    }
}
