<?php

namespace Tests\Feature;

use App\Http\Livewire\Modals\Auto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class GarageFinderBookingHandoffTest extends TestCase
{
    public function test_booking_vehicle_modal_prefills_and_normalizes_the_registration_query(): void
    {
        Http::fake();

        $component = $this->mountAutoModalWithRegistration(' ao23   luw ');

        $this->assertSame('AO23 LUW', $component->registration);

        Http::assertNothingSent();
    }

    public function test_booking_vehicle_modal_discards_unsafe_registration_queries(): void
    {
        $component = $this->mountAutoModalWithRegistration('<script>');

        $this->assertNull($component->registration);
    }

    public function test_booking_vehicle_modal_discards_oversized_registration_queries(): void
    {
        $component = $this->mountAutoModalWithRegistration('AO23LUW1234');

        $this->assertNull($component->registration);
    }

    public function test_selecting_a_garage_does_not_call_dvsa_before_the_customer_searches(): void
    {
        Http::fake();

        $this->post('/garage-finder/select', [
            'garage' => 'hiq-welland-road',
            'registration' => 'AO23 LUW',
        ])->assertRedirect('/booking/order?registration=AO23%20LUW');

        Http::assertNothingSent();
    }

    private function mountAutoModalWithRegistration(string $registration): Auto
    {
        $request = Request::create('/booking/order', 'GET', [
            'registration' => $registration,
        ]);
        $this->app->instance('request', $request);

        $component = new Auto();
        $component->mount();

        return $component;
    }
}
