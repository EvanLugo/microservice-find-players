<?php

namespace App\Messenger;

use App\Message\Message;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Exception\MessageDecodingFailedException;
use Symfony\Component\Messenger\Transport\Serialization\SerializerInterface;

class ExternalJsonMessengerSerializer implements SerializerInterface
{
    /**
     * @inheritDoc
     */
    public function decode(array $encodedEnvelope): Envelope
    {
        $headers = $encodedEnvelope['headers'];
        $body = $encodedEnvelope['body'];

        $message = json_decode($body, true);
        $message = new Message($message['message']);

        return new Envelope($message);
    }

    /**
     * @inheritDoc
     */
    public function encode(Envelope $envelope): array
    {
        // TODO: Implement encode() method.
    }
}
