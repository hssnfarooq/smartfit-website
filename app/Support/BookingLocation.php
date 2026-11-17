<?php

namespace App\Support;

use InvalidArgumentException;

class BookingLocation
{
    private const DEFAULT_GARAGE_SLUG = 'hiq-welland-road';

    public function ensureSelected(): void
    {
        $sessionKey = env('LOKACIJA_KUKI', 'lokacija');

        if (session()->exists($sessionKey)) {
            return;
        }

        $this->select(self::DEFAULT_GARAGE_SLUG);
    }

    public function all(): array
    {
        return GarageCatalog::all();
    }

    public function find(string $slug): ?object
    {
        $garage = GarageCatalog::find($slug);

        return $garage ? $this->toSessionGarage($garage) : null;
    }

    public function select(string $slug): object
    {
        $garage = $this->find($slug);

        if ($garage === null) {
            throw new InvalidArgumentException('The selected SmartFit garage is not configured.');
        }

        session()->put(env('LOKACIJA_KUKI', 'lokacija'), $garage);

        return $garage;
    }

    private function toSessionGarage(array $garage): object
    {
        return (object) [
            'slug' => $garage['slug'],
            'title' => $garage['name'],
            'address' => $garage['address'],
            'postcode' => $garage['postcode'],
            'phone' => $garage['phone'],
            'email' => $garage['email'],
        ];
    }
}
