<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Note
 * @package App\Models
 *
 * @property int     $id
 * @property string  $title
 * @property string  $text
 * @property int     $user_id
 * @property int     $interest
 * @property boolean $is_published
 */
class Note extends Model
{
    static $getAllSelectors = [
        'id',
        'title',
        'text',
        'interest',
        'created_at',
    ];
}
