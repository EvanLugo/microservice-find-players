<?php

namespace App\Messenger;

use App\Message\Message;
use App\Message\PUBG\FindPlayer;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Transport\Serialization\SerializerInterface;

class ExternalJsonMessengerSerializer implements SerializerInterface
{
    /**
     * @inheritDoc
     */
    public function decode(array $encodedEnvelope): Envelope
    {
        $body = $encodedEnvelope['body'];
        $message = json_decode($body, true);

        if (array_key_exists('playerName', $message) && array_key_exists('platform', $message)) {
            return new Envelope(new FindPlayer($message['playerName'], $message['platform']));
        }

        $message = new Message($message['message']);

        return new Envelope($message);
    }

    /**
     * @inheritDoc
     */
    public function encode(Envelope $envelope): array
    {
        return [];
    }
}
