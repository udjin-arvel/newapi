<?php

namespace App\Models;

use App\Models\Traits\Contentable;
use App\Models\Traits\UserRelation;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class LeveledContent
 * @package App\Models
 *
 * @property string $text
 * @property int    $content_id
 * @property string $content_type
 * @property int    $user_id
 * @property int    $level
 */
class LeveledContent extends BaseModel
{
    use UserRelation, Contentable;
    
    protected $fillable = [
        'text',
        'level',
        'content_id',
        'content_type',
        'user_id',
    ];
    
    /**
     * Scope a query to only include popular users.
     */
    public function scopeAvailable(Builder $query): void
    {
        $query->where('user_id', \auth()->id())->orWhere('level', '<=', optional(\auth()->user())->level);
    }
}
