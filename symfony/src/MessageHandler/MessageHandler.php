<?php

namespace App\MessageHandler;

use App\Message\Message;
use Psr\Log\LoggerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class MessageHandler implements MessageHandlerInterface
{
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function __invoke(Message $message)
    {
        $this->logger->error($message->getMessage());
    }
}
