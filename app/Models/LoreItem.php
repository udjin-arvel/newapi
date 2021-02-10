<?php

namespace App\Models;

use App\Models\Traits\UserTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
class LoreItem extends Model
{
    use UserTrait;
    
    /**
     * @var array
     */
    static $getAllSelectors = [
        'id',
        'title',
        'text',
        'level',
        'is_published',
        'user_id',
        'created_at',
    ];
}
