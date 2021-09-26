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
 * @property int     $subscription_id
 * @property int     $user_id
 */
class Notification extends AbstractModel
{
    use UserRelation, Contentable;
	
	/**
	 * @var array
	 */
    protected $fillable = [
        'content_id',
        'content_type',
        'message',
        'subscription_id',
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
	
	/**
	 * Подписка, на которую создано уведомление
	 */
	public function subscription()
	{
		return $this->belongsTo(Subscription::class);
	}
}
