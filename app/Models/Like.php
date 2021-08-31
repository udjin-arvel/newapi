<?php

namespace App\Models;

use App\Models\Traits\UserRelation;

/**
 * Class Like
 * @package App\Models
 *
 * @property int    $user_id
 * @property int    $likeable_id
 * @property string $likeable_type
 * @property int    $type_id
 */
class Like extends AbstractModel
{
    use UserRelation;
    
    protected $table = 'like';
}
