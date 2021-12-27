<?php

namespace App\Models\Traits;

use App\Models\BaseModel;
use App\Models\Fragment;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Log;

/**
 * Trait Fragmentable
 *
 * @package App\Models\Traits
 * @mixin \Eloquent
 */
trait Fragmentable
{
	/**
	 * Фрагменты, принадлежащие истории.
	 * @return HasMany
	 */
	public function fragments()
	{
		return $this->hasMany(Fragment::class)->orderBy('order', 'desc');
	}
	
	/**
	 * Синхронизировать описания модели с указанными фрагментами
	 *
	 * @param array|null $items
	 * @return static|BaseModel
	 */
	public function syncFragments(?array $items)
	{
		if ($items) {
			$collection = collect($items);
			$keptIds = $collection->pluck('id')->filter()->toArray();
			
			if ($keptIds) {
				$this->fragments()->whereNotIn('id', $keptIds)->delete();
			}
			
			$collection->each(function ($item) {
				$model = Fragment::findOrNew($item['id'] ?? null);
				$model->update($item);
			});
		} else {
			$this->fragments()->delete();
		}
		
		return $this;
	}
}

