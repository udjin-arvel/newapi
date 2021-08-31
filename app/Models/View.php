<?php

namespace App\Models;

use App\Models\Traits\UserRelation;

/**
 * Class UserView
 * @package App\Models
 *
 * @property int    $user_id
 * @property int    $content_id
 * @property string $content_type
 */
class View extends AbstractModel
{
    use UserRelation;

    protected $fillable = [
        'content_id',
        'content_type',
        'user_id',
    ];
    
    /**
     * Контент, которому принадлежит просмотр
     */
    public function content()
    {
        return $this->morphTo();
    }
}
