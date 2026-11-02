<?php

namespace App\Support;

use App\Models\ShopUser;
use App\Models\Vehicles;
use Lunar\Models\Cart;
use Lunar\Models\Customer;

class BookingCheckoutDetails
{
    public static function prepare(Cart $cart): void
    {
        $contact = request()->session()->get(env('INFO_KUKI'));
        $vehicle = request()->session()->get(env('AUTO_KUKI'));
        $location = request()->session()->get(env('LOKACIJA_KUKI'));
        $appointments = request()->session()->get(env('TERMIN_KUKI'));

        if (! $contact || ! $vehicle) {
            return;
        }

        $registration = (string) data_get($vehicle, 'registration');
        $email = (string) data_get($contact, 'email');

        if ($registration === '' || $email === '') {
            return;
        }

        $address = [
            'country_id' => 235,
            'title' => data_get($contact, 'title'),
            'first_name' => (string) data_get($contact, 'name', ''),
            'last_name' => (string) data_get($contact, 'last_name', ''),
            'company_name' => null,
            'line_one' => '-',
            'line_two' => null,
            'line_three' => null,
            'city' => '-',
            'state' => null,
            'postcode' => '-',
            'delivery_instructions' => null,
            'contact_email' => $email,
            'contact_phone' => (string) data_get($contact, 'telephone', ''),
            'meta' => null,
        ];

        $cart->setBillingAddress($address);
        $cart->setShippingAddress($address);

        $vehicleModel = Vehicles::firstOrCreate(
            ['registration' => $registration],
            [
                'meta' => json_encode(self::vehicleDetails($vehicle), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE),
            ]
        );

        $user = ShopUser::firstOrCreate(
            ['email' => $email],
            [
                'name' => (string) data_get($contact, 'name', ''),
                'password' => '-',
            ]
        );

        $customer = Customer::firstOrCreate(
            ['account_ref' => $registration],
            [
                'title' => data_get($contact, 'title'),
                'first_name' => (string) data_get($contact, 'name', ''),
                'last_name' => (string) data_get($contact, 'last_name', ''),
                'company_name' => '',
                'vat_no' => '',
                'meta' => [
                    'future_communications' => data_get($contact, 'futureCommunications'),
                    'vehicle_id' => $vehicleModel->id,
                ] + self::vehicleDetails($vehicle),
            ]
        );

        $customer->users()->syncWithoutDetaching([$user->id]);
        $cart->setCustomer($customer);

        $meta = (array) $cart->meta;
        $meta['vehicle'] = self::vehicleDetails($vehicle);
        $meta['service_location'] = self::locationDetails($location);
        $meta['preferred_appointments'] = self::appointmentDetails($appointments);
        $cart->update(['meta' => $meta]);
    }

    private static function vehicleDetails($vehicle): array
    {
        return [
            'registration' => (string) data_get($vehicle, 'registration', ''),
            'make' => (string) data_get($vehicle, 'make', ''),
            'model' => (string) data_get($vehicle, 'model', ''),
            'registration_date' => (string) data_get($vehicle, 'registrationDate', ''),
            'fuel_type' => (string) data_get($vehicle, 'fuelType', ''),
            'mot_due_date' => (string) (data_get($vehicle, 'motTests.0.expiryDate') ?: data_get($vehicle, 'motTestDueDate', '')),
        ];
    }

    private static function locationDetails($location): array
    {
        if (! $location) {
            return [];
        }

        return [
            'title' => (string) data_get($location, 'title', ''),
            'address' => (string) data_get($location, 'address', ''),
            'phone' => (string) data_get($location, 'phone', ''),
            'email' => (string) data_get($location, 'email', ''),
        ];
    }

    private static function appointmentDetails($appointments): array
    {
        return collect($appointments ?: [])->map(function ($appointment) {
            return [
                'date' => (string) data_get($appointment, '0', ''),
                'time_of_day' => (string) data_get($appointment, '1', ''),
            ];
        })->values()->all();
    }
}
