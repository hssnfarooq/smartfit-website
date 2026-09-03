<?php

namespace App\Models;

use A17\Twill\Models\Behaviors\HasBlocks;
use A17\Twill\Models\Behaviors\HasMedias;
use A17\Twill\Models\Behaviors\HasFiles;
use A17\Twill\Models\Behaviors\HasRevisions;
use A17\Twill\Models\Model;

class Location extends Model 
{
    use HasBlocks, HasMedias, HasFiles, HasRevisions;

    protected $fillable = [
        'published',
        'title',
        'phone', 
        'email', 
        'web',
        'description',
        'address',
        'g_map',
    ];
    
}