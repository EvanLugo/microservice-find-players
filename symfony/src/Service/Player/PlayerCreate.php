<?php

namespace App\Service\Player;

use App\Entity\Player;
use App\Factory\PlayerFactory;
use Doctrine\ORM\EntityManagerInterface;

class PlayerCreate
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function __invoke(string $playerName, string $account, string $platform): Player
    {
        $player = PlayerFactory::createPlayer();
        $player->setName($playerName);
        $player->setAccount($account);
        $player->setPlatform($platform);

        $this->em->persist($player);
        $this->em->flush();

        return $player;
    }
}
