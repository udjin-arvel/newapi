<?php

namespace App\Models;

use App\Models\Traits\Contentable;
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
    use UserRelation, Contentable;
    
    const TYPES = [
        'story'    => Story::class,
        'notion'   => Notion::class,
        'loreitem' => LoreItem::class,
        'user'     => User::class,
    ];
	
	/**
	 * @var array
	 */
    protected $fillable = [
        'content_id',
        'content_type',
        'message',
        'user_id',
    ];
	
	/**
	 * @var array
	 */
	public $timestamps = ['updated_at'];
    
    /**
     * @return void
     */
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new UserIdScope);
    }
}
