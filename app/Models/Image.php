<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


/**
 * Class Image
 * @package App\Models
 *
 * @property int    $id
 * @property string $path
 * @property int    $content_id
 * @property int    $user_id
 * @property string $content_type
 */
class Image extends Model
{
    const TYPE_NOTION = 'type-notion';
}
