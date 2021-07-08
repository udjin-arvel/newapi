<?php

namespace App\Models;

use App\Models\Interfaces\ITypes;
use App\Models\Traits\Taggable;
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
class Notion extends AModel implements ITypes
{
    use SoftDeletes,
        Taggable;
    
    /**
     * Типы понятий
     */
    const TYPE_DEFINITION = 'type-definition';
    const TYPE_CHARACTER  = 'type-character';
    const TYPE_PLACE      = 'type-place';
    const TYPE_ENTITY     = 'type-entity';
    const TYPE_EVENT      = 'type-event';
    
    /**
     * Получить типы модели
     * @return array
     */
    public static function getTypes(): array
    {
        return [
            self::TYPE_DEFINITION => 'Определение',
            self::TYPE_CHARACTER  => 'Персонаж',
            self::TYPE_PLACE      => 'Место',
            self::TYPE_EVENT      => 'Событие',
            self::TYPE_ENTITY     => 'Сущность',
        ];
    }
}
