<?php

namespace App\Models;

use App\Models\Traits\ScopeOwn;
use App\Models\Traits\UserRelation;
use App\Scopes\UserIdScope;

/**
 * Class Note
 * @package App\Models
 *
 * @property int     $content_id
 * @property string  $content_type
 * @property string  $message
 * @property int     $user_id
 */
class Notification extends AbstractModel
{
    use UserRelation;
    
    const TYPES = [
        'story'    => Story::class,
        'notion'   => Notion::class,
        'loreitem' => LoreItem::class,
        'user'     => User::class,
    ];
    
    protected $fillable = [
        'content_id',
        'content_type',
        'message',
        'user_id',
    ];
    
    /**
     * @return void
     */
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new UserIdScope);
    }
}
