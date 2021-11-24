<?php

namespace App\Models;

use App\Models\Traits\Contentable;
use App\Models\Traits\UserRelation;

/**
 * Class Image
 * @package App\Models
 *
 * @property string $path
 * @property string $title
 * @property int    $content_id
 * @property int    $user_id
 * @property string $content_type
 */
class Image extends AbstractModel
{
    use UserRelation,
	    Contentable;
	
	/**
	 * @var array
	 */
    protected $fillable = [
        'path',
        'title',
        'content_id',
        'content_type',
        'user_id',
    ];
	
	/**
	 * @var array
	 */
	public $timestamps = ['updated_at'];
}
