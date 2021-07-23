<?php

namespace App\Models;

use App\Models\Traits\UserRelation;
use App\Scopes\UserIdScope;

/**
 * Class Note
 * @package App\Models
 *
 * @property int     $id
 * @property string  $title
 * @property string  $text
 * @property int     $user_id
 * @property int     $content_id
 * @property string  $content_type
 * @property string  $type
 * @property int     $importance
 */
class Note extends AModel
{
    use UserRelation;
    
    /**
     * Типы заметок
     */
    const TYPES = [
        'no_subject'     => 'Без назначения',
        'plot_layout'    => 'Заготовка сюжета',
        'character_info' => 'О персонаже',
        'place_info'     => 'О месте, предмете или понятии',
        'good_idea'      => 'Хорошая идея',
        'great_idea'     => 'Великолепная идея',
    ];
    
    /**
     * @return void
     */
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new UserIdScope);
    }
}
