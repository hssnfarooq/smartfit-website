<?php

namespace Tests\Feature;

use App\Support\BookingInvoiceDetails;
use App\Support\BookingLocation;
use Carbon\Carbon;
use App\Http\Livewire\Modals\Lokacija;
use Livewire\Livewire;
use Tests\TestCase;

class BookingInvoicePresentationTest extends TestCase
{
    public function test_booking_page_displays_the_service_centre_selector(): void
    {
        $view = file_get_contents(resource_path('views/livewire/booking-stranica.blade.php'));

        $this->assertMatchesRegularExpression('/^\s*<livewire:components\.order\.lokacija>/m', $view);
    }

    public function test_all_configured_garages_can_be_selected_for_a_booking(): void
    {
        request()->setLaravelSession(app('session.store'));
        $bookingLocation = app(BookingLocation::class);

        $this->assertCount(6, $bookingLocation->all());

        $selected = $bookingLocation->select('smartfit-lincoln-road');

        $this->assertSame('419 Lincoln Rd, Peterborough, PE1 2PF', $selected->address);
        $this->assertSame(
            'smartfit-lincoln-road',
            data_get(session(env('LOKACIJA_KUKI', 'lokacija')), 'slug')
        );
    }

    public function test_service_centre_modal_renders_all_garages_without_public_object_state(): void
    {
        $this->withSession([]);

        Livewire::test(Lokacija::class)
            ->assertSee('Select service location')
            ->assertSeeHtml('modal-dialog modal-dialog-scrollable')
            ->assertSeeHtml('class="service-centre-picker mb-3"')
            ->assertSeeHtml('type="radio"')
            ->assertDontSeeHtml('<select')
            ->assertSee('39 Northfield Rd, Peterborough, PE1 3QQ')
            ->assertSee('Nursery Rd, Huntingdon, PE29 3RJ');
    }

    public function test_invoice_uses_the_selected_garage_details(): void
    {
        $order = (object) [
            'meta' => [
                'service_location' => [
                    'title' => 'Kennings Auto Centre',
                    'address' => '343 Eastfield Rd, Peterborough, PE1 4RA',
                    'phone' => '01733 569998',
                    'email' => 'info@smartfitautos.co.uk',
                ],
            ],
        ];

        $this->assertSame([
            'title' => 'Kennings Auto Centre',
            'address' => '343 Eastfield Rd, Peterborough, PE1 4RA',
            'phone' => '01733 569998',
            'email' => 'info@smartfitautos.co.uk',
        ], BookingInvoiceDetails::location($order));
    }

    public function test_invoice_dates_use_a_readable_uk_format(): void
    {
        $this->assertSame(
            '11 November 2026',
            BookingInvoiceDetails::formatDate(Carbon::parse('2026-11-11 11:38:00'))
        );
    }

    public function test_successful_stripe_orders_are_marked_as_paid_online(): void
    {
        $paidOrder = (object) [
            'status' => 'payment-received',
            'meta' => ['payment_intent' => 'pi_123'],
        ];
        $unpaidOrder = (object) [
            'status' => 'awaiting-payment',
            'meta' => [],
        ];

        $this->assertTrue(BookingInvoiceDetails::isPaidOnline($paidOrder));
        $this->assertFalse(BookingInvoiceDetails::isPaidOnline($unpaidOrder));
    }

    public function test_every_invoice_view_uses_selected_location_date_and_payment_helpers(): void
    {
        $views = [
            resource_path('views/mail/finished-alert-mail.blade.php'),
            resource_path('views/mail/finished-mail.blade.php'),
            resource_path('views/vendor/adminhub/pdf/order.blade.php'),
        ];

        foreach ($views as $view) {
            $source = file_get_contents($view);

            $this->assertStringContainsString('BookingInvoiceDetails::location($order)', $source, $view);
            $this->assertStringContainsString('BookingInvoiceDetails::formatDate', $source, $view);
            $this->assertStringContainsString('BookingInvoiceDetails::isPaidOnline($order)', $source, $view);
        }
    }
}
