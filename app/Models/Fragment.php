<?php

namespace App\Models;

use App\Models\Traits\DataHelperTrait;
use App\Models\Traits\StoryTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Fragment
 * @package App\Models
 */
class Fragment extends AModel
{
    use StoryTrait,
        SoftDeletes,
        DataHelperTrait;
    
    protected $fillable = [
      'text',
      'order',
      'poster',
      'remark',
    ];
}
