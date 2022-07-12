<?php

namespace App\Models\Traits;

use App\Models\Image;

/**
 * Trait Imageable
 *
 * @package App\Models\Traits
 *
 * @property array<Image> $images
 *
 * @mixin \Eloquent
 */
trait Imageable
{
	/**
	 * Изображения, принадлежащие контенту
	 * @return \Illuminate\Database\Eloquent\Relations\MorphMany
	 */
	public function images()
	{
		return $this->morphMany(Image::class, 'content');
	}
}

