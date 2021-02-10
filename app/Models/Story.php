<?php

namespace App\Models;

use App\Models\Traits\BookTrait;
use App\Models\Traits\UserTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Story
 * @package App\Models
 *
 * @method static mixed published()
 *
 * @property int    $id
 * @property string $title
 * @property int    $chapter
 * @property int    $level
 * @property int    $time
 * @property string $remark
 * @property bool   $is_published
 * @property int    $user_id
 * @property int    $book_id
 * @property int    $series_id
 * @property array  $tags
 * @property array  $comments
 * @property Book   $book
 * @property array  $fragments
 * @property string $created_at
 * @property string $updated_at
 */
class Story extends Model
{
    use SoftDeletes, UserTrait, BookTrait;
    
    public static function boot()
    {
        parent::boot();
        
        self::created(function($model) {
            if ($model->is_published) {
            
            }
        });
        
        self::updated(function($model) {
            if ($model->is_published) {
            
            }
        });
    }
    
    /**
     * @param $query
     * @return mixed
     */
    public function scopePublished($query)
    {
        return $query->where('is_published', '=', true);
    }
    
    /**
     * Тэги, принадлежащие истории
     * @return BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'story_tag', 'story_id', 'tag_id');
    }
    
    /**
     * Понятия, принадлежащие истории
     * @return BelongsToMany
     */
    public function notions()
    {
        return $this->belongsToMany(Notion::class, 'story_notion', 'story_id', 'notion_id');
    }
    
    /**
     * Фрагменты, принадлежащие истории.
     * @return HasMany
     */
    public function fragments()
    {
        return $this->hasMany(Fragment::class)->orderBy('order', 'desc');
    }
    
    /**
     * Комментарии, принадлежащие истории.
     * @return HasMany
     */
    public function storyComments()
    {
        return $this->hasMany(StoryComment::class)->orderBy('importance', 'desc');
    }
}
