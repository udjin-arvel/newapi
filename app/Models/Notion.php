<?php

namespace App\Models;

use App\Contracts\NewsContract;
use App\Contracts\NotificationContract;
use App\Contracts\RewardContract;
use App\Contracts\ViewContract;
use App\Models\Traits\Commentable;
use App\Models\Traits\ScopePublished;
use App\Models\Traits\Taggable;
use App\Models\Traits\UserRelation;
use Cog\Likeable\Contracts\Likeable as LikeableContract;
use Cog\Likeable\Traits\Likeable;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Notion
 * @package App\Models
 *
 * @property int    $user_id
 * @property int    $level
 * @property string $title
 * @property string $text
 * @property string $poster
 * @property int    $type
 * @property bool   $is_public
 */
class Notion extends AbstractModel implements LikeableContract
{
    use SoftDeletes,
        UserRelation,
        Likeable,
        Taggable;
    
    /**
     * Типы понятий
     */
	const TYPE_DEFINITION = 'type-definition';
	const TYPE_CHARACTER  = 'type-character';
	const TYPE_PLACE      = 'type-place';
	const TYPE_ENTITY     = 'type-entity';
	const TYPE_EVENT      = 'type-event';
	
	const TYPES = [
		self::TYPE_DEFINITION => 'Определение',
		self::TYPE_CHARACTER  => 'Персонаж',
		self::TYPE_PLACE      => 'Место',
		self::TYPE_ENTITY     => 'Сущность',
		self::TYPE_EVENT      => 'Событие',
	];
	
	protected $fillable = [
		'title',
		'text',
		'poster',
		'level',
		'type',
		'user_id',
		'is_public',
	];
}
