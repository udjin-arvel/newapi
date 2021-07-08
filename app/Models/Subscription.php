<?php

namespace App\Models;

use App\Models\Traits\ScopeOwn;
use App\Models\Traits\UserRelation;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Subscription
 * @package App\Models
 *
 * @property int    $id
 * @property int    $user_id
 * @property int    $subscription_id
 * @property string $subscription_type
 */
class Subscription extends Model
{
    use UserRelation,
        ScopeOwn;
}
