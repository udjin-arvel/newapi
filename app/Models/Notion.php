<?php

namespace App\Models;

use App\Models\Interfaces\Publishable as PublishableInterface;
use App\Models\Scopes\PublicScope;
use App\Models\Traits\Imageable;
use App\Models\Traits\Posterable;
use App\Models\Traits\Taggable;
use App\Models\Traits\UserRelation;
use Cog\Likeable\Contracts\Likeable as LikeableContract;
use Cog\Likeable\Traits\Likeable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
 *
 * @property array<NotionParam> $parameters
 */
class Notion extends BaseModel implements LikeableContract, PublishableInterface
{
    use SoftDeletes,
	    UserRelation,
	    Likeable,
	    Imageable,
	    Taggable,
	    Posterable,
	    PublicScope;

	/**
	 * Типы понятий
	 */
	const TYPE_DEFINITION = 'definition';
	const TYPE_CHARACTER  = 'character';
	const TYPE_PLACE      = 'place';
	const TYPE_OBJECT     = 'object';
	const TYPE_ENTITY     = 'entity';
	const TYPE_EVENT      = 'event';

	const TYPES = [
		self::TYPE_DEFINITION => 'Определение',
		self::TYPE_CHARACTER  => 'Персонаж',
		self::TYPE_PLACE      => 'Место',
		self::TYPE_OBJECT     => 'Объект',
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

    /**
     * Фрагменты, принадлежащие истории.
     * @return HasMany
     */
    public function params(): HasMany
    {
        return $this->hasMany(NotionParam::class)->orderBy('order', 'desc');
    }
}
