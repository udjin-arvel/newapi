<?php

namespace App\Models;

use App\Http\Filters\AbstractFilter;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AModel
 * @package App\Models
 *
 * @property int    $id
 * @property int    $user_id
 * @property string $poster
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property User   $user
 * @property array  $tags
 *
 * @method static Model|Builder filter(AbstractFilter $filters) Apply filter
 * @method static Builder|AbstractModel syncTags(array $ids)
 * @method static Builder|AbstractModel syncDescriptions(array $descriptions)
 * @method static Builder|Comment onlyParents()
 * @method static Builder|AbstractModel ids(bool $toArray = true)
 *
 * @mixin \Eloquent
 */
class AbstractModel extends Model {
	/**
	 * @param Builder $query
	 * @param AbstractFilter $filter
	 * @return Builder
	 */
	public function scopeFilter(Builder $query, AbstractFilter $filter)
	{
		return $filter->apply($query);
	}
	
	/**
	 * @param array $attributes
	 * @param array $options
	 * @return AbstractModel
	 */
	public function update(array $attributes = [], array $options = []): AbstractModel
	{
		$this->fill($attributes)->save($options);
		return $this;
	}
}