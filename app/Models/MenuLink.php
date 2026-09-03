<?php

namespace App\Models;

use A17\Twill\Models\Behaviors\HasRevisions;
use A17\Twill\Models\Behaviors\HasPosition;
use A17\Twill\Models\Behaviors\HasNesting;
use A17\Twill\Models\Behaviors\Sortable;
use A17\Twill\Models\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use A17\Twill\Models\Behaviors\HasRelated;

class MenuLink extends Model implements Sortable
{
    use HasRevisions, HasPosition, HasNesting, HasRelated;

    protected $fillable = [
        'published',
        'title',
        'description',
        'tree',
        'position',
    ];
    
    public function parent() :BelongsTo
    {
        return $this->belongsTo(MenuLink::class, 'parent_id')->published();
    }

    public function children() : HasMany
    {
        return $this->hasMany(MenuLink::class, 'parent_id')->published()->orderBy('position', 'asc');
    }
    
}
