<?php

namespace App\Models\Traits;

use App\Models\Book;

trait BookTrait {
    /**
     * Книга, которому принадлежит контент
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}