<?php

namespace App\Models\Traits;

use Auth;
use Illuminate\Database\Eloquent\Builder;

trait ScopeOwnTrait {
    /**
     * @param $query
     * @return Builder
     */
    public function scopeByOwn(Builder $query)
    {
        return $query->where('user_id', '=', optional(Auth::user())->id);
    }
}