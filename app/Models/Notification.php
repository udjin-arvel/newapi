<?php

namespace App\Models;

use App\Scopes\UserIdScope;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Note
 * @package App\Models
 *
 * @property int     $content_id
 * @property string  $content_type
 * @property int     $user_id
 */
class Notification extends Model
{
    const TYPE_STORY  = 1;
    
    /**
     * @return void
     */
    protected static function boot()
    {
        parent::boot();
        
        static::addGlobalScope(new UserIdScope);
    }
}
