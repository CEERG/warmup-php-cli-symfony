<?php

namespace app\api;

use GuzzleHttp\Client;

class BoredApiClient
{
    private $host = "http://www.boredapi.com/api/";

    /**
     * @throws GuzzleException
     */
    public function request(string $requestType, string $uri, array $params = []): array
    {
        $client = new Client();

        $response = $client->request($requestType, $this->host.$uri, $params);

        return json_decode($response->getBody(), true);
    }
}