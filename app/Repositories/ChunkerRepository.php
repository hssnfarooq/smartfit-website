<?php

namespace App\Repositories;

use A17\Twill\Repositories\Behaviors\HandleRevisions;
use A17\Twill\Repositories\ModuleRepository;
use App\Models\Chunker;

class ChunkerRepository extends ModuleRepository
{
    use HandleRevisions;

    public function __construct(Chunker $model)
    {
        $this->model = $model;
    }
}
