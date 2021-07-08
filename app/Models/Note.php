<?php

namespace App\Models;

use App\Models\Interfaces\ITypes;
use App\Models\Traits\UserRelation;
use App\Scopes\UserIdScope;
use Illuminate\Database\Eloquent\Model;

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
class Note extends Model implements ITypes
{
    use UserRelation;
    
    /**
     * Типы заметок
     */
    public const TYPE_NO_SUBJECT     = 'no_subject';
    public const TYPE_PLOT_LAYOUT    = 'plot_layout';
    public const TYPE_CHARACTER_INFO = 'character_info';
    public const TYPE_THING_INFO     = 'place_info';
    public const TYPE_GOOD_IDEA      = 'good_idea';
    
    /**
     * @return void
     */
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new UserIdScope);
    }
    
    /**
     * @return array
     */
    public static function getTypes(): array
    {
        return [
            self::TYPE_NO_SUBJECT     => 'Без назначения',
            self::TYPE_PLOT_LAYOUT    => 'Заготовка сюжета',
            self::TYPE_CHARACTER_INFO => 'Информация о персонаже',
            self::TYPE_THING_INFO     => 'Информация о месте, предмете или понятии',
            self::TYPE_GOOD_IDEA      => 'Хорошая идея',
        ];
    }
}
