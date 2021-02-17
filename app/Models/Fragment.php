<?php

namespace App\Models;

use App\Models\Traits\StoryTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Fragment
 * @package App\Models
 */
class Fragment extends Model
{
    use StoryTrait, SoftDeletes;
}
