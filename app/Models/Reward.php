<?php

namespace App\Models;

use App\Models\Traits\Contentable;
use App\Models\Traits\UserRelation;
use Cog\Likeable\Models\Like;

/**
 * Class Reward
 * @package App\Models
 *
 * @property int    $exp_amount
 * @property int    $user_id
 * @property int    $content_id
 * @property string $content_type
 * @property string $type
 */
class Reward extends BaseModel
{
    use UserRelation, Contentable;
    
	/**
	 * @var array
	 */
    protected $fillable = [
      'content_id',
      'content_type',
      'user_id',
      'exp_amount',
    ];
    
    /**
     * @var array
     */
	const TYPES = [
		'view'         => 'Просмотр истории, понятия или элемента лора',
		'story'        => 'Создание истории',
		'notion'       => 'Создание понятия',
		'composition'  => 'Создание книги или серии',
		'note'         => 'Создание заметки',
		'comment'      => 'Оставление коммента',
		'correction'   => 'Внесение исправления',
		'image'        => 'Добавление изображения к книге, серии, понятию или элементу лора',
		'like'         => 'Добавление лайка',
		'dislike'      => 'Добавление дизлайка',
		'tag'          => 'Добавление тега к истории, понятию или элементу лора',
		'subscription' => 'Подписка на контент',
		'short'        => 'Добавить краткий сюжет',
		'description'  => 'Добавить описание персонажа, места или события',
		'blank'        => 'Добавить заготовку для сюжета',
		'fragment'     => 'Добавить фрагмент к истории или другому контенту',
	];
	
	/**
	 * @var array
	 */
	const TYPE_IN_CLASS = [
		'view'         => View::class,
		'story'        => Story::class,
		'notion'       => Notion::class,
		'composition'  => Composition::class,
		'note'         => Note::class,
		'comment'      => Comment::class,
		'correction'   => Correction::class,
		'image'        => Image::class,
		'like'         => Like::class,
		'dislike'      => Like::class,
		'tag'          => Tag::class,
		'subscription' => Subscription::class,
		'short'        => Short::class,
		'description'  => Description::class,
		'blank'        => Blank::class,
		'fragment'     => Fragment::class,
	];
    
	/**
	 * @var array
	 */
	const REWARD_FOR_TYPE = [
		'view'         => 10,
		'story'        => 750,
		'notion'       => 500,
		'composition'  => 250,
		'note'         => 50,
		'comment'      => 50,
		'correction'   => 100,
		'image'        => 10,
		'like'         => 10,
		'dislike'      => 5,
		'tag'          => 50,
		'subscription' => 20,
		'short'        => 1000,
		'description'  => 100,
		'blank'        => 50,
		'fragment'     => 10,
	];
	
	/**
	 * Размер опыта за действие
	 *
	 * @param string $type
	 * @return int
	 */
    public static function getExpAmountByType(string $type): int
    {
    	return self::REWARD_FOR_TYPE[$type] ?? 1;
    }
	
	/**
	 * Получить тип по классу модели
	 *
	 * @param string $className
	 * @return string
	 */
	public static function getTypeByClassName(string $className): string
	{
		return array_flip(self::TYPE_IN_CLASS)[$className] ?? '';
	}
}
