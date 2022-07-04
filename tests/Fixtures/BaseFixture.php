<?php

namespace Tests\Fixtures;

use App\Models\Composition;
use App\Models\Description;
use App\Models\Story;
use App\Models\Tag;
use App\Models\User;
use Faker\Generator as Faker;

/**
 * Class BaseFixture
 * @package Tests\Fixtures
 *
 *  Возможные типы шаблона:
 *  string, text, number, boolean, id, ids, type, class
 *  короткая строка (кол-во слов), длинный текст (кол-во символов), число (диапазон или максимальное число), булево, случайное
 * id из списка указанных моделей, несколько id из списка указанных моделей, случайный тип модели, полное имя класса модели
 *
 *  Примеры строк шаблона:
 *  id|composition - вместо id также может быть ids, type. Это запись означает, что нужно взять один id, несколько или случайный
 * тип у модели composition
 *  text|200 - случайный текст в 200 символов
 *  number|20 - случайное число от 1 до 20
 *  fragments|2:20 - создасться массив fragments, имеющий 2 до 20 элементов
 *  fragments|20 - создасться массив fragments, имеющий ровно 20 элементов
 */
class BaseFixture
{
	/**
	 * Дефолтные установки
	 */
	const DEFAULT_TEXT_SIZE   = 200;
	const DEFAULT_NUMBER_SIZE = 20;
	const DEFAULT_WORDS_COUNT = [1, 6];
	const DEFAULT_IDS_COUNT   = [2, 5];
	
	/**
	 * Схема фикстуры
	 * @var array
	 */
	protected $template;
	
	/**
	 * Используемые в шаблоне модели
	 * @var array
	 */
	private $models = [
		'composition' => Composition::class,
		'user'        => User::class,
		'story'       => Story::class,
		'description' => Description::class,
		'tag'         => Tag::class,
	];
	
	/**
	 * @var Faker
	 */
	private $faker;
	
	/**
	 * Получить фикстуру
	 *
	 * @param Faker $faker
	 * @param array $excluded
	 * @return array
	 */
	public static function getFixture(Faker $faker, array $excluded = []): array
	{
		$instance = new static;
		
		if (empty($instance->template)) {
			return [];
		}
		
		if (!empty($excluded)) {
			foreach ($instance->template as $key => $template) {
				$clearedKey = $instance->parseRule($key)['type'];
				if ($clearedKey && in_array($clearedKey, $excluded)) {
					unset($instance->template[$key]);
				}
			}
		}
		
		$instance->faker = $faker;
		return $instance->takeTemplate($instance->template);
	}
	
	/**
	 * @param array $template
	 * @return array
	 */
	private function takeTemplate(array $template): array
	{
		$data = [];
		
		foreach ($template as $key => $templateLine) {
			if (is_array($templateLine)) {
				$rules = $this->parseRule($key);
				$data[$rules['type']] = $this->generateArrayByTemplate($templateLine, $rules);
				continue;
			}
			
			$generatedValue = $this->generateValueByTemplate($templateLine);
			if ($generatedValue) {
				$data[$key] = $generatedValue;
			}
		}
		
		return $data;
	}
	
	/**
	 * Развернуть правило из строки шаблона
	 *
	 * @param string $rule
	 * @return array
	 */
	private function parseRule(string $rule): array
	{
		$getRangeOrClass = function ($rule) {
			if (false !== strripos($rule, ':')) {
				list($min, $max) = explode(':', $rule);
				return ['min' => $min, 'max' => $max];
			} elseif (is_numeric($rule)) {
				return ['max' => $rule];
			} else {
				return ['class' => $rule];
			}
		};
		
		$explodedRule = explode('|', $rule);
		$result = ['type' => $explodedRule[0]];
		
		switch (count($explodedRule)) {
			case 2: $result = array_merge($result, $getRangeOrClass($explodedRule[1])); break;
			case 3: $result = array_merge($result, ['class' => $explodedRule[1]], $getRangeOrClass($explodedRule[2])); break;
		}
		
		return $result;
	}
	
	/**
	 * Сгенерировать массив по шаблону
	 *
	 * @param array $template
	 * @param array $rules
	 * @return array
	 */
	private function generateArrayByTemplate(array $template, array $rules): array
	{
		$count = empty($rules['min']) ? $rules['max'] : $this->faker->numberBetween($rules['min'], $rules['max']);
		return array_fill(0, $count, $this->takeTemplate($template));
	}
	
	/**
	 * Сгенерировать значение по шаблону
	 *
	 * @param string $template
	 * @return mixed
	 */
	private function generateValueByTemplate(string $template)
	{
		$rules = $this->parseRule($template);
		
		switch ($rules['type']) {
			case 'text':    return $this->faker->realText($rules['max'] ?? self::DEFAULT_TEXT_SIZE);
			case 'boolean': return $this->faker->boolean;
			case 'class':   return isset($rules['class']) ? ($this->models[$rules['class']] ?? '') : '';
			case 'number':  return isset($rules['min'])
				? $this->faker->numberBetween($rules['min'], $rules['max'])
				: $this->faker->numberBetween(1, $rules['max'] ?? self::DEFAULT_NUMBER_SIZE);
			
			case 'string':
				list($min, $max) = isset($rules['min']) ? [$rules['min'], $rules['max']] : self::DEFAULT_WORDS_COUNT;
				return $this->faker->sentence($this->faker->numberBetween($min, $rules['max'] ?? $max));
				
			case 'id':
			case 'ids':
				if (!isset($rules['class']) || !isset($this->models[$rules['class']])) return '';
				
				$modelClass = $this->models[$rules['class']];
				$ids = \DB::table(app($modelClass)->getTable())->pluck('id')->toArray();
				
				if (empty($ids)) return '';
				
				if ('ids' === $rules['type']) {
					if (!isset($rules['min']) && isset($rules['max'])) {
						return $this->faker->randomElements($ids, $rules['max'], false);
					}
					
					list($min, $max) = isset($rules['min'], $rules['max']) ? [$rules['min'], $rules['max']] : self::DEFAULT_IDS_COUNT;
					return $this->faker->randomElements($ids, $this->faker->numberBetween($min, $max), false);
				}
				
				return $this->faker->randomElement($ids);
				
			case 'type':
				if (isset($this->models[$rules['class']])) {
					$modelClass = $this->models[$rules['class']];
					
					if (defined("{$modelClass}::TYPES")) {
						return $this->faker->randomElement(array_keys($modelClass::TYPES));
					}
				}
		}
		
		return '';
	}
}
