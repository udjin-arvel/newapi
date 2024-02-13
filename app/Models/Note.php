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
 * @property bool    $is_additional_content
 * @property string  $type
 * @property int     $importance
 *
 * @method static Builder|Note attached()
 * @method static Builder|Note notAttached()
 */
class Note extends BaseModel
{
    use UserRelation,
	    Taggable,
	    Contentable;
    
	/**
	 * Типы заметок
	 */
    const TYPE_NOTE  = 'note';
    const TYPE_QUOTE = 'quote';
    
    const TYPES = [
    	self::TYPE_NOTE  => 'Заметка',
    	self::TYPE_QUOTE => 'Цитата',
    ];
    
	/**
	 * @var array
	 */
	protected $fillable = [
		'title',
		'text',
		'type',
		'is_additional_content',
		'importance',
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
