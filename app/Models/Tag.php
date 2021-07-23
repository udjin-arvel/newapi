<?php

namespace App\Models;

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
    protected $fillable = [
        'tag',
        'stem',
        'user_id',
    ];
}
