<?php

namespace App\Models;

use App\Models\Traits\Contentable;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Fragment
 * @package App\Models
 *
 * @property int    $content_id
 * @property string $content_type
 * @property int    $order
 * @property string $text
 */
class Fragment extends AbstractModel
{
    use SoftDeletes, Contentable;

    protected $fillable = [
      'text',
      'order',
      'content_id',
      'content_type',
    ];
}
