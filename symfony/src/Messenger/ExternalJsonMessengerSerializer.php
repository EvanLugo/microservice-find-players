<?php

namespace App\Messenger;

use Exception;
use App\Message\Message;
use App\Message\PUBG\FindPlayer;
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
        $body = $encodedEnvelope['body'];
        $message = json_decode($body, true);
        if ($message === null) {
            throw new MessageDecodingFailedException('invalid json');
        }

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
        // this is called if a message is redelivered for "retry"
        $message = $envelope->getMessage();
        // expand this logic later if you handle more than
        // just one message class
        if ($message instanceof FindPlayer) {
            // recreate what the data originally looked like
            $data = ['playerName' => $message->getName(), 'platform' => $message->getPlatform()];
        } else {
            throw new Exception('Unsupported message class');
        }

        $allStamps = [];
        foreach ($envelope->all() as $stamps) {
            $allStamps = array_merge($allStamps, $stamps);
        }
        
        return [
            'body' => json_encode($data),
            'headers' => [
                // store stamps as a header - to be read in decode()
                'stamps' => serialize($allStamps)
            ],
        ];
    }
}
