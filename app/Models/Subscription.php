<?php

namespace App\Models;

use App\Facades\Enum;
use App\Models\Traits\UserRelation;
use App\Scopes\UserIdScope;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class Subscription
 * @package App\Models
 *
 * @property int    $id
 * @property int    $user_id
 * @property int    $content_id
 * @property string $content_type
 *
 * @method static Builder|Subscription byUserId($userId)
 * @method static Builder|Subscription byType($types)
 */
class Subscription extends BaseModel
{
    use UserRelation;
	
	/**
	 * Типы подписок
	 */
	const TYPE_USER        = 'user';
	const TYPE_COMPOSITION = 'composition';
	const TYPE_NOTION      = 'notion';
	const TYPE_SHORT       = 'short';
	const TYPE_LORE_ITEM   = 'loreitem';
	
	/**
	 * @var array
	 */
	protected $fillable = [
		'content_id',
		'content_type',
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
	 * Уведомления подписки
	 */
	public function notifications()
	{
		return $this->hasMany(Notification::class);
	}
	
	/**
	 * Получить текст подписки
	 * @return string
	 */
	public function getSubscriptionText(): string
	{
		$text = 'Вы подписаны на ';
		
		switch ($this->content_type) {
			case User::class:        $text .= 'контент автора'; break;
			case Composition::class: $text .= 'главы композиции'; break;
			case Notion::class:      $text .= 'новые понятия'; break;
			case Short::class:       $text .= 'короткие заметки об основном сюжете'; break;
			case LoreItem::class:    $text .= 'свежие записи о механике вселенной'; break;
		}
		
		return $text;
	}
}
