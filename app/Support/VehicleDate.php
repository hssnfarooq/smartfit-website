<?php

namespace App\Support;

use Carbon\CarbonImmutable;
use Throwable;

final class VehicleDate
{
    public static function format(?string $date): string
    {
        if ($date === null || trim($date) === '') {
            return '';
        }

        try {
            return CarbonImmutable::parse($date)->format('d/m/Y');
        } catch (Throwable) {
            return $date;
        }
    }
}
