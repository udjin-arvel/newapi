<?php

namespace App\Models;

use App\Models\Traits\UserRelation;
use App\Scopes\UserIdScope;

/**
 * Class UserView
 * @package App\Models
 *
 * @property int    $user_id
 * @property int    $content_id
 * @property string $content_type
 */
class View extends AModel
{
    use UserRelation;

    protected $fillable = [
        'content_id',
        'content_type',
        'user_id',
    ];
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function content()
    {
        return $this->morphTo();
    }
}
