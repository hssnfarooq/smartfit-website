<?php

namespace App\Repositories;

use A17\Twill\Repositories\Behaviors\HandleRevisions;
use A17\Twill\Repositories\ModuleRepository;
use App\Models\Testimonial;

class TestimonialRepository extends ModuleRepository
{
    use HandleRevisions;

    public function __construct(Testimonial $model)
    {
        $this->model = $model;
    }
}
