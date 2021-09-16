<?php

namespace App\Models\Traits;

use App\Models\AbstractModel;
use App\Models\Description;

/**
 * Trait Descriptionable
 *
 * @package App\Models\Traits
 * @mixin \Eloquent
 */
trait Descriptionable
{
	/**
	 * Описания, принадлежащие контенту
	 * @return \Illuminate\Database\Eloquent\Relations\MorphMany
	 */
	public function descriptions()
	{
		return $this->morphMany(Description::class, 'content');
	}
	
	/**
	 * Синхронизировать описания модели с указанными описаниями
	 *
	 * @param array|null $descriptions
	 * @return AbstractModel
	 */
	public function syncDescriptions(?array $descriptions)
	{
		if ($descriptions) {
			$collection = collect($descriptions);
			$keptIds = $collection->pluck('id')->filter()->toArray();
			
			if ($keptIds) {
				$this->descriptions()
					->whereNotIn('id', $keptIds)
					->update(['content_id' => null, 'content_type' => null]);
			}
			
			$collection->each(function ($description) {
				$model = Description::findOrNew($description['id'] ?? null);
				$model->fill($description)->save();
			});
		} else {
			$this->descriptions()->update(['content_id' => null, 'content_type' => null]);
		}
		
		return $this;
	}
}

