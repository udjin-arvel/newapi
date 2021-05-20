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
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class Story
 * @package App\Models
 *
 * @method static Builder|Story published()
 * @method static Builder|Story byOwn()
 * @method static Builder|Story byKeeperId(string $keeperType, int $keeperId)
 *
 * @property int    $id
 * @property string $title
 * @property int    $chapter
 * @property int    $level
 * @property int    $time
 * @property string $remark
 * @property bool   $is_published
 * @property int    $user_id
 * @property int    $book_id
 * @property int    $series_id
 * @property array  $tags
 * @property array  $comments
 * @property Book   $book
 * @property Series $series
 * @property User   $user
 * @property array  $fragments
 * @property string $created_at
 * @property string $updated_at
 *
 * @mixin \Eloquent
 */
class Story extends Model
{
    use SoftDeletes,
        UserTrait,
        BookTrait,
        SeriesTrait,
        DataHelperTrait,
        ScopeOwnTrait,
        ScopePublishedTrait;
    
    const TYPE_STORY    = 'type-story';
    const TYPE_ANNOUNCE = 'type-announce';
    
    const KEEPER_TYPE_BOOK   = 'book_id';
    const KEEPER_TYPE_SERIES = 'series_id';
    
    public static function boot()
    {
        parent::boot();
        
        self::created(function($model) {
            if ($model->is_published) {
                UpdateNotifications::dispatch($model, UpdateNotifications::TARGET_CREATED);
            }
        });
        
        self::updated(function($model) {
            if ($model->is_published) {
                UpdateNotifications::dispatch($model, UpdateNotifications::TARGET_UPDATED);
            }
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
     * @return BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'story_tag', 'story_id', 'tag_id');
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
