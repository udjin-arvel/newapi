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
 * @property int     $content_id
 * @property string  $content_type
 * @property string  $message
 * @property int     $user_id
 */
class Notification extends Model implements ITypes
{
    use UserRelation;
    
    const TYPE_STORY   = 'type-story';
    const TYPE_NOTION  = 'type-notion';
    const TYPE_USER    = 'type-user';
    
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
            self::TYPE_STORY  => 'История',
            self::TYPE_NOTION => 'Понятие',
            self::TYPE_USER   => 'Пользователь',
        ];
    }
}
