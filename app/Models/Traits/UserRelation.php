<?php

namespace App\Models\Traits;

use App\Models\User;

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
