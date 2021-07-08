<?php

namespace App\Models;

use App\Models\Traits\UserRelation;

/**
 * Class LoreItem
 * @package App\Models
 *
 * @property int     $id
 * @property string  $title
 * @property string  $text
 * @property int     $level
 * @property int     $user_id
 * @property boolean $is_published
 */
class LoreItem extends AModel
{
    use UserRelation;
}
