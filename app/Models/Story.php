<?php

namespace App\Models;

use App\Contracts\NewsContract;
use App\Contracts\ViewContract;
use App\Models\Scopes\PublicScope;
use App\Models\Traits\Commentable;
use App\Models\Traits\Descriptionable;
use App\Models\Traits\ScopeOwn;
use App\Models\Traits\ScopePublished;
use App\Models\Traits\Taggable;
use App\Models\Traits\UserRelation;
use App\Contracts\NotificationContract;
use App\Contracts\RewardContract;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;
use Cog\Likeable\Contracts\Likeable as LikeableContract;
use Cog\Likeable\Traits\Likeable;

/**
 * Class Story
 * @package App\Models
 *
 * @method static Builder|Story published()
 * @method static Builder|Story compositionExist()
 * @method static Builder|Story own()
 * @method static Builder|Story byCompositionId($compositionId)
 * @method static Builder|Story byUserId($userId)
 * @method static Builder|Story uniqueUsers()
 *
 * @property string $title
 * @property int    $chapter
 * @property int    $level
 * @property int    $eon
 * @property string $epigraph
 * @property string $type
 * @property bool   $is_public
 * @property bool   $liked
 * @property int    $user_id
 * @property int    $composition_id
 * @property array  $likesAndDislikes
 *
 * @property User $user
 * @property array $fragments
 * @property array $descriptions
 * @property Composition $composition
 */
class Story extends BaseModel implements LikeableContract
{
    use SoftDeletes,
        UserRelation,
        Likeable,
        Taggable,
        Commentable,
	    Descriptionable,
	    PublicScope;
	
	/**
	 * Типы историй
	 */
	const TYPE_STORY    = 'story';
	const TYPE_ANNOUNCE = 'announce';
	
	/**
	 * @var array
	 */
	protected $fillable = [
		'title',
		'type',
		'chapter',
		'eon',
		'epigraph',
		'is_public',
		'composition_id',
		'user_id',
	];
	
	/**
	 * @var array
	 */
	public $timestamps = ['updated_at'];
	
	/**
     * Композиция, которой принадлежит история.
     */
    public function composition()
    {
        return $this->belongsTo(Composition::class);
    }
    
    /**
     * Фрагменты, принадлежащие истории.
     * @return HasMany
     */
    public function fragments()
    {
        return $this->hasMany(Fragment::class)->orderBy('order', 'desc');
    }

    /**
     * Выбрать истории, относящиеся к определенной серии или книге или нескольким
     *
     * @param Builder $query
     * @param int|array $compositionIds
     * @return Builder
     */
    public function scopeByCompositionId(Builder $query, $compositionIds)
    {
    	return is_array($compositionIds)
		    ? $query->whereIn('composition_id', $compositionIds)
		    : $query->where('composition_id', $compositionIds);
    }
	
	/**
	 * Выбрать истории определенного юзера/юзеров
	 *
	 * @param Builder $query
	 * @param int|array $userIds
	 * @return Builder
	 */
	public function scopeByUserId(Builder $query, $userIds)
	{
		return is_array($userIds)
			? $query->whereIn('user_id', $userIds)
			: $query->where('user_id', $userIds);
	}
    
    /**
     * Выбрать истории с композицией
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeCompositionExist(Builder $query)
    {
        return $query->where('composition_id', '!=', null);
    }
    
    /**
     * Вернуть количество уникальных писателей историй
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeUniqueUsers(Builder $query)
    {
        return $query->select('user_id')->distinct();
    }
}
