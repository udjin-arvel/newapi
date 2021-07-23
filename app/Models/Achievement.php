<?php

namespace App\Models;

use App\Models\Traits\UserRelation;

/**
 * Class Achievement
 * @package App\Models
 *
 * @property int    $user_id
 * @property string $achievement
 */
class Achievement extends AModel
{
    use UserRelation;
    
    /**
     * Ачивки по историям
     */
    const ACHIEVEMENT_INSTORIUM = [
        'title' => 'Instorium',
        'children' => [
            'story_amount_1' => [
                'title'      => 'Создал первую историю!',
                'status'     => 'Начинающий инстория',
                'exp_amount' => 250,
            ],
            'story_amount_5' => [
                'title'      => 'Создал пять историй!',
                'status'     => 'Капеллан-инстория',
                'exp_amount' => 500,
            ],
            'story_amount_10' => [
                'title'      => 'Создал десять историй!',
                'status'     => 'Инсторус',
                'exp_amount' => 750,
            ],
            'story_amount_15' => [
                'title'      => 'Создал пятнадцать историй!',
                'status'     => 'Инсторус',
                'exp_amount' => 1000,
            ],
            'story_amount_20' => [
                'title'      => 'Создал двадцать историй!',
                'status'     => 'Номинарх-инсториат',
                'exp_amount' => 1500,
            ],
        ],
    ];
    
    /**
     * Ачивки по понятиям
     */
    const ACHIEVEMENT_NOTARIAT = [
        'title' => 'Notariat',
        'children' => [
            'notion_amount_4' => [
                'title'      => 'Добавил четыре понятия!',
                'status'     => 'Юный архивариус',
                'exp_amount' => 250,
            ],
            'notion_amount_8' => [
                'title'      => 'Добавил восемь понятий!',
                'status'     => 'Старший архивариус',
                'exp_amount' => 500,
            ],
            'notion_amount_14' => [
                'title'      => 'Добавил четырнадцать понятий!',
                'status'     => 'Литерасус',
                'exp_amount' => 750,
            ],
            'notion_amount_22' => [
                'title'      => 'Добавил двадцать два понятия!',
                'status'     => 'Неологист',
                'exp_amount' => 1000,
            ],
            'notion_amount_32' => [
                'title'      => 'Добавил тридцать два понятия!',
                'status'     => 'Золотой композиционер',
                'exp_amount' => 1500,
            ],
        ],
    ];
    
    /**
     * Ачивки по композициям, элементам лора, коротким историям
     */
    const ACHIEVEMENT_MINISTORIA = [
        'title' => 'Ministoria',
        'children' => [
            'correction_amount_20' => [
                'title'      => 'Совершил двадцать исправлений!',
                'status'     => '',
                'exp_amount' => 500,
            ],
            'correction_amount_50' => [
                'title'      => 'Совершил пятьдесят исправлений!',
                'status'     => '',
                'exp_amount' => 1000,
            ],
            'comment_amount_50' => [
                'title'      => 'Оставил пятьдесят комментариев!',
                'status'     => '',
                'exp_amount' => 500,
            ],
            'comment_amount_100' => [
                'title'      => 'Оставил сто комментария!',
                'status'     => '',
                'exp_amount' => 1000,
            ],
            'image_amount_50' => [
                'title'      => 'Добавил пятьдесят изображений!',
                'status'     => '',
                'exp_amount' => 350,
            ],
            'image_amount_100' => [
                'title'      => 'Добавил сто изображений!',
                'status'     => '',
                'exp_amount' => 700,
            ],
        ],
    ];
    
    /**
     * Список ачивок
     */
    const ACHIEVEMENTS = [
        'story' => self::ACHIEVEMENT_INSTORIUM,
    ];
    
    protected $fillable = [
        'achievement',
        'user_id',
    ];
}
