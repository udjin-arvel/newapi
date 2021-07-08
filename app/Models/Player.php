<?php

namespace App\Models;

use App\Models\Traits\UserTrait;
use Illuminate\Database\Eloquent\Model;
use Auth;

/**
 * Class Player
 * @package App\Models
 *
 * @property User $user
 *
 * @property int    $id
 * @property int    $user_id
 * @property int    $age
 * @property int    $sex
 * @property string $poster
 * @property string $city
 * @property string $login
 * @property string $info
 * @property int    $clan
 */
class Player extends Model
{
    use UserTrait;
    
    /**
     * Player constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->user = Auth::user();
    }
}
