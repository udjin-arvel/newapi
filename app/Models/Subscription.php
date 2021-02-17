<?php


namespace App\Models;

use App\Models\Traits\BookTrait;
use App\Models\Traits\SeriesTrait;
use App\Models\Traits\StoryTrait;
use App\Models\Traits\UserTrait;
use App\Scopes\UserIdScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Subscription
 * @package App\Models
 *
 * @property int $id
 * @property int $user_id
 * @property int $author_id
 * @property int $book_id
 * @property int $last_checking_at
 */
class Subscription extends Model
{
    use UserTrait, StoryTrait, BookTrait, SeriesTrait;
    
    /**
     * Пользователь, на которого оформлена подписка
     * @return BelongsTo
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
    
    /**
     * @return void
     */
    protected static function boot()
    {
        parent::boot();
        
        static::addGlobalScope(new UserIdScope);
    }
}
