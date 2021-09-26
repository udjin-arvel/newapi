<?php

namespace App\Models;

use App\Facades\Enum;
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
	
	/**
	 * Получить текст подписки
	 *
	 * @param $content
	 * @param $user
	 * @return string
	 */
	public static function getNotificationText($content, $user): string
	{
		$text = "Пользователь «{$user->name}» добавил ";
		
		switch (get_class($content)) {
			case Notion::class:   $text .= "понятие"; break;
			case Short::class:    $text .= "краткий сюжет"; break;
			case LoreItem::class: $text .= "элемент лора"; break;
			case Story::class:    $text .= "историю"; break;
		}
		
		return $text . " «{$content->title}».";
	}
}
