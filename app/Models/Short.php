<?php

namespace App\Models;

use App\Contracts\RewardContract;
use App\Models\Traits\ScopePublished;
use App\Models\Traits\UserRelation;

/**
 * Class Short
 * @package App\Models
 *
 * @property string $text
 * @property string $title
 * @property int    $order
 * @property int    $level
 * @property int    $user_id
 * @property bool   $is_public
 */
class Short extends AbstractModel
{
    use UserRelation,
        ScopePublished;
    
    /**
     * @var array
     */
    protected $contracts = [
        RewardContract::class,
    ];
}
