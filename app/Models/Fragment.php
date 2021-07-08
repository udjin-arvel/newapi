<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Fragment
 * @package App\Models
 *
 * @property int    $user_id
 * @property int    $story_id
 * @property int    $order
 * @property string $text
 */
class Fragment extends AModel
{
    use SoftDeletes;

    protected $fillable = [
      'text',
      'order',
      'poster',
      'remark',
    ];
}
