<?php

namespace App\Models;

use App\Contracts\NewsContract;
use App\Contracts\ViewContract;
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
 * @method static Builder|Story withComposition()
 * @method static Builder|Story own()
 * @method static Builder|Story byCompositionId(int $compositionId)
 * @method static Builder|Story uniqueUsers()
 *
 * @property string $title
 * @property int    $chapter
 * @property int    $level
 * @property int    $eon
 * @property string $epigraph
 * @property string $type
 * @property bool   $is_public
 * @property int    $user_id
 * @property int    $composition_id
 * @property User   $user
 */
class Story extends AbstractModel implements LikeableContract
{
    use SoftDeletes,
        UserRelation,
        ScopeOwn,
        ScopePublished,
        Likeable,
        Commentable,
	    Descriptionable,
        Taggable;

    const TYPE_STORY    = 'type-story';
    const TYPE_ANNOUNCE = 'type-announce';
    
    /**
     * @var array
     */
    protected $contracts = [
        ViewContract::class,
        NewsContract::class,
        RewardContract::class,
        NotificationContract::class,
    ];

    protected $fillable = [
        'title',
        'chapter',
        'epigraph',
        'is_public',
        'book_id',
        'series_id',
        'user_id',
        'type',
    ];

    protected $related = [
        'fragments',
        'comments',
        'tags',
        'composition',
        'user',
        'likes',
    ];
    
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
     * Выбрать истории, относящиеся к определенной серии или книге
     *
     * @param Builder $query
     * @param int $compositionId
     * @return Builder
     */
    public function scopeByCompositionId(Builder $query, int $compositionId)
    {
        return $query->where('composition_id', $compositionId);
    }
    
    /**
     * Выбрать истории с композицией
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeWithComposition(Builder $query)
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
