<?php

namespace App\Models;

use App\Models\Scopes\PublicScope;
use App\Models\Traits\Imageable;
use App\Models\Traits\Posterable;
use App\Models\Traits\Taggable;
use App\Models\Traits\UserRelation;
use Cog\Likeable\Contracts\Likeable as LikeableContract;
use Cog\Likeable\Traits\Likeable;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Notion
 * @package App\Models
 *
 * @property int    $user_id
 * @property int    $level
 * @property string $title
 * @property string $text
 * @property string $poster
 * @property int    $type
 * @property bool   $is_public
 */
class Notion extends BaseModel implements LikeableContract
{
    use SoftDeletes,
	    UserRelation,
	    Likeable,
	    Imageable,
	    Taggable,
	    Posterable,
	    PublicScope;
	
	/**
	 * Типы понятий
	 */
	const TYPE_DEFINITION = 'definition';
	const TYPE_CHARACTER  = 'character';
	const TYPE_PLACE      = 'place';
	const TYPE_ENTITY     = 'entity';
	const TYPE_EVENT      = 'event';
	
	protected $fillable = [
		'title',
		'text',
		'poster',
		'level',
		'type',
		'user_id',
		'is_public',
	];
}
