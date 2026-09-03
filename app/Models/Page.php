<?php

namespace App\Models;

use A17\Twill\Models\Behaviors\HasBlocks;
use A17\Twill\Models\Behaviors\HasSlug;
use A17\Twill\Models\Behaviors\HasMedias;
use A17\Twill\Models\Behaviors\HasFiles;
use A17\Twill\Models\Behaviors\HasRevisions;
use A17\Twill\Models\Behaviors\HasPosition;
use A17\Twill\Models\Behaviors\HasNesting;
use A17\Twill\Models\Behaviors\Sortable;
use A17\Twill\Models\Model;
use CwsDigital\TwillMetadata\Models\Behaviours\HasMetadata;

class Page extends Model implements Sortable
{
    use HasBlocks, HasSlug, HasMedias, HasFiles, HasRevisions, HasPosition, HasNesting;

    use HasMetadata;
    public \Illuminate\Contracts\Foundation\Application|array|\Illuminate\Config\Repository|\Illuminate\Foundation\Application $metadataFallbacks = ['title', 'description'];

    public $slugBaza = '';//moja kemija

    public $mediasParams = [];

    public $filesParams = ['single_file', 'video', 'document'];
    
    protected $fillable = [
        'published',
        'title',
        'description',
        'dve_kolone',
        'position',
        'prod_id'
    ];
    
    public $slugAttributes = [
        'title',
    ];
    
}
