<?php

namespace App\Enums;

use App\Models\Composition;
use App\Models\Correction;
use App\Models\Description;
use App\Models\LoreItem;
use App\Models\Note;
use App\Models\Notification;
use App\Models\Notion;
use App\Models\Story;
use App\Models\Subscription;
use App\Models\User;

/**
 * Class Enum
 * @package App\Enums
 */
class Enum
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
	const ALIASES = [
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
	 * Перечисления типов
	 * @var array
	 */
	const ENUM_TYPE = [
		self::STORY        => StoryType::class,
		self::COMPOSITION  => CompositionType::class,
		self::DESCRIPTION  => DescriptionType::class,
		self::NOTION       => NotionType::class,
		self::SUBSCRIPTION => SubscriptionType::class,
	];
	
	/**
	 * Перечисления статусов
	 * @var array
	 */
	const ENUM_STATUS = [
		self::USER       => UserStatus::class,
		self::CORRECTION => CorrectionStatus::class,
	];
	
	/**
	 * Получить все алиасы
	 *
	 * @param bool $onlyAliases
	 * @return array
	 */
	public function aliases($onlyAliases = true): array
	{
		return $onlyAliases ? array_keys(self::ALIASES) : self::ALIASES;
	}
	
	/**
	 * Получить класс по алиасу
	 *
	 * @param string $alias
	 * @return string|null
	 */
	public function modelByAlias(string $alias): ?string
	{
		return self::ALIASES[$alias] ?? null;
	}
	
	/**
	 * Получить алиас по классу
	 *
	 * @param string $className
	 * @return string|null
	 */
	public function aliasByModel(string $className): ?string
	{
		return array_flip(self::ALIASES)[$className] ?? null;
	}
	
	/**
	 * Вернуть типы по алиасу
	 *
	 * @param string $alias
	 * @return array
	 */
	public function typesByAlias(string $alias): array
	{
		if (isset(self::ENUM_TYPE[$alias])) {
			$enumClass = self::ENUM_TYPE[$alias];
			return $enumClass::TYPES;
		}
		
		return [];
	}
	
	/**
	 * Вернуть типы по классу
	 *
	 * @param string $className
	 * @return array
	 */
	public function typesByModel(string $className): array
	{
		$alias = $this->aliasByModel($className);
		return $this->typesByAlias($alias);
	}
	
	/**
	 * Получить значение типа по модели с типами и по модели алиаса
	 *
	 * @param string $typedModel
	 * @param string $aliasedModel
	 * @return string|null
	 */
	public function getTypeByModelsTypeAndAlias(string $typedModel, string $aliasedModel): ?string
	{
		$types = $this->typesByModel($typedModel);
		$alias = $this->aliasByModel($aliasedModel);
		
		return $types[$alias] ?? null;
	}
	
	/**
	 * Получить все типы соответствующих перечислений
	 * @return array
	 */
	public function types(): array
	{
		return collect(self::ENUM_TYPE)->map(function ($enum) {
			return $enum::TYPES ?? [];
		})->all();
	}
	
	/**
	 * Получить все статусы соответствующих перечислений
	 * @return array
	 */
	public function statuses(): array
	{
		return collect(self::ENUM_STATUS)->map(function ($enum) {
			return $enum::STATUSES ?? [];
		})->all();
	}
}
