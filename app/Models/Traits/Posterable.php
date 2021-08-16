<?php

namespace App\Models\Traits;

use App\Helpers\ImageHelper;

/**
 * Trait Posterable
 *
 * @package App\Models\Posterable
 * @mixin \Eloquent
 */
trait Posterable {
	/**
	 */
	public function storePoster()
	{
		if (!empty($this->poster)) {
			$this->poster = ImageHelper::store($this->poster);
        }
	}
	
	/**
	 */
	public function deletePoster()
	{
		ImageHelper::delete($this->poster);
	}
}
