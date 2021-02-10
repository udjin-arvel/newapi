<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Notion
 * @package App\Models
 *
 * @property int    $id
 * @property int    $user_id
 * @property string $title
 * @property string $text
 * @property string $main_image
 * @property int    $type
 */
class Notion extends Model
{
    use SoftDeletes;
}
