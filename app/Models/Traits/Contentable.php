<?php

namespace App\Models\Traits;

/**
 * Trait Contentable
 *
 * @package App\Models\Traits
 * @mixin \Eloquent
 */
trait Contentable
{
	/**
	 * Комментарии, принадлежащие контенту
	 * @return \Illuminate\Database\Eloquent\Relations\MorphTo
	 */
	public function content()
	{
		return $this->morphTo();
	}
}

