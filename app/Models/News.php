<?php

namespace App\Models;

/**
 * Class News
 * @package App\Models
 *
 * @property int     $content_id
 * @property string  $content_type
 * @property string  $text
 * @property string  $title
 */
class News extends AModel
{
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
    
    protected $fillable = [
      'content_id',
      'content_type',
      'text',
      'updated_at',
    ];
}
