<?php

namespace App\Support;

class BookingLocation
{
    private const DEFAULT_GARAGE_SLUG = 'hiq-welland-road';

    public function ensureSelected(): void
    {
        $sessionKey = env('LOKACIJA_KUKI', 'lokacija');

        if (request()->session()->exists($sessionKey)) {
            return;
        }

        $garage = GarageCatalog::find(self::DEFAULT_GARAGE_SLUG);

        if ($garage === null) {
            throw new \LogicException('The default SmartFit booking garage is not configured.');
        }

        request()->session()->put($sessionKey, (object) [
            'slug' => $garage['slug'],
            'title' => $garage['name'],
            'address' => $garage['address'],
            'postcode' => $garage['postcode'],
            'phone' => $garage['phone'],
            'email' => $garage['email'],
        ]);
    }
}
