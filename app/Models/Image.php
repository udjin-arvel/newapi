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
    use UserRelation, Contentable;
    
    /**
     * Контект, которому можно добавлять картинки
     */
    const TYPES = [
        'notion'      => Notion::class,
        'loreitem'    => LoreItem::class,
        'composition' => Composition::class,
        'fragment'    => Fragment::class,
    ];
	
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
