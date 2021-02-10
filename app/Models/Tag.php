<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
	/**
	 * Истории, относящиеся к тэгу.
	 */
	public function stories()
	{
		return $this->belongsToMany(Story::class, 'tag_story', 'tag_id', 'story_id');
	}
}
