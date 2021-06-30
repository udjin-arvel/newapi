<?php

namespace App\Models;

/**
 * Class Tag
 * @package App\Models
 *
 * @property int $id
 * @property string $name
 * @property string $stem
 */
class Tag extends AModel
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
        return $this->morphedByMany(Story::class, 'taggable');
    }
}
