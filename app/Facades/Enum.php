<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class Enum
 * @package App\Facades
 *
 * @method static array aliases($onlyAliases = true)
 * @method static string|null modelByAlias(string $alias)
 * @method static string|null aliasByModel(string $className)
 * @method static string|null getTypeByModelsTypeAndAlias(string $typedModel, string $aliasedModel)
 * @method static array typesByAlias(string $alias)
 * @method static array typesByModel(string $className)
 * @method static array types()
 * @method static array statuses()
 */
class Enum extends Facade {
	/**
	 * @return string
	 */
	protected static function getFacadeAccessor()
	{
		return 'enum';
	}
}