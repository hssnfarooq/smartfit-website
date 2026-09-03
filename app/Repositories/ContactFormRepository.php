<?php

namespace App\Repositories;

use A17\Twill\Repositories\Behaviors\HandleRevisions;
use A17\Twill\Repositories\ModuleRepository;
use App\Models\ContactForm;

class ContactFormRepository extends ModuleRepository
{
    use HandleRevisions;

    public function __construct(ContactForm $model)
    {
        $this->model = $model;
    }
}
