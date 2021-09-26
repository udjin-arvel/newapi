<?php

namespace App\Enums;

/**
 * Class DescriptionType
 * @package App\Enums
 */
final class DescriptionType
{
	/**
	 * Типы описаний
	 */
	const PLOT      = 'plot';
	const PLACE     = 'place';
	const CHARACTER = 'character';
	
	/**
	 * Названия типов
	 */
	const TYPES = [
		self::PLOT      => 'Описание сюжета',
		self::PLACE     => 'Описание места',
		self::CHARACTER => 'Описание персонажа',
	];
}