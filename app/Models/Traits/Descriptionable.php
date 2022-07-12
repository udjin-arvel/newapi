<?php

namespace App\Models\Traits;

use App\Models\BaseModel;
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
	 * @param array|null $ids
	 * @return Descriptionable|static
	 */
	public function syncDescriptions(?array $ids)
	{
		if (is_array($ids) && count($ids) > 0) {
			$this->descriptions()
				->whereNotIn('id', $ids)
				->update(['content_id' => null, 'content_type' => null]);
			
			foreach ($ids as $descriptionId) {
				$model = Description::findOrFail($descriptionId);
				$model->content_id = $this->id;
				$model->content_type = get_class($this);
				$model->save();
			}
		} else {
			$this->descriptions()->update(['content_id' => null, 'content_type' => null]);
		}
		
		return $this;
	}
}

