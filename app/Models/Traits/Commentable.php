<?php

namespace App\Models\Traits;

use App\Models\Comment;

/**
 * Trait Commentable
 *
 * @package App\Models\Traits
 * @mixin \Eloquent
 */
trait Commentable
{
	/**
	 * Комментарии, принадлежащие контенту
	 * @return \Illuminate\Database\Eloquent\Relations\MorphMany
	 */
	public function comments()
	{
		return $this->morphMany(Comment::class, 'content')->onlyParents()->orderBy('created_at', 'desc');
	}
}

