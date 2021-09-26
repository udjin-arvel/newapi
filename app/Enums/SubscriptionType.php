<?php

namespace App\Enums;

/**
 * Class SubscriptionType
 * @package App\Enums
 */
final class SubscriptionType
{
	/**
	 * Типы подписок
	 */
	const USER        = 'user';
	const COMPOSITION = 'composition';
	const NOTION      = 'notion';
	const SHORT       = 'short';
	const LORE_ITEM   = 'lore-item';
	
	/**
	 * Названия подписок
	 */
	const TYPES = [
		self::USER        => 'на истории пользователя',
		self::COMPOSITION => 'на истории композиции',
		self::NOTION      => 'на новые понятия',
		self::SHORT       => 'на краткие сюжеты',
		self::LORE_ITEM   => 'на элементы лора',
	];
}