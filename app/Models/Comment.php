<?php

namespace App\Models;

use App\Models\Traits\UserRelation;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class Comment
 * @package App\Models
 *
 * @property string $text
 * @property int    $content_id
 * @property string $content_type
 * @property int    $user_id
 * @property int    $parent_id
 */
class Comment extends AbstractModel
{
    use UserRelation;
    
    /**
     * Контект, который имеет комментарии
     */
    const TYPES = [
        'story'    => Story::class,
        'notion'   => Notion::class,
        'loreitem' => LoreItem::class,
    ];
    
    protected $fillable = [
        'text',
        'parent_id',
        'content_id',
        'content_type',
    ];
	
	/**
	 * @param Builder $query
	 * @return Builder
	 */
    public function scopeOnlyParents(Builder $query)
    {
	    return $query->where('parent_id', null);
    }
	
	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function children()
	{
		return $this->hasMany(self::class, 'parent_id');
	}
}
