<?php

namespace App\Message\PUBG;

class FindPlayer
{
    private $name;

    private $platform;

    public function __construct(string $name, string $platform)
    {
        $this->name = $name;
        $this->platform = $platform;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getPlatform(): string
    {
        return $this->platform;
    }

    public function setPlatform(string $platform): void
    {
        $this->platform = $platform;
    }
}
