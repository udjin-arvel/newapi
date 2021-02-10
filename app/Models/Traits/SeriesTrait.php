<?php

namespace App\Models\Traits;

use App\Models\Series;

trait SeriesTrait {
    /**
     * Серия, которому принадлежит контент
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function series()
    {
        return $this->belongsTo(Series::class);
    }
}