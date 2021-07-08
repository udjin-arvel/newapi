<?php

namespace App\Models\Traits;

use App\Models\Tag;
use DB;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Collection;

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
     * Получить все теги данной модели
     * @return Collection
     */
    public static function modelTags()
    {
        return Tag::select('tags.*')->join('taggables', function ($join) {
            $join->on('tags.id', '=', 'taggables.tag_id')->where('taggables.taggable_type', self::class);
        })->get();
    }
}
