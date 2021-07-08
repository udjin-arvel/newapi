<?php


namespace App\Models;

use App\Models\Traits\BookTrait;
use App\Models\Traits\ScopeOwn;
use App\Models\Traits\SeriesTrait;
use App\Models\Traits\StoryTrait;
use App\Models\Traits\UserRelation;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

/**
 * Class Subscription
 * @package App\Models
 *
 * @method static Builder|Subscription byAuthorId(int $id, string $boolean = 'and')
 * @method static Builder|Subscription byBookId(int $id, string $boolean = 'and')
 * @method static Builder|Subscription bySeriesId(int $id, string $boolean = 'and')
 * @method static Builder|Subscription own()
 *
 * @property int    $id
 * @property int    $user_id
 * @property int    $subscription_id
 * @property string $subscription_type
 *
 * @mixin \Eloquent
 */
class Subscription extends Model
{
    use UserRelation,
        ScopeOwn;

    public const TYPE_STORY = 'type-story';

    /**
     * Пользователь, на которого оформлена подписка
     * @return MorphOne
     */
    public function author()
    {
        return $this->morphOne(User::class, 'subscription');
    }

    /**
     * Книга, на которую оформлена подписка
     * @return MorphOne
     */
    public function book()
    {
        return $this->morphOne(Book::class, 'subscription');
    }

    /**
     * Серия, на которую оформлена подписка
     * @return MorphOne
     */
    public function series()
    {
        return $this->morphOne(Series::class, 'subscription');
    }

    /**
     * @param Builder $query
     * @param int $authorId
     * @param string $boolean
     * @return Builder
     */
    public function scopeByAuthorId(Builder $query, ?int $authorId, string $boolean = 'and')
    {
        return empty($authorId) ? $query : $query->where(function (Builder $query) use ($authorId) {
            return $query
                ->where('subscription_id', '=', $authorId)
                ->where('subscription_type', '=', User::class)
            ;
        }, null, null, $boolean);
    }

    /**
     * @param Builder $query
     * @param int $bookId
     * @param string $boolean
     * @return Builder
     */
    public function scopeByBookId(Builder $query, ?int $bookId, string $boolean = 'and')
    {
        return empty($bookId) ? $query : $query->where(function (Builder $query) use ($bookId) {
            return $query
                ->where('subscription_id', '=', $bookId)
                ->where('subscription_type', '=', Book::class)
            ;
        }, null, null, $boolean);
    }

    /**
     * @param Builder $query
     * @param int $seriesId
     * @param string $boolean
     * @return Builder
     */
    public function scopeBySeriesId(Builder $query, ?int $seriesId, string $boolean = 'and')
    {
        return empty($seriesId) ? $query : $query->where(function (Builder $query) use ($seriesId) {
            return $query
                ->where('subscription_id', '=', $seriesId)
                ->where('subscription_type', '=', Series::class)
            ;
        }, null, null, $boolean);
    }
}
