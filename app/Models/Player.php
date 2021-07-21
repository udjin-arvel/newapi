<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Player
 * @package App\Models
 *
 * @property int    $id
 * @property int    $level
 * @property int    $experience
 */
class Player extends Model
{
    /**
     * Обновить опыт игроку
     * @param int $amount
     */
    public function updateExpAmount(int $amount)
    {
        $this->experience += $amount;
        $this->save();
    }
}
