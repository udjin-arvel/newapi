<?php

namespace App\Models;

use App\Models\Traits\Contentable;
use App\Models\Traits\Taggable;
use App\Models\Traits\UserRelation;
use App\Scopes\UserIdScope;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class Note
 * @package App\Models
 *
 * @property int     $id
 * @property string  $title
 * @property string  $text
 * @property int     $user_id
 * @property int     $content_id
 * @property string  $content_type
 * @property int     $importance
 *
 * @method static Builder|Note attached()
 * @method static Builder|Note notAttached()
 */
class Note extends AbstractModel
{
    use UserRelation, Taggable, Contentable;
	
	/**
	 * @var array
	 */
	public $timestamps = ['updated_at'];
    
    /**
     * @return void
     */
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new UserIdScope);
    }
	
	/**
	 * Выбрать прикрепленные заметки
	 *
	 * @param Builder $query
	 * @return Builder
	 */
	public function scopeAttached(Builder $query)
	{
		return $query->where('content_id', '!=', null);
	}
	
	/**
	 * Выбрать неприкрепленные заметки
	 *
	 * @param Builder $query
	 * @return Builder
	 */
	public function scopeNotAttached(Builder $query)
	{
		return $query->where('content_id', '=', null);
	}
}
