<?php

namespace App\Models;

use App\Models\Scopes\PublicScope;
use App\Models\Traits\Taggable;
use App\Models\Traits\UserRelation;
use App\Models\Traits\Imageable;

/**
 * Class LoreItem
 * @package App\Models
 *
 * @property string $title
 * @property string $text
 * @property string $poster
 * @property int    $level
 * @property int    $user_id
 * @property bool   $is_public
 */
class LoreItem extends AbstractModel
{
    use UserRelation,
	    Taggable,
	    Imageable,
	    PublicScope;
	
	/**
	 * @var array
	 */
    protected $fillable = [
        'title',
        'text',
        'poster',
        'is_public',
        'level',
        'user_id',
    ];
	
	/**
	 * @var array
	 */
	public $timestamps = ['updated_at'];
}
