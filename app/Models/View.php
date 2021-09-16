<?php

namespace App\Models;

use App\Models\Traits\Contentable;
use App\Models\Traits\UserRelation;

/**
 * Class View
 * @package App\Models
 *
 * @property int    $user_id
 * @property int    $content_id
 * @property string $content_type
 */
class View extends AbstractModel
{
    use UserRelation, Contentable;
    
	/**
	 * @var array
	 */
    protected $fillable = [
        'content_id',
        'content_type',
        'user_id',
        'updated_at',
    ];
}
