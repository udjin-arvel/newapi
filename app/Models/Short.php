<?php

namespace App\Models;

use App\Models\Interfaces\Publishable as PublishableInterface;
use App\Models\Scopes\PublicScope;
use App\Models\Traits\Taggable;
use App\Models\Traits\UserRelation;

/**
 * Class Short
 * @package App\Models
 *
 * @property string $text
 * @property string $title
 * @property int    $order
 * @property int    $level
 * @property int    $user_id
 * @property bool   $is_public
 */
class Short extends BaseModel implements PublishableInterface
{
    use UserRelation,
	    PublicScope,
	    Taggable;
}
