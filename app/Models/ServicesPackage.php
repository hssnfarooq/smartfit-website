<?php

namespace App\Models;

use A17\Twill\Models\Behaviors\HasBlocks;
use A17\Twill\Models\Behaviors\HasMedias;
use A17\Twill\Models\Behaviors\HasFiles;
use A17\Twill\Models\Behaviors\HasRevisions;
use A17\Twill\Models\Behaviors\HasPosition;
use A17\Twill\Models\Behaviors\Sortable;
use A17\Twill\Models\Model;

class ServicesPackage extends Model implements Sortable
{
    use HasBlocks, HasMedias, HasFiles, HasRevisions, HasPosition;

    protected $fillable = [
        'published',
        'title',
        'description',
        'long_text',
        'price',
        'action_price',
        'izdvojeno',
        'lbl',
        'position',
        'prod_id'
    ];
    
}
