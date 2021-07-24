<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class UserIdScope implements Scope
{
    /**
     * @param Builder $query
     * @param Model $model
     * @return Builder
     */
    public function apply(Builder $query, Model $model)
    {
        return $query->where('user_id', \auth()->id());
    }
}