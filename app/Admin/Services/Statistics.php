<?php

namespace App\Admin\Services;

use App\Models\Comment;
use App\Models\Composition;
use App\Models\Connection;
use App\Models\Correction;
use App\Models\Fragment;
use App\Models\Image;
use App\Models\Like;
use App\Models\LoreItem;
use App\Models\Note;
use App\Models\Notion;
use App\Models\Reward;
use App\Models\Short;
use App\Models\Story;
use App\Models\Subscription;
use App\Models\Tag;
use App\Models\User;
use App\Models\View;

/**
 * Class Statistics
 * @package App\Admin\Services
 */
class Statistics
{
    /**
     * Категории статистики
     */
    const CATEGORIES = [
        Story::class        => 'Истории',
        User::class         => 'Пользователи',
        Notion::class       => 'Понятия',
        View::class         => 'Просмотры',
        Comment::class      => 'Комментарии',
        Composition::class  => 'Композиции',
        LoreItem::class     => 'Элементы лора',
        Short::class        => 'Элементы краткой истории',
        Correction::class   => 'Исправления',
        Subscription::class => 'Подписки',
        Note::class         => 'Заметки',
        Tag::class          => 'Теги',
        Reward::class       => 'Награды',
        Fragment::class     => 'Фрагменты',
        Image::class        => 'Изображения',
    ];
    
    /**
     * Отрисовать статистику
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public static function render()
    {
        return view('admin.statistics', [
            'full'  => self::getFullStatistics(),
            'short' => self::getShortStatistics(),
        ]);
    }
    
    /**
     * Получить полную статистику
     * @return array
     */
    public static function getFullStatistics(): array
    {
        $data = [];
    
        $data[] = self::getStoryStatistics();
        
        return $data;
    }
    
    /**
     * Получить краткую статистику
     * @return array
     */
    public static function getShortStatistics(): array
    {
        $data = [];
        
        foreach (self::CATEGORIES as $className => $title) {
            $data[] = [
                'title' => $title,
                'count' => app($className)->count(),
            ];
        }
        
        return $data;
    }
    
    /**
     * @return array
     */
    public static function getStoryStatistics(): array
    {
        /**
         * @var Story $query
         */
        $query = Story::select('stories.*')->get();
        
	    $data = [
		    'Всего'                => $query->count(),
		    'Опубликованных'       => $query->count(),
		    'С композицией'        => $query->count(),
		    'Уникальных писателей' => $query->count(),
	    ];
        
        return $data;
    }
}
