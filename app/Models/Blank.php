<?php

namespace App\Models;

use App\Models\Traits\Contentable;
use App\Models\Traits\UserRelation;

/**
 * Class Blank
 * @package App\Models
 *
 * @property string $text
 * @property string $title
 * @property int    $importance
 * @property int    $content_id
 * @property string $content_type
 * @property int    $user_id
 */
class Blank extends AbstractModel
{
	use UserRelation, Contentable;
}
