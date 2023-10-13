<?php

namespace App\Models;

/**
 * Class Reminder
 * @package App\Models
 *
 * @property int    $story_id
 * @property int    $order
 * @property string $text
 * @property string $title
 */
class Reminder extends BaseModel
{
    protected $fillable = [
        'text',
        'title',
        'order',
        'story_id',
    ];
}
