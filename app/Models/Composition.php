<?php

namespace App\Models;

use App\Models\Traits\ScopeOwn;
use App\Models\Traits\StoriesTrait;
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
 * @property string $size
 * @property string $title
 * @property string $description
 * @property string $poster
 * @property string $type
 */
class Composition extends AModel
{
    use SoftDeletes,
        UserRelation,
        StoriesTrait,
        ScopeOwn;

    public const TYPE_BOOK   = 'type-book';
    public const TYPE_SERIES = 'type-series';
}
