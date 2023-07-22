<?php

namespace App\Models;

use App\Models\Traits\Contentable;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Fragment
 * @package App\Models
 *
 * @property int    $story_id
 * @property int    $order
 * @property string $text
 */
class Fragment extends BaseModel
{
    use SoftDeletes,
        Contentable;

    protected $fillable = [
      'text',
      'order',
      'story_id',
    ];
}
