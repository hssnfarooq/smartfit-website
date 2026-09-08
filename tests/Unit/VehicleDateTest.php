<?php

namespace Tests\Unit;

use App\Support\VehicleDate;
use PHPUnit\Framework\TestCase;

class VehicleDateTest extends TestCase
{
    public function test_it_formats_dvsa_dates_in_day_month_year_order(): void
    {
        $this->assertSame('03/04/2023', VehicleDate::format('2023-04-03'));
        $this->assertSame('04/06/2027', VehicleDate::format('2027-06-04'));
    }

    public function test_it_preserves_invalid_values_and_handles_empty_dates(): void
    {
        $this->assertSame('', VehicleDate::format(null));
        $this->assertSame('', VehicleDate::format(''));
        $this->assertSame('Pending', VehicleDate::format('Pending'));
    }
}
