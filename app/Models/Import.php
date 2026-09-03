<?php

namespace App\Models;


use A17\Twill\Models\Model;

class Import extends Model 
{

    protected $fillable = [
        'published',
        'title',
        'description',
        'end_time',
    ];
    
}
