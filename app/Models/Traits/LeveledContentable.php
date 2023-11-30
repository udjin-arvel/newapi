<?php

namespace App\Models\Traits;

use App\Models\LeveledContent;

/**
 * Trait LeveledContentable
 *
 * @package App\Models\Traits
 *
 * @property array<LeveledContent> $leveledContents
 *
 * @mixin \Eloquent
 */
trait LeveledContentable
{
    /**
     * Левелованный контент, принадлежащие цели
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function leveledContents()
    {
        return $this->morphMany(LeveledContent::class, 'content')->available()->orderByDesc('level');
    }
    
    public function syncLeveledContents()
    {
    
    }
}

