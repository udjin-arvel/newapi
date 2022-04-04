<?php

namespace App\Models\Traits;

use App\Capacitors\AliasCapacitor;
use App\Helpers\ImageHelper;

/**
 * Trait Posterable
 *
 * @package App\Models\Traits
 * @mixin \Eloquent
 */
trait Posterable {
	/**
	 * Сетер для постера
	 * @param ?string $value
	 */
	public function setPosterAttribute($value): void
	{
		if ($value === $this->poster) {
			return;
		}
		
		if ($this->poster) {
			app(ImageHelper::class)->deleteImageWithThumbnails($this->poster);
		}
		
		if (false == strripos($value, 'base64')) {
			$this->attributes['poster'] = null;
			return;
		}
		
		$alias = AliasCapacitor::getAliasByClass(self::class);
		$path = app(ImageHelper::class)->saveImageFromBase64($value, $alias);
		$this->attributes['poster'] = $path;
	}
}
