<?php

namespace App\Service\PUBG_API;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class FindPlayer
{
    private $httpClient;

    private $pubgApi;

    public function __construct(HttpClientInterface $httpClient, string $pubgApi)
    {
        $this->httpClient = $httpClient;
        $this->pubgApi = $pubgApi;
    }

    public function __invoke(string $name, string $platform)
    {
        $url = sprintf('%s%s%s',$this->pubgApi, $platform, '/players');
        $response = $this->httpClient->request(
            'GET',
            $url,
            [
                'query' => [
                    'filter[playerNames]' => $name
                ]
            ]
        );

        $response = json_decode($response->getContent(), true);
        dd($response);
    }
}
