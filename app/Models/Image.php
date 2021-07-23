<?php

namespace App\Models;

use App\Contracts\RewardContract;
use App\Models\Traits\ScopeOwn;
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
class Image extends AModel
{
    use UserRelation,
        ScopeOwn;
    
    /**
     * Контект, которому можно добавлять картинки
     */
    const TYPES = [
        'notion'      => Notion::class,
        'loreitem'    => LoreItem::class,
        'composition' => Composition::class,
        'fragment'    => Fragment::class,
    ];
    
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
    protected $contracts = [
        RewardContract::class,
    ];
}
