<?php

namespace App\Enums;

use App\Models\Composition;
use App\Models\Description;
use App\Models\LoreItem;
use App\Models\Note;
use App\Models\Notion;
use App\Models\Story;

/**
 * Class Enum
 * @package App\Enums
 */
class Enum
{
	/**
	 * Алиасы моделей
	 * @var array
	 */
	protected $aliases = [
		'story'       => Story::class,
		'notion'      => Notion::class,
		'loreItem'    => LoreItem::class,
		'note'        => Note::class,
		'description' => Description::class,
		'composition' => Composition::class,
	];
	
	/**
	 * Типы моделей
	 * @var array
	 */
	protected $types = [
		'description' => [
			Description::TYPE_PLOT      => 'Описание сюжета',
			Description::TYPE_PLACE     => 'Описание места',
			Description::TYPE_CHARACTER => 'Описание персонажа',
		],
		'composition' => [
			Composition::TYPE_BOOK   => 'Книга',
			Composition::TYPE_SERIES => 'Серия',
		],
		'story' => [
			Story::TYPE_STORY    => 'История',
			Story::TYPE_ANNOUNCE => 'Анонс',
		],
		'notion' => [
			Notion::TYPE_DEFINITION => 'Определение',
			Notion::TYPE_CHARACTER  => 'Персонаж',
			Notion::TYPE_PLACE      => 'Место',
			Notion::TYPE_ENTITY     => 'Сущность',
			Notion::TYPE_EVENT      => 'Событие',
		],
	];
	
	/**
	 * Получить все перечисления
	 * @return array
	 */
	public function all(): array
	{
		return get_object_vars($this);
	}
	
	/**
	 * Получить перечисления по конкретному свойству
	 *
	 * @param string $propertyName
	 * @return mixed
	 */
	public function path(string $propertyName)
	{
		if (false !== strripos($propertyName, '.')) {
			$record = $this;
			
			foreach (explode('.', $propertyName) as $property) {
				switch (gettype($record)) {
					case 'object': $record = $record->{$property} ?? ''; break;
					case 'array':  $record = $record[$property] ?? ''; break;
					case 'string': return $record;
				}
			}
			
			return $record;
		}
		
		if (isset($this->{$propertyName})) {
			return $this->{$propertyName};
		}
		
		return [];
	}
	
	/**
	 * Прокси для getEnumValue
	 *
	 * @param $key
	 * @return string|null
	 */
	public function byKey(string $key): ?string
	{
		$data = $this->all();
		return $data[$key] ?? null;
	}
	
	/**
	 * Прокси для getEnumValue
	 *
	 * @param $value
	 * @return string|null
	 */
	public function byValue(string $value): ?string
	{
		$data = array_flip($this->all());
		return $data[$value] ?? null;
	}
}
