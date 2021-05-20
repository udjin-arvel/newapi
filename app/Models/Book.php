<?php

namespace App\Models;

use App\Models\Traits\ScopeOwnTrait;
use App\Models\Traits\StoriesTrait;
use App\Models\Traits\UserTrait;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Book
 * @package App\Models
 *
 * @property int    $id
 * @property int    $user_id
 * @property int    $part
 * @property string $title
 * @property string $description
 * @property string $poster
 * @property array  $stories
 * @property array  $storyProjects
 * @property array  $comments
 */
class Book extends AModel
{
    use SoftDeletes,
        UserTrait,
        StoriesTrait,
        ScopeOwnTrait;
    
    public static function boot()
    {
        parent::boot();
        
        self::created(function($model) {
        
        });
    }
}
