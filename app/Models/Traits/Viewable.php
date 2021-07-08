<?php

namespace App\Models\Traits;

/**
 * Trait Viewable
 * @package App\Models\Traits
 */
trait Viewable {
    /**
     */
    public static function boot()
    {
        parent::boot();
        
        self::retrieved(function(self $model) {
            dd($model);
        });
    }
}
