<?php

namespace App\Capacitors;

use App\Models\Composition;
use App\Models\Correction;
use App\Models\Description;
use App\Models\LoreItem;
use App\Models\Note;
use App\Models\Notion;
use App\Models\Story;
use App\Models\Subscription;
use App\Models\User;
use Notification;

/**
 * Class AliasCapacitor
 * @package App\Capacitors
 */
final class AliasCapacitor
{
	/**
	 * Алиасы для моделей
	 */
	const STORY        = 'story';
	const NOTION       = 'notion';
	const LORE_ITEM    = 'loreitem';
	const NOTE         = 'note';
	const DESCRIPTION  = 'description';
	const COMPOSITION  = 'composition';
	const SUBSCRIPTION = 'subscription';
	const NOTIFICATION = 'notification';
	const USER         = 'user';
	const CORRECTION   = 'correction';
	
	/**
	 * Связь алиаса с моделью
	 * @var array
	 */
	const ALIAS_CLASS = [
		self::STORY        => Story::class,
		self::NOTION       => Notion::class,
		self::LORE_ITEM    => LoreItem::class,
		self::NOTE         => Note::class,
		self::DESCRIPTION  => Description::class,
		self::COMPOSITION  => Composition::class,
		self::SUBSCRIPTION => Subscription::class,
		self::NOTIFICATION => Notification::class,
		self::USER         => User::class,
		self::CORRECTION   => Correction::class,
	];
	
	/**
	 * Перечисления статусов
	 * @var array
	 */
	const ALIAS_STATUSES = [
		self::USER => [
			User::STATUS_ADMIN     => 'Администратор',
			User::STATUS_MODERATOR => 'Модератор',
			User::STATUS_CORRECTOR => 'Корректор',
			User::STATUS_WRITER    => 'Писатель',
			User::STATUS_READER    => 'Читатель',
		],
		self::CORRECTION =>[
			Correction::STATUS_PENDING => 'На рассмотрении',
			Correction::STATUS_CANCELED => 'Отменено',
			Correction::STATUS_ACCEPTED => 'Принято',
		],
	];
	
	/**
	 * Перечисление типо
	 * @var array
	 */
	const ALIAS_TYPES = [
		self::STORY => [
			Story::TYPE_STORY    => 'История',
			Story::TYPE_ANNOUNCE => 'Анонс',
		],
		self::NOTION => [
			Notion::TYPE_DEFINITION => 'Определение',
			Notion::TYPE_CHARACTER  => 'Персонаж',
			Notion::TYPE_PLACE      => 'Место',
			Notion::TYPE_ENTITY     => 'Сущность',
			Notion::TYPE_EVENT      => 'Событие',
		],
		self::COMPOSITION => [
			Composition::TYPE_BOOK   => 'Книга',
			Composition::TYPE_SERIES => 'Серия',
		],
		self::DESCRIPTION => [
			Description::TYPE_SUBJECT    => 'Объект',
			Description::TYPE_PLOT       => 'Сюжет',
			Description::TYPE_PLACE      => 'Место',
			Description::TYPE_CHARACTER  => 'Персонаж',
			Description::TYPE_EVENT      => 'Событие',
			Description::TYPE_PHENOMENON => 'Явление',
		],
		self::SUBSCRIPTION => [
			Subscription::TYPE_USER        => 'на истории пользователя',
			Subscription::TYPE_COMPOSITION => 'на истории композиции',
			Subscription::TYPE_NOTION      => 'на новые понятия',
			Subscription::TYPE_SHORT       => 'на краткие сюжеты',
			Subscription::TYPE_LORE_ITEM   => 'на элементы лора',
		],
	];
	
	/**
	 * Получить класс по алиасу
	 *
	 * @param string|null $alias
	 * @return string
	 */
	public static function getClassByAlias($alias)
	{
		if (in_array($alias, self::ALIAS_CLASS)) {
			return $alias;
		}
		
		if (isset(self::ALIAS_CLASS[$alias])) {
			return self::ALIAS_CLASS[$alias];
		}
		
		return null;
	}
	
	/**
	 * Вернуть алиас оп классу
	 *
	 * @param string|null $class
	 * @return string
	 */
	public static function getAliasByClass($class)
	{
		$list = array_flip(self::ALIAS_CLASS);
		
		if (isset($list[$class])) {
			return $list[$class];
		}
		
		return null;
	}
	
	/**
	 * Вернуть типы по алиасу
	 *
	 * @param string|null $alias
	 * @return array
	 */
	public static function getTypesByAlias($alias)
	{
		$alias = strtolower($alias);
		
		if (isset(self::ALIAS_TYPES[$alias])) {
			return self::ALIAS_TYPES[$alias];
		}
		
		return [];
	}
	
	/**
	 * Вернуть статусы по алиасу
	 *
	 * @param string|null $alias
	 * @return array
	 */
	public static function getStatusesByAlias($alias)
	{
		$alias = strtolower($alias);
		
		if (isset(self::ALIAS_STATUSES[$alias])) {
			return self::ALIAS_STATUSES[$alias];
		}
		
		return [];
	}
	
	/**
	 * Получить имя типа по алиасу и идентификатору
	 *
	 * @param string|null $alias
	 * @param string|null $type
	 * @return string
	 */
	public static function getTypeNameByAliasAndType($alias, $type)
	{
		if ($alias) {
			$types = self::getTypesByAlias($alias);
			return $types[$type] ?? '';
		}
		
		return '';
	}
}
