<?php

namespace App\Actions\Variables;

class StringActions
{
    public static function isEqual(string $first, string $second): bool
    {
        return (new static())->check($first, $second);
    }

    protected function check(string $first, string $second): string
    {
        return $first === $second;
    }
}
