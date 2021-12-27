<?php

namespace App\Models\Traits;

use App\Capacitors\AliasCapacitor;

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
	
	/**
	 * @param $value
	 * @return string
	 */
	public function getContentTypeAttribute($value): string
	{
		return $value ? ucfirst(AliasCapacitor::getAliasByClass($value)) : '';
	}
}

