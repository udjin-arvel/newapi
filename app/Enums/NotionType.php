<?php

namespace App\Enums;

/**
 * Class NotionType
 * @package App\Enums
 */
final class NotionType
{
	/**
	 * Типы понятий
	 */
	const DEFINITION = 'definition';
	const CHARACTER  = 'character';
	const PLACE      = 'place';
	const ENTITY     = 'entity';
	const EVENT      = 'event';
	
	/**
	 * Названия типов
	 */
	const TYPES = [
		self::DEFINITION => 'Определение',
		self::CHARACTER  => 'Персонаж',
		self::PLACE      => 'Место',
		self::ENTITY     => 'Сущность',
		self::EVENT      => 'Событие',
	];
}