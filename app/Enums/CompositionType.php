<?php

namespace App\Enums;

/**
 * Class CompositionType
 * @package App\Enums
 */
final class CompositionType
{
	/**
	 * Типы произведений
	 */
	const BOOK   = 'book';
	const SERIES = 'series';
	
	/**
	 * Названия типов
	 */
	const TYPES = [
		self::BOOK   => 'Книга',
		self::SERIES => 'Серия',
	];
}