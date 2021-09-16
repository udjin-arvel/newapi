<?php

namespace App\Models;

use App\Models\Traits\Contentable;

/**
 * Class News
 * @package App\Models
 *
 * @property int     $content_id
 * @property string  $content_type
 * @property string  $text
 * @property string  $title
 */
class News extends AbstractModel
{
	use Contentable;
	
    /**
     * Контект, который имеет комментарии
     */
    const TYPES = [
        'story'       => Story::class,
        'notion'      => Notion::class,
        'loreitem'    => LoreItem::class,
        'composition' => Composition::class,
        'user'        => User::class,
    ];
	
	/**
	 * Вариации новостей
	 */
	const ACTION_CREATE = 'create';
	const ACTION_UPDATE = 'update';
	
	/**
	 * @var array
	 */
    protected $fillable = [
      'content_id',
      'content_type',
      'text',
      'action',
      'updated_at',
    ];
	
	/**
	 * @var array
	 */
	public $timestamps = ['updated_at'];
	
	/**
	 * Получить текст новости
	 *
	 * @param string $className
	 * @param string $action
	 * @param string $title
	 * @return string
	 */
	public static function getNewsText(string $className, string $title, string $action): string
	{
		if ($action === self::ACTION_CREATE) {
			switch ($className) {
				case Notion::class: return "Новое понятие «{$title}» было создано";
				case Story::class: return "Новая история «{$title}» была создана";
				case LoreItem::class: return "Новый элемент лора «{$title}» был создан";
				case Composition::class: return "Новая композиция «{$title}» была создана";
				case User::class: return "Зарегистрирован новый пользовать: «{$title}»";
				default: return '';
			}
		} else {
			switch ($className) {
				case Notion::class: return "Понятие «{$title}» было обновлено";
				case Story::class: return "История «{$title}» была создана";
				case LoreItem::class: return "Элемент лора «{$title}» был создан";
				case Composition::class: return "Композиция «{$title}» была обновлена";
				default: return '';
			}
		}
	}
}
