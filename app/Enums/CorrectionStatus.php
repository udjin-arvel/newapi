<?php

namespace App\Enums;

/**
 * Class CorrectionStatus
 * @package App\Enums
 */
final class CorrectionStatus
{
	/**
	 * Статусы исправления
	 */
	const PENDING  = 'pending';
	const CANCELED = 'canceled';
	const ACCEPTED = 'accepted';
	
	/**
	 * Названия статусов исправлений
	 */
	const STATUSES = [
		self::PENDING  => 'На рассмотрении',
		self::CANCELED => 'Отменено',
		self::ACCEPTED => 'Принято',
	];
}