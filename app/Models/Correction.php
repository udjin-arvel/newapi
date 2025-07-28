<?php

namespace App\Models;

use App\Models\Traits\UserRelation;

/**
 * Class Correction
 * @package App\Models
 *
 * @property int    $user_id
 * @property string $path
 * @property string $old_variant
 * @property string $new_variant
 * @property string $status
 */
class Correction extends BaseModel
{
    use UserRelation;

	/**
	 * Статусы исправления
	 */
	const STATUS_PENDING  = 'pending';
	const STATUS_CANCELED = 'canceled';
	const STATUS_ACCEPTED = 'accepted';
}
