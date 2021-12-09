<?php

namespace App\Models;

use App\Http\Filters\BaseFilter;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Class BaseModel
 * @package App\Models
 *
 * @property int    $id
 * @property int    $user_id
 * @property string $title
 * @property string $poster
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property User   $user
 * @property array  $tags
 *
 * @method static self|Builder filter(BaseFilter $filters) Apply filter
 * @method static self|Builder syncTags(array $ids)
 * @method static self|Builder syncDescriptions(array $descriptions)
 * @method static self|Builder onlyParents()
 * @method static self|Builder ids(bool $toArray = true)
 *
 * @mixin \Eloquent
 */
class BaseModel extends Model {
	/**
	 * @param Builder $query
	 * @param BaseFilter $filter
	 * @return Builder
	 */
	public function scopeFilter(Builder $query, BaseFilter $filter)
	{
		return $filter->apply($query);
	}
	
	/**
	 * @param array $attributes
	 * @param array $options
	 * @return BaseModel
	 */
	public function update(array $attributes = [], array $options = []): BaseModel
	{
		$this->fill($attributes)->save($options);
		return $this;
	}
}