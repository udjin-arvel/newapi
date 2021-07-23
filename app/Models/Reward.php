<?php

namespace App\Models;

use App\Models\Traits\UserRelation;

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
class Reward extends AModel
{
    use UserRelation;
    
    protected $fillable = [
      'content_id',
      'content_type',
      'user_id',
      'exp_amount',
    ];
    
    /**
     * Типы наград
     */
    const TYPES = [
        'view'         => [
            'class'      => View::class,
            'title'      => 'Просмотр истории, понятия или элемента лора',
            'exp_amount' => 10,
        ],
        'story'        => [
            'class'      => Story::class,
            'title'      => 'Создание истории',
            'exp_amount' => 750,
        ],
        'notion'       => [
            'class'      => Notion::class,
            'title'      => 'Создание понятия',
            'exp_amount' => 500,
        ],
        'composition'  => [
            'class'      => Composition::class,
            'title'      => 'Создание книги или серии',
            'exp_amount' => 250,
        ],
        'note'         => [
            'class'      => Note::class,
            'title'      => 'Создание заметки',
            'exp_amount' => 50,
        ],
        'comment'      => [
            'class'      => Comment::class,
            'title'      => 'Оставление коммента',
            'exp_amount' => 50,
        ],
        'correction'   => [
            'class'      => Correction::class,
            'title'      => 'Внесение исправления',
            'exp_amount' => 100,
        ],
        'image'        => [
            'class'      => Image::class,
            'title'      => 'Добавление изображения к книге, серии, понятию или элементу лора',
            'exp_amount' => 10,
        ],
        'like'         => [
            'class'      => Like::class,
            'title'      => 'Добавление лайка',
            'exp_amount' => 10,
        ],
        'dislike'      => [
            'class'      => Like::class,
            'title'      => 'Добавление дизлайка',
            'exp_amount' => 5,
        ],
        'tag'          => [
            'class'      => Tag::class,
            'title'      => 'Добавление тега к истории, понятию или элементу лора',
            'exp_amount' => 50,
        ],
        'subscription' => [
            'class'      => Subscription::class,
            'title'      => 'Подписка на контент',
            'exp_amount' => 10,
        ],
        'connection'   => [
            'class'      => Connection::class,
            'title'      => 'Предложить связь между историями',
            'exp_amount' => 100,
        ],
        'short'        => [
            'class'      => Short::class,
            'title'      => 'Добавить краткий сюжет',
            'exp_amount' => 1000,
        ],
    ];
}
