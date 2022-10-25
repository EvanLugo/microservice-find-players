<?php

namespace App\MessageHandler\PUBG;

use App\Message\PUBG\FindPlayer as FindPlayerMessage;
use App\Service\PUBG_API\FindPlayer;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class FindPlayerHandler implements MessageHandlerInterface
{
    private $findPlayer;

    public function __construct(FindPlayer $findPlayer)
    {
        $this->findPlayer = $findPlayer;
    }

    public function __invoke(FindPlayerMessage $findPlayer)
    {
        $this->findPlayer->__invoke($findPlayer->getName(), $findPlayer->getPlatform());

    }
}
