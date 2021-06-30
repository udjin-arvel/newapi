<?php

namespace App\Services;

use App\Models\Player;

/**
 * Class PlayerService
 * @package App\Services
 *
 * @property Player $player
 */
class PlayerService
{
    /**
     * @var Player
     */
    protected $player;
    
    public function __construct(Player $player)
    {
        $this->player = $player;
    }
    
    
}