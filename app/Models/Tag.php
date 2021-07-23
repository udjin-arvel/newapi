<?php

namespace App\Models;

use App\Models\Traits\UserRelation;

/**
 * Class Tag
 * @package App\Models
 *
 * @property int    $id
 * @property string $name
 * @property string $stem
 */
class Tag extends AModel
{
    use UserRelation;
    
    protected $fillable = [
        'tag',
        'stem',
        'user_id',
    ];
}
