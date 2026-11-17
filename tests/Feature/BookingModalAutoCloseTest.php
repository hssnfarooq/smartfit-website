<?php

namespace Tests\Feature;

use App\Http\Livewire\Modals\User;
use Livewire\Livewire;
use Tests\TestCase;

class BookingModalAutoCloseTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->withSession([]);
    }

    public function test_contact_modal_closes_only_after_valid_details_are_saved(): void
    {
        $component = Livewire::test(User::class)
            ->set('title', 'Mr')
            ->set('name', 'Test')
            ->set('last_name', 'Customer')
            ->set('email', 'customer@example.com')
            ->set('telephone', '01733569998')
            ->set('gdpr', true)
            ->set('terms', true)
            ->call('sejv');

        $component->assertHasNoErrors()
            ->assertDispatchedBrowserEvent('booking-modal-saved', [
                'modalId' => 'userModal',
            ]);
    }

    public function test_contact_modal_stays_open_when_validation_fails(): void
    {
        Livewire::test(User::class)
            ->call('sejv')
            ->assertHasErrors()
            ->assertNotDispatchedBrowserEvent('booking-modal-saved');
    }

    public function test_every_booking_modal_dispatches_the_shared_close_event(): void
    {
        $components = [
            app_path('Http/Livewire/Modals/User.php') => 'userModal',
            app_path('Http/Livewire/Modals/Auto.php') => 'autoModal',
            app_path('Http/Livewire/Modals/Termin.php') => 'terminModal',
            app_path('Http/Livewire/Modals/Lokacija.php') => 'lokacijaModal',
        ];

        foreach ($components as $path => $modalId) {
            $source = file_get_contents($path);

            $this->assertStringContainsString(
                "dispatchBrowserEvent('booking-modal-saved', ['modalId' => '{$modalId}'])",
                $source,
                basename($path).' must close its modal after a successful save.'
            );
        }

        $bookingView = file_get_contents(resource_path('views/livewire/booking-stranica.blade.php'));

        $this->assertStringContainsString("window.addEventListener('booking-modal-saved'", $bookingView);
        $this->assertStringContainsString('bootstrap.Modal.getOrCreateInstance(modal).hide()', $bookingView);
    }
}
