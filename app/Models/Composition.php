<?php

namespace App\Models;

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
class Composition extends AModel
{
    use SoftDeletes,
        UserRelation,
        ScopeOwn;

    const TYPE_BOOK   = 'type-book';
    const TYPE_SERIES = 'type-series';
}
