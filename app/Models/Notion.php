<?php

namespace App\Models;

use App\Contracts\NewsContract;
use App\Contracts\NotificationContract;
use App\Contracts\RewardContract;
use App\Contracts\ViewContract;
use App\Models\Traits\Commentable;
use App\Models\Traits\ScopePublished;
use App\Models\Traits\Taggable;
use App\Models\Traits\UserRelation;
use Cog\Likeable\Traits\Likeable;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Notion
 * @package App\Models
 *
 * @property int    $user_id
 * @property int    $level
 * @property string $title
 * @property string $text
 * @property string $poster
 * @property int    $type
 * @property bool   $is_published
 */
class Notion extends AModel
{
    use SoftDeletes,
        ScopePublished,
        UserRelation,
        Likeable,
        Commentable,
        Taggable;
    
    /**
     * Типы понятий
     */
    const TYPES = [
        'definition' => 'Определение',
        'character'  => 'Персонаж',
        'place'      => 'Место',
        'entity'     => 'Сущность',
        'event'      => 'Событие',
    ];
    
    protected $related = [
        'tags',
        'user',
        'likes',
        'comments',
    ];
    
    /**
     * @var array
     */
    protected $contracts = [
        ViewContract::class,
        NewsContract::class,
        RewardContract::class,
        NotificationContract::class,
    ];
}
