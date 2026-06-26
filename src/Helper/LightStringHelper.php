<?php

declare(strict_types=1);

namespace Corvet\LightFieldBundle\Helper;

class LightStringHelper
{
    public static function TrimOrNull(?string $value): ?string
    {
        if (null === $value) {
            return null;
        }
        $value = trim($value);

        return !empty($value) ? $value : null;
    }

    public static function NormalizeEmail(?string $value): ?string
    {
        if (null === $value) {
            return null;
        }
        $value = trim($value);

        return !empty($value) ? mb_strtolower($value) : null;
    }
}
