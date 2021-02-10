<?php

namespace App\Models;

use App\Models\Traits\StoryTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Correction extends Model
{
    use StoryTrait;
    
    /**
     * @var array
     */
    protected $guarded = [];
    
    /**
     * @return BelongsTo
     */
    public function fragment()
    {
        return $this->belongsTo(Fragment::class);
    }
}
