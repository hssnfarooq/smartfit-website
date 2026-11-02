<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Tests\TestCase;

class SupplierImportSecurityTest extends TestCase
{
    public function test_destructive_supplier_imports_are_not_exposed_as_public_http_routes(): void
    {
        $publicImportRoutes = collect(Route::getRoutes()->getRoutes())
            ->pluck('uri')
            ->filter(fn (string $uri) => in_array($uri, [
                'api/v1/products/importCSV',
                'api/v1/products/prepareStatic',
            ], true));

        $this->assertCount(0, $publicImportRoutes);
    }

    public function test_supplier_import_is_available_only_as_a_local_console_command(): void
    {
        $this->assertArrayHasKey('supplier-products:import', Artisan::all());
    }
}
