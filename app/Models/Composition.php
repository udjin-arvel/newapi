<?php

namespace App\Models;

use App\Contracts\NewsContract;
use App\Contracts\RewardContract;
use App\Models\Interfaces\PosterableInterface;
use App\Models\Traits\Posterable;
use App\Models\Traits\ScopeOwn;
use App\Models\Traits\UserRelation;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Book
 * @package App\Models
 *
 * @property int    $id
 * @property int    $user_id
 * @property int    $parent_id
 * @property int    $era
 * @property int    $level
 * @property int    $chapter
 * @property string $title
 * @property bool   $is_published
 * @property string $type
 * @property string $description
 * @property string $poster
 */
class Composition extends AModel implements PosterableInterface
{
    use SoftDeletes,
        UserRelation,
        Posterable,
        ScopeOwn;

    const TYPE_BOOK   = 'type-book';
    const TYPE_SERIES = 'type-series';
	
	/**
	 * @var array
	 */
    protected $fillable = [
    	'title',
    	'description',
    	'era',
    	'poster',
    	'type',
    	'is_published',
    	'user_id',
    ];
    
    /**
     * @var array
     */
    protected $contracts = [
        NewsContract::class,
        RewardContract::class,
    ];
}
