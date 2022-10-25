<?php

namespace App\Factory;

use App\Entity\Player;

class PlayerFactory
{
    public static function createPlayer(): Player
    {
        return new Player();
    }
}
