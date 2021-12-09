<?php

namespace App\Models;

use App\Models\Traits\Contentable;
use App\Models\Traits\UserRelation;
use App\Scopes\UserIdScope;

/**
 * Class Notification
 * @package App\Models
 *
 * @property int     $content_id
 * @property string  $content_type
 * @property string  $message
 * @property int     $user_id
 */
class Notification extends BaseModel
{
    use UserRelation,
	    Contentable;
	
    
    public function __construct(array $attributes = [])
    {
	    parent::__construct($attributes);
    }
	
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
     * Подключить хуки к модели
     */
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new UserIdScope);
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
