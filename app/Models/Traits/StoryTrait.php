<?php

namespace App\Models\Traits;

use App\Models\Story;

trait StoryTrait {
    /**
     * История, которому принадлежит контент
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function story()
    {
        return $this->belongsTo(Story::class);
    }
}