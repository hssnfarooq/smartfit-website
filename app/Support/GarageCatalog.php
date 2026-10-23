<?php

namespace App\Support;

class GarageCatalog
{
    private const EARTH_RADIUS_MILES = 3958.7613;

    public static function all(): array
    {
        return array_values(config('garages', []));
    }

    public static function find(string $slug): ?array
    {
        $garage = config("garages.{$slug}");

        return is_array($garage) ? $garage : null;
    }

    public static function nearest(float $latitude, float $longitude): array
    {
        $nearest = null;
        $shortestDistance = PHP_FLOAT_MAX;

        foreach (self::all() as $garage) {
            $distance = self::distanceInMiles(
                $latitude,
                $longitude,
                (float) $garage['latitude'],
                (float) $garage['longitude']
            );

            if ($distance < $shortestDistance) {
                $nearest = $garage;
                $shortestDistance = $distance;
            }
        }

        if ($nearest === null) {
            return [];
        }

        $nearest['distance_miles'] = round($shortestDistance, 1);

        return $nearest;
    }

    private static function distanceInMiles(
        float $fromLatitude,
        float $fromLongitude,
        float $toLatitude,
        float $toLongitude
    ): float {
        $latitudeDelta = deg2rad($toLatitude - $fromLatitude);
        $longitudeDelta = deg2rad($toLongitude - $fromLongitude);

        $a = sin($latitudeDelta / 2) ** 2
            + cos(deg2rad($fromLatitude))
            * cos(deg2rad($toLatitude))
            * sin($longitudeDelta / 2) ** 2;

        return self::EARTH_RADIUS_MILES * 2 * atan2(sqrt($a), sqrt(1 - $a));
    }
}
