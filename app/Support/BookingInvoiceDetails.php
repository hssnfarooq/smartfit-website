<?php

namespace App\Support;

use Carbon\Carbon;
use Carbon\CarbonInterface;

class BookingInvoiceDetails
{
    public static function location($order): array
    {
        $meta = (array) data_get($order, 'meta', []);
        $location = (array) ($meta['service_location'] ?? []);

        return [
            'title' => (string) ($location['title'] ?? env('PDF_ORDER_NAME', 'Smartfit Autos')),
            'address' => (string) ($location['address'] ?? env('FIZICKA_ADRESA', '7 Welland Rd, Dogsthorpe, Peterborough, PE1 3SA')),
            'phone' => (string) ($location['phone'] ?? env('OPCENITO_TELEFON', '01733 569998')),
            'email' => (string) ($location['email'] ?? env('OPCENITO_EMAIL', 'info@smartfitautos.co.uk')),
        ];
    }

    public static function formatDate($date): string
    {
        if (empty($date)) {
            return '';
        }

        $value = $date instanceof CarbonInterface ? $date->copy() : Carbon::parse($date);

        return $value->timezone('Europe/London')->format('j F Y');
    }

    public static function isPaidOnline($order): bool
    {
        return in_array((string) data_get($order, 'status', ''), ['payment-received', 'paid'], true);
    }
}
