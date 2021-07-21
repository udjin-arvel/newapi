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
    const TYPE_MODEL_VIEW        = View::class;
    const TYPE_MODEL_STORY       = Story::class;
    const TYPE_MODEL_NOTION      = Notion::class;
    const TYPE_MODEL_COMPOSITION = Composition::class;
    const TYPE_MODEL_NOTE        = Note::class;
    const TYPE_MODEL_COMMENT     = Comment::class;
    const TYPE_MODEL_CORRECTION  = Correction::class;
    const TYPE_MODEL_IMAGE       = Image::class;
    const TYPE_MODEL_LIKE        = Like::class;
    const TYPE_MODEL_TAG         = Tag::class;
    
    /**
     * Количество опыта за действие
     */
    const REWARD_EXP_AMOUNT = [
        self::TYPE_MODEL_VIEW        => 10,
        self::TYPE_MODEL_STORY       => 750,
        self::TYPE_MODEL_NOTION      => 500,
        self::TYPE_MODEL_COMPOSITION => 250,
        self::TYPE_MODEL_NOTE        => 50,
        self::TYPE_MODEL_COMMENT     => 50,
        self::TYPE_MODEL_CORRECTION  => 100,
        self::TYPE_MODEL_IMAGE       => 50,
        self::TYPE_MODEL_LIKE        => 10,
        self::TYPE_MODEL_TAG         => 50,
    ];
    
    /**
     * Наименование наград
     */
    const REWARD_TITLES = [
        self::TYPE_MODEL_VIEW        => 'Просмотр истории, понятия или элемента лора',
        self::TYPE_MODEL_STORY       => 'Создание истории',
        self::TYPE_MODEL_NOTION      => 'Создание понятия',
        self::TYPE_MODEL_COMPOSITION => 'Создание книги или серии',
        self::TYPE_MODEL_NOTE        => 'Создание заметки',
        self::TYPE_MODEL_COMMENT     => 'Оставление коммента',
        self::TYPE_MODEL_CORRECTION  => 'Внесение исправления',
        self::TYPE_MODEL_IMAGE       => 'Добавление изображения к книге, серии, понятию или элементу лора',
        self::TYPE_MODEL_LIKE        => 'Добавление лайка',
        self::TYPE_MODEL_TAG         => 'Добавление тега к истории, понятию или элементу лора',
    ];
}
