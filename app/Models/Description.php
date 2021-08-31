<?php

namespace App\Models;

use App\Models\Traits\UserRelation;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

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
 *
 * @method static Builder|Description realized()
 * @method static Builder|Description unrealized()
 * @method static Builder|Description published()
 * @method static Builder|Description attached()
 * @method static Builder|Description notAttached()
 * @method static Builder|Description plots()
 * @method static Builder|Description characters()
 * @method static Builder|Description places()
 */
class Description extends Model
{
	use UserRelation;
	
    /**
     * Типы сюжетов
     */
    const TYPE_PLOT      = 'type-plot';
	const TYPE_PLACE     = 'type-place';
	const TYPE_CHARACTER = 'type-character';
	
	const TYPES = [
		self::TYPE_PLOT      => 'Описание сюжета',
		self::TYPE_PLACE     => 'Описание места',
		self::TYPE_CHARACTER => 'Описание персонажа',
	];
	
	/**
	 * @return \Illuminate\Database\Eloquent\Relations\MorphTo
	 */
	public function content()
	{
		return $this->morphTo();
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
