<?php

namespace App\Models;

use App\Contracts\NewsContract;
use App\Contracts\RewardContract;
use App\Models\Interfaces\PosterableInterface;
use App\Models\Traits\Commentable;
use App\Models\Traits\Taggable;
use App\Models\Traits\UserRelation;
use Cog\Likeable\Contracts\Likeable as LikeableContract;
use Cog\Likeable\Traits\Likeable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Composition
 * @package App\Models
 *
 * @property int    $id
 * @property int    $user_id
 * @property int    $parent_id
 * @property int    $era
 * @property int    $level
 * @property int    $chapter
 * @property string $title
 * @property bool   $is_public
 * @property string $type
 * @property string $description
 * @property string $poster
 *
 * @method static Builder|Composition books()
 * @method static Builder|Composition series()
 */
class Composition extends AbstractModel implements PosterableInterface, LikeableContract
{
    use SoftDeletes,
	    Likeable,
        UserRelation,
	    Commentable,
        Taggable;
	
	/**
	 * Типы композиций
	 */
    const TYPE_BOOK   = 'type-book';
    const TYPE_SERIES = 'type-series';
	
	const TYPES = [
		self::TYPE_BOOK   => 'Книга',
		self::TYPE_SERIES => 'Серия',
	];
	
	/**
	 * @var array
	 */
    protected $fillable = [
    	'title',
    	'description',
    	'era',
    	'poster',
    	'type',
    	'is_public',
    	'user_id',
    ];
	
	/**
	 * @var array
	 */
	public $timestamps = ['updated_at'];
	
	/**
	 * @param Builder $query
	 * @return Builder
	 */
	public function scopeBooks(Builder $query)
	{
		return $query->where('type', self::TYPE_BOOK);
	}
	
	/**
	 * @param Builder $query
	 * @return Builder
	 */
	public function scopeSeries(Builder $query)
	{
		return $query->where('type', self::TYPE_SERIES);
	}
	
	/**
	 * @param Builder $query
	 * @param int $parentId
	 * @param string $operator
	 * @return Builder
	 */
	public function scopeByParent(Builder $query, int $parentId, string $operator = 'and')
	{
		if ($operator === 'or') {
			return $query->orWhere('parent_id', $parentId);
		}
		
		return $query->where('parent_id', $parentId);
	}
	
	/**
	 * @return mixed
	 */
	public function storePoster()
	{
		// TODO: Implement storePoster() method.
	}
	
	/**
	 * @return mixed
	 */
	public function deletePoster()
	{
		// TODO: Implement deletePoster() method.
	}
}
