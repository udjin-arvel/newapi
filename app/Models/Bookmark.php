<?php

namespace App\Models;

use App\Models\Traits\UserRelation;
use App\Scopes\UserIdScope;

/**
 * Class Bookmark
 * @package App\Models
 *
 * @property int     $id
 * @property int     $fragment_id
 * @property int     $story_id
 */
class Bookmark extends BaseModel
{
	use UserRelation;
	/**
	 * @var array
	 */
	protected $fillable = [
		'story_id',
		'fragment_id',
	];
	
	/**
	 * @return void
	 */
	protected static function boot()
	{
		parent::boot();
		static::addGlobalScope(new UserIdScope);
	}
}
