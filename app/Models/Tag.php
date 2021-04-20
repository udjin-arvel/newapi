<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [
        'tag',
        'stem',
        'user_id',
    ];
    
    /**
	 * Истории, относящиеся к тэгу.
	 */
	public function stories()
	{
		return $this->belongsToMany(Story::class, 'tag_story', 'tag_id', 'story_id');
	}
}
