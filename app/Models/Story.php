<?php

namespace App\Models;

use App\Events\UpdateNotifications;
use App\Models\Traits\ScopeOwn;
use App\Models\Traits\ScopePublished;
use App\Models\Traits\Taggable;
use App\Models\Traits\UserRelation;
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
        UserRelation,
        ScopeOwn,
        ScopePublished,
        Likeable,
        Taggable;

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
     * @param int $compositionId
     * @return Builder
     */
    public function scopeCompositionId(Builder $query, int $compositionId): Builder
    {
        return $query->where('composition_id', $compositionId);
    }

    /**
     * Фрагменты, принадлежащие истории.
     * @return HasMany
     */
    public function fragments()
    {
        return $this->hasMany(Fragment::class)->orderBy('order', 'desc');
    }
}
