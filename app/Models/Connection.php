<?php

namespace App\Models;

use App\Models\Traits\UserRelation;

/**
 * Class Connection
 * @package App\Models
 *
 * @property int $first_content_id
 * @property int $second_content_id
 * @property int $user_id
 */
class Connection extends AModel
{
    use UserRelation;
    
    /**
     * Статусы вариантов соединений историй
     */
    const STATUSES = [
        'pending'   => 'На рассмотрении',
        'canceled'  => 'Отменено',
        'postponed' => 'Отложено',
        'accepted'  => 'Принято',
    ];
}
