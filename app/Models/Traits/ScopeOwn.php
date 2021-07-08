<?php

namespace App\Models\Traits;

use Auth;
use Illuminate\Database\Eloquent\Builder;

trait ScopeOwn {
    /**
     * @param $query
     * @return Builder
     */
    public function scopeOwn(Builder $query)
    {
        return $query->where('user_id', optional(Auth::user())->id);
    }
}
