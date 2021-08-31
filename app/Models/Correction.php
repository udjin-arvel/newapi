<?php

namespace App\Models;

use App\Contracts\RewardContract;
use App\Models\Traits\ScopeOwn;
use App\Models\Traits\UserRelation;

/**
 * Class Correction
 * @package App\Models
 *
 * @property int    $user_id
 * @property int    $content_id
 * @property string $content_type
 * @property string $old_variant
 * @property string $new_variant
 */
class Correction extends AbstractModel
{
    use UserRelation,
        ScopeOwn;
    
    /**
     * Статусы исправлений
     */
    const STATUSES = [
        'pending'   => 'На рассмотрении',
        'canceled'  => 'Отменено',
        'accepted'  => 'Принято',
    ];
    
    protected $fillable = [
        'old_variant',
        'new_variant',
        'content_id',
        'content_type',
        'user_id',
    ];
    
    /**
     * @var array
     */
    protected $contracts = [
        RewardContract::class,
    ];
}
