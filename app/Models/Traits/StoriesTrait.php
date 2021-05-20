<?php

namespace App\Models\Traits;

use App\Models\Story;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait StoriesTrait {
    /**
     * Истории, принадлежащие книге.
     * @return HasMany
     */
    public function stories()
    {
        return $this->hasMany(Story::class)->orderBy('chapter');
    }
}