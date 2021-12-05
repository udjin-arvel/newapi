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
	
	/**
	 * Вернуть только значащую строку от типа контента
	 * @return string
	 */
	public function getContentType(): string
	{
		if ($this->content_type) {
			$namespaced = explode('\\', $this->content_type);
			return $namespaced[count($namespaced) - 1];
		}
		
		return '';
	}
}

