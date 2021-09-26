<?php

namespace App\Models;

use App\Models\Traits\Contentable;
use App\Models\Traits\UserRelation;

/**
 * Class Correction
 * @package App\Models
 *
 * @property int    $user_id
 * @property int    $content_id
 * @property string $content_type
 * @property string $old_variant
 * @property string $new_variant
 */
class Correction extends AbstractModel
{
    use UserRelation, Contentable;
}
