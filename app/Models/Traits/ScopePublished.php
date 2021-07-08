<?php

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Builder;

trait ScopePublished {
    /**
     * @param $query
     * @return Builder
     */
    public function scopePublished(Builder $query)
    {
        return $query->where('is_published', true);
    }
}
