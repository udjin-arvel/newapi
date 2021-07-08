<?php

namespace App\Models;

use App\Events\UpdateNotifications;
use App\Models\Interfaces\ITypes;
use App\Models\Traits\ScopeOwn;
use App\Models\Traits\ScopePublished;
use App\Models\Traits\Taggable;
use App\Models\Traits\UserRelation;
use App\Models\Traits\Viewable;
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
 * @method static Builder|Story own()
 * @method static Builder|Story compositionId(int $compositionId)
 *
 * @property string $title
 * @property int    $chapter
 * @property int    $level
 * @property int    $eon
 * @property string $epigraph
 * @property string $type
 * @property bool   $is_published
 * @property int    $user_id
 * @property int    $composition_id
 */
class Story extends AModel implements LikeableContract, ITypes
{
    use SoftDeletes,
        UserRelation,
        ScopeOwn,
        ScopePublished,
        Likeable,
        Taggable,
        Viewable;

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
    public function scopeCompositionId(Builder $query, int $compositionId): Builder
    {
        return $query->where('composition_id', $compositionId);
    }
    
    /**
     * Получить типы модели
     * @return array
     */
    public static function getTypes(): array
    {
        return [
            self::TYPE_STORY     => 'История',
            self::TYPE_ANNOUNCE  => 'Анонс',
        ];
    }
}
