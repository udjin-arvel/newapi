<?php

namespace App\Models\Traits;

use App\Models\Comment;

/**
 * Trait Taggable
 *
 * @package App\Models\Traits
 * @mixin \Eloquent
 */
trait Commentable {
    /**
     * Тэги, принадлежащие контенту
     */
    public function comments()
    {
        return $this->hasMany(Comment::class, 'content_id', 'id')
            ->orderBy('created_at', 'desc');
    }
}
