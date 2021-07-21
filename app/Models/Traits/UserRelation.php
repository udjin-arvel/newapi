<?php

namespace App\Models\Traits;

use App\Models\User;

/**
 * Trait UserRelation
 * @package App\Models\Traits
 */
trait UserRelation {
    /**
     * Пользователь, которому принадлежит контент
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
