<?php

namespace App\Models;

use App\Models\Traits\Contentable;
use App\Models\Traits\Taggable;
use App\Models\Traits\UserRelation;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class Description
 * @package App\Models
 *
 * @property string $text
 * @property string $title
 * @property string $type
 * @property int    $user_id
 * @property int    $content_id
 * @property string $content_type
 * @property int    $importance
 * @property bool   $is_public
 * @property string $realized_at
 * @property BaseModel $content
 *
 * @method static Builder|Description realized()
 * @method static Builder|Description unrealized()
 * @method static Builder|Description published()
 * @method static Builder|Description attached()
 * @method static Builder|Description notAttached()
 * @method static Builder|Description plots()
 * @method static Builder|Description characters()
 * @method static Builder|Description places()
 * @method static Builder|Description byUser()
 */
class Description extends BaseModel
{
	use UserRelation,
		Taggable,
		Contentable;
	
    /**
     * Типы описаний
     */
	const TYPE_SUBJECT    = 'subject';
	const TYPE_PLOT       = 'plot';
	const TYPE_PLACE      = 'place';
	const TYPE_CHARACTER  = 'character';
	const TYPE_EVENT      = 'event';
	const TYPE_PHENOMENON = 'phenomenon';
	
	const TYPES = [
		self::TYPE_SUBJECT    => 'Объект',
		self::TYPE_PLOT       => 'Сюжет',
		self::TYPE_PLACE      => 'Место',
		self::TYPE_CHARACTER  => 'Персонаж',
		self::TYPE_EVENT      => 'Событие',
		self::TYPE_PHENOMENON => 'Феномен',
	];
	
	/**
	 * @var array
	 */
	protected $fillable = [
		'text',
		'title',
		'type',
		'user_id',
		'content_id',
		'content_type',
		'importance',
		'is_public',
		'realized_at',
	];
	
	/**
	 * Выбрать реализованные сюжеты
	 *
	 * @param Builder $query
	 * @return Builder
	 */
	public function scopeByUser(Builder $query)
	{
		return $query->where('user_id', \auth()->id());
	}
	
	/**
	 * Выбрать реализованные сюжеты
	 *
	 * @param Builder $query
	 * @return Builder
	 */
	public function scopeRealized(Builder $query)
	{
		return $query->where('realized_at', '!=', null);
	}
	
	/**
	 * Выбрать нереализованные сюжеты
	 *
	 * @param Builder $query
	 * @return Builder
	 */
	public function scopeUnrealized(Builder $query)
	{
		return $query->where('realized_at', '=', null);
	}
	
	/**
	 * Выбрать нереализованные сюжеты
	 *
	 * @param Builder $query
	 * @return Builder
	 */
	public function scopePublished(Builder $query)
	{
		return $query->where('is_public', '=', true);
	}
	
	/**
	 * Выбрать прикрепленные сюжеты
	 *
	 * @param Builder $query
	 * @return Builder
	 */
	public function scopeAttached(Builder $query)
	{
		return $query->where('content_id', '!=', null);
	}
	
	/**
	 * Выбрать неприкрепленные сюжеты
	 *
	 * @param Builder $query
	 * @return Builder
	 */
	public function scopeNotAttached(Builder $query)
	{
		return $query->where('content_id', '=', null);
	}
	
	/**
	 * Выбрать описания сюжетов
	 *
	 * @param Builder $query
	 * @return Builder
	 */
	public function scopePlots(Builder $query)
	{
		return $query->where('type', '=', self::TYPE_PLOT);
	}
	
	/**
	 * Выбрать описания персонажей
	 *
	 * @param Builder $query
	 * @return Builder
	 */
	public function scopeCharacters(Builder $query)
	{
		return $query->where('type', '=', self::TYPE_CHARACTER);
	}
	
	/**
	 * Выбрать описания мест
	 *
	 * @param Builder $query
	 * @return Builder
	 */
	public function scopePlaces(Builder $query)
	{
		return $query->where('type', '=', self::TYPE_PLACE);
	}
}
