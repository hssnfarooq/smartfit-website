<?php

namespace App\Console\Commands;

use App\Http\Controllers\Api\V1\ProductController;
use Illuminate\Console\Command;
use Throwable;

class ImportSupplierProducts extends Command
{
    protected $signature = 'supplier-products:import';

    protected $description = 'Refresh supplier tyre stock without modifying static booking services';

    public function handle(ProductController $importer): int
    {
        try {
            $this->info($importer->importCSV());

            return self::SUCCESS;
        } catch (Throwable $exception) {
            report($exception);
            $this->error('Supplier tyre import failed: '.$exception->getMessage());

            return self::FAILURE;
        }
    }
}
