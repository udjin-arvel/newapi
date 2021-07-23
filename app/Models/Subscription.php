<?php

namespace App\Models;

use App\Models\Traits\ScopeOwn;
use App\Models\Traits\UserRelation;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class Subscription
 * @package App\Models
 *
 * @property int    $id
 * @property int    $user_id
 * @property int    $subscription_id
 * @property string $subscription_type
 *
 * @method static Builder|Subscription byUserId($userId)
 * @method static Builder|Subscription byType($types)
 */
class Subscription extends AModel
{
    use UserRelation,
        ScopeOwn;
    
    /**
     * Типы подписок
     */
    const TYPES = [
        User::class        => 'на пользователя',
        Composition::class => 'на композицию',
        Notion::class      => 'на понятия',
        LoreItem::class    => 'на элементы лора',
    ];
    
    /**
     * @param Builder $query
     * @param int $userId
     * @return Builder
     */
    public function scopeByUserId(Builder $query, $userId)
    {
        return $query->when($userId, function ($query, $userId) {
            return $query->where([
                'content_id'   => $userId,
                'content_type' => User::class,
            ]);
        });
    }
    
    /**
     * @param Builder $query
     * @param string|array $types
     * @return Builder
     */
    public function scopeByType(Builder $query, $types)
    {
        if (is_array($types)) {
            return $query->whereIn('content_type', $types);
        }
        
        if (is_string($types)) {
            return $query->where('content_type', $types);
        }
        
        return $query;
    }
}
