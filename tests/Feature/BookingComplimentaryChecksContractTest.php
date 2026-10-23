<?php

namespace Tests\Feature;

use Tests\TestCase;

class BookingComplimentaryChecksContractTest extends TestCase
{
    public function test_diagnostics_and_additional_services_are_removed_from_booking(): void
    {
        $booking = file_get_contents(resource_path('views/livewire/booking-stranica.blade.php'));

        $this->assertStringNotContainsString('dajServisGrupu(8)', $booking);
        $this->assertStringNotContainsString('dajServisGrupu(10)', $booking);
        $this->assertStringContainsString('dajServisGrupu(9)', $booking);
    }

    public function test_complimentary_check_is_visible_and_formatted_as_zero_pounds(): void
    {
        $group = file_get_contents(resource_path('views/components/servis-grupa.blade.php'));
        $checkbox = file_get_contents(resource_path('views/components/servis-item-chkbox.blade.php'));
        $guard = file_get_contents(app_path('Support/CartPriceGuard.php'));
        $loader = file_get_contents(app_path('Support/BookingServiceOptions.php'));

        $this->assertStringContainsString('BookingServiceOptions::forGroup', $group);
        $this->assertStringContainsString('in_array($groupId, [5, 9], true)', $loader);
        $this->assertStringContainsString('$isComplimentaryCheck', $checkbox);
        $this->assertStringContainsString('{{$priceLabel}}', $checkbox);
        $this->assertStringContainsString('isComplimentaryFreeCheck', $guard);
        $this->assertStringContainsString('use ($cartLinesTable, $pricesTable, $variantsTable, $productsTable, $currencyId)', $guard);
    }

    public function test_migration_sets_live_and_backup_prices_to_zero(): void
    {
        $migrationPath = database_path('migrations/2026_10_23_000005_set_free_25_point_check_price.php');

        $this->assertFileExists($migrationPath);

        $migration = file_get_contents($migrationPath);

        $this->assertStringContainsString("'lunar_product_variants', 'lunar_prices'", $migration);
        $this->assertStringContainsString("'lunar_product_variants_ORIG', 'lunar_prices_ORIG'", $migration);
        $this->assertStringContainsString("->where('product_id', 4)", $migration);
        $this->assertStringContainsString("->update(['price' => 0", $migration);
    }
}
