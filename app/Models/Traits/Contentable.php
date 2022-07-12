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
	 * @return string|null
	 */
	public function getContentType()
	{
		return AliasCapacitor::getAliasByClass($this->content_type);
	}
	
	/**
	 * @param $value
	 */
	public function setContentTypeAttribute($value)
	{
		$this->attributes['content_type'] = AliasCapacitor::getClassByAlias($value);
	}
}

