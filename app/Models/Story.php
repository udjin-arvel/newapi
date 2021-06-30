<?php

namespace App\Models;

use App\Events\UpdateNotifications;
use App\Models\Traits\BookTrait;
use App\Models\Traits\DataHelperTrait;
use App\Models\Traits\ScopeOwnTrait;
use App\Models\Traits\ScopePublishedTrait;
use App\Models\Traits\SeriesTrait;
use App\Models\Traits\UserTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;
use Cog\Likeable\Contracts\Likeable as LikeableContract;
use Cog\Likeable\Traits\Likeable;

/**
 * Class Story
 * @package App\Models
 *
 * @method static Builder|Story published()
 * @method static Builder|Story byOwn()
 * @method static Builder|Story byKeeperId(string $keeperType, int $keeperId)
 *
 * @property int $id
 * @property string $title
 * @property int $chapter
 * @property int $level
 * @property int $time
 * @property string $epigraph
 * @property string $type
 * @property bool $is_published
 * @property int $user_id
 * @property int $composition_id
 * @property array $tags
 * @property array $comments
 * @property Composition $composition
 * @property User $user
 * @property array $fragments
 * @property array $notions
 * @property array $remarks
 * @property string $created_at
 * @property string $updated_at
 *
 * @mixin \Eloquent
 */
class Story extends AModel implements LikeableContract
{
    use SoftDeletes,
        UserTrait,
        BookTrait,
        SeriesTrait,
        ScopeOwnTrait,
        ScopePublishedTrait,
        Likeable;
    
    const TYPE_STORY    = 'type-story';
    const TYPE_ANNOUNCE = 'type-announce';
    
    protected $fillable = [
        'title',
        'chapter',
        'epigraph',
        'is_published',
        'book_id',
        'series_id',
        'user_id',
        'type',
    ];
    
    protected $related = [
        'fragments',
        'tags',
    ];
    
    public static function boot()
    {
        parent::boot();
        
        self::created(function(self $model) {
            UpdateNotifications::dispatch($model, UpdateNotifications::TARGET_CREATED);
        });
        
        self::updated(function(self $model) {
            UpdateNotifications::dispatch($model, UpdateNotifications::TARGET_UPDATED);
        });
    }
    
    /**
     * Выбрать истории, относящиеся к определенной серии или книге
     *
     * @param Builder $query
     * @param string $keeperType
     * @param int $keeperId
     * @return Builder
     */
    public function scopeByKeeperId(Builder $query, string $keeperType, int $keeperId): Builder
    {
        return $query->where($keeperType, $keeperId);
    }
    
    /**
     * Тэги, принадлежащие истории
     * @return MorphToMany
     */
    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }
    
    /**
     * Понятия, принадлежащие истории
     * @return BelongsToMany
     */
    public function notions()
    {
        return $this->belongsToMany(Notion::class, 'story_notion', 'story_id', 'notion_id');
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
     * Комментарии, принадлежащие истории.
     * @return HasMany
     */
    public function remarks()
    {
        return $this->hasMany(StoryComment::class)->orderBy('importance', 'desc');
    }
}
