<?php

namespace App\Enums;

/**
 * Class UserTypes
 * @package App\Enums
 */
final class UserStatus
{
	/**
	 * Статусы пользователей
	 */
	const ADMIN     = 'admin';
	const MODERATOR = 'moderator';
	const CORRECTOR = 'corrector';
	const WRITER    = 'writer';
	const READER    = 'reader';
	
	/**
	 * Названия статусов
	 */
	const STATUSES = [
		self::ADMIN     => 'Администратор',
		self::MODERATOR => 'Модератор',
		self::CORRECTOR => 'Корректор',
		self::WRITER    => 'Писатель',
		self::READER    => 'Читатель',
	];
}