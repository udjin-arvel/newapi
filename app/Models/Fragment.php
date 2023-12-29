<?php

namespace App\Models;

use App\Models\Traits\Contentable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Staudenmeir\EloquentEagerLimit\HasEagerLimit;

/**
 * Class Fragment
 * @package App\Models
 *
 * @property int    $story_id
 * @property int    $order
 * @property string $text
 * @property string $footnote
 */
class Fragment extends BaseModel
{
    use SoftDeletes,
        Contentable,
        HasEagerLimit,
        HasFactory;

    protected $fillable = [
      'text',
      'footnote',
      'order',
      'story_id',
    ];
}
