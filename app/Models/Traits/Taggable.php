<?php

namespace App\Models\Traits;

use App\Models\AbstractModel;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

/**
 * Trait Taggable
 *
 * @package App\Models\Traits
 * @mixin \Eloquent
 */
trait Taggable {
    /**
     * Тэги, принадлежащие контенту
     * @return MorphToMany
     */
    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }
	
	/**
	 * Синхронизировать теги модели с указанными тегами
	 * @param array|null $ids
	 * @return AbstractModel|Taggable
	 */
	public function syncTags(?array $ids)
	{
		if ($ids) {
			$this->tags()->whereNotIn('tag_id', $ids)->detach();
			$this->tags()->attach($ids);
		} else {
			$this->tags()->detach();
		}
		
		return $this;
	}
}
