<?php

namespace App\Models;

use App\Models\Traits\UserRelation;

/**
 * Class Comment
 * @package App\Models
 *
 * @property string $text
 * @property int    $content_id
 * @property string $content_type
 * @property int    $user_id
 * @property int    $parent_id
 */
class Comment extends AModel
{
    use UserRelation;
    
    /**
     * Контект, который имеет комментарии
     */
    const TYPES = [
        'story'    => Story::class,
        'notion'   => Notion::class,
        'loreitem' => LoreItem::class,
    ];
    
    protected $fillable = [
        'text',
        'parent_id',
        'content_id',
        'content_type',
    ];
}
