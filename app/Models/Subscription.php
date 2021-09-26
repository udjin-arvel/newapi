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
class Subscription extends AbstractModel
{
    use UserRelation;
	
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
	 * Проверить является ли подписка общей, то есть, например, для любых новых понятий
	 * @return bool
	 */
	private function isCommon(): bool
	{
		return empty($this->content_id);
	}
	
	/**
	 * Получить текст подписки
	 * @return string
	 */
	public function getSubscriptionText(): string
	{
		$typeText = Enum::getTypeByModelsTypeAndAlias(self::class, $this->content_type);
		return null !== $typeText
			? "Вы подписаны {$typeText}."
			: 'Неизвестная подписка. Обратитесь к администратору с проблемой.';
	}
}
