<?php

namespace App\MessageHandler\PUBG;

use App\Message\PUBG\FindPlayer as FindPlayerMessage;
use App\Service\PUBG_API\FindPlayer;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use App\Service\Player\PlayerCreate;

class FindPlayerHandler implements MessageHandlerInterface
{
    private $findPlayer;
    private $playerCreate;

    public function __construct(FindPlayer $findPlayer, PlayerCreate $playerCreate)
    {
        $this->findPlayer = $findPlayer;
        $this->playerCreate = $playerCreate;
    }

    public function __invoke(FindPlayerMessage $findPlayer)
    {
        $playerInfo = $this->findPlayer->__invoke($findPlayer->getName(), $findPlayer->getPlatform());
        $player = $this->playerCreate->__invoke(
            $playerInfo[0]['attributes']['name'],
            $playerInfo[0]['id'],
            $playerInfo[0]['attributes']['shardId']
        );

        var_dump($player);
    }
}
