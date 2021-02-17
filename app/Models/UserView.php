<?php

namespace App\Models;

use App\Exceptions\TBError;
use App\Models\Traits\UserTrait;
use App\Scopes\UserIdScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

/**
 * Class UserView
 * @package App\Models
 *
 * @property User $user
 */
class UserView extends Model
{
    use UserTrait;
    
    const TYPE_STORY     = 1;
    const TYPE_NOTION    = 2;
    const TYPE_LORE_ITEM = 3;
    
    /**
     * @return void
     */
    protected static function boot()
    {
        parent::boot();
        
        static::addGlobalScope(new UserIdScope);
    }
}
