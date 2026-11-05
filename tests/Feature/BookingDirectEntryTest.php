<?php

namespace Tests\Feature;

use App\Support\BookingLocation;
use Tests\TestCase;

class BookingDirectEntryTest extends TestCase
{
    public function test_direct_booking_entry_assigns_the_main_smartfit_garage(): void
    {
        request()->setLaravelSession(app('session.store'));
        $sessionKey = env('LOKACIJA_KUKI', 'lokacija');

        session()->forget($sessionKey);

        app(BookingLocation::class)->ensureSelected();

        $this->assertTrue(session()->has($sessionKey));
        $this->assertSame('hiq-welland-road', data_get(session($sessionKey), 'slug'));
        $this->assertSame(
            '7 Welland Rd, Dogsthorpe, Peterborough, PE1 3SA',
            data_get(session($sessionKey), 'address')
        );
    }

    public function test_direct_booking_entry_preserves_a_garage_selected_on_the_homepage(): void
    {
        request()->setLaravelSession(app('session.store'));
        $sessionKey = env('LOKACIJA_KUKI', 'lokacija');
        $selectedGarage = (object) [
            'slug' => 'hiq-huntingdon',
            'title' => 'HiQ Tyres & Autocare Huntingdon',
            'address' => 'Selected garage address',
        ];

        session()->put($sessionKey, $selectedGarage);

        app(BookingLocation::class)->ensureSelected();

        $this->assertSame($selectedGarage, session($sessionKey));
    }

    public function test_booking_page_initializes_the_location_before_rendering(): void
    {
        $controller = file_get_contents(app_path('Http/Controllers/PageDisplayController.php'));

        $this->assertStringContainsString('BookingLocation $bookingLocation', $controller);
        $this->assertStringContainsString('$bookingLocation->ensureSelected();', $controller);
    }
}
