<?php

namespace App\Models;

use App\Contracts\NewsContract;
use App\Contracts\NotificationContract;
use App\Contracts\RewardContract;
use App\Contracts\ViewContract;
use App\Models\Traits\ScopePublished;
use App\Models\Traits\Taggable;
use App\Models\Traits\UserRelation;

/**
 * Class LoreItem
 * @package App\Models
 *
 * @property string $title
 * @property string $text
 * @property string $poster
 * @property int    $level
 * @property int    $user_id
 * @property bool   $is_public
 */
class LoreItem extends AbstractModel
{
    use UserRelation,
        Taggable;
    
    protected $fillable = [
        'title',
        'text',
        'poster',
        'is_public',
        'level',
        'user_id',
    ];
    
    /**
     * @var array
     */
    protected $contracts = [
        ViewContract::class,
        NewsContract::class,
        RewardContract::class,
        NotificationContract::class,
    ];
}
