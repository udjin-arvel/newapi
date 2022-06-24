<?php

namespace App\Models;

use App\Models\Traits\UserRelation;
use App\Scopes\UserIdScope;

/**
 * Class Name
 * @package App\Models
 *
 * @property int    $id
 * @property string $name
 * @property int    $user_id
 * @property bool   $is_used
 */
class Name extends BaseModel
{
	use UserRelation;
	
	/**
	 * @var array
	 */
	protected $fillable = [
		'name',
		'is_used',
		'user_id',
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
