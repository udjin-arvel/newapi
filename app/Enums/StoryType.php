<?php

namespace App\Enums;

/**
 * Class StoryType
 * @package App\Enums
 */
final class StoryType
{
	/**
	 * Типы историй
	 */
	const STORY    = 'story';
	const ANNOUNCE = 'announce';
	
	/**
	 * Названия типов
	 */
	const TYPES = [
		self::STORY    => 'История',
		self::ANNOUNCE => 'Анонс',
	];
}