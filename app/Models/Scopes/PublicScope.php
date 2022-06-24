<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;

/**
 * Trait PublicScope
 *
 * @package App\Models\Scopes
 *
 * @method static Builder|self isPublic($value = true)
 *
 * @mixin \Eloquent
 */
trait PublicScope
{
	/**
	 * Выбрать истории с композицией
	 * @param Builder $query
	 * @param bool $value
	 * @return Builder
	 */
	public function scopeIsPublic(Builder $query, bool $value = true)
	{
		return $query->where('is_public', $value);
	}
}

