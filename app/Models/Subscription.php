<?php

namespace App\Models;

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
class Subscription extends AbstractModel
{
    use UserRelation;
    
    /**
     * Типы подписок
     */
	const TYPE_USER        = 'type-user';
	const TYPE_COMPOSITION = 'type-composition';
	const TYPE_NOTION      = 'type-notion';
	const TYPE_LORE_ITEM   = 'type-lore-item';
	
	const TYPES = [
		self::TYPE_USER        => 'на пользователя',
		self::TYPE_COMPOSITION => 'на композицию',
		self::TYPE_NOTION      => 'на понятия',
		self::TYPE_LORE_ITEM   => 'на элементы лора',
	];
	
	/**
	 * @var array
	 */
	public $timestamps = ['updated_at'];
	
	/**
	 * Подписка на
	 * @return \Illuminate\Database\Eloquent\Relations\MorphTo
	 */
	public function subscription()
	{
		return $this->morphTo();
	}
}
