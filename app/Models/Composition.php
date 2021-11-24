<?php

namespace App\Models;

use App\Models\Traits\Commentable;
use App\Models\Traits\Taggable;
use App\Models\Traits\UserRelation;
use Cog\Likeable\Contracts\Likeable as LikeableContract;
use Cog\Likeable\Traits\Likeable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
 */
class Composition extends AbstractModel implements LikeableContract
{
    use SoftDeletes,
	    Likeable,
        UserRelation,
	    Commentable,
        Taggable;
	
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
	 * Истории, принадлежащие композиции.
	 * @return HasMany
	 */
	public function stories()
	{
		return $this->hasMany(Story::class)->orderBy('chapter', 'desc');
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
}
