<?php

namespace App\Repositories;


use A17\Twill\Repositories\ModuleRepository;
use App\Models\Import;

class ImportRepository extends ModuleRepository
{
    

    public function __construct(Import $model)
    {
        $this->model = $model;
    }
}
