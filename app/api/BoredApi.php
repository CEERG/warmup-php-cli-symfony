<?php

namespace app\api;

use app\api\enums\EventType;

class BoredApi
{
    /**
     * @throws GuzzleException
     */
    public static function getRandomActivity(): array
    {
        $client = new BoredApiClient();

        $response = $client->request('GET', 'activity/');

        return $response;
    }

    /**
     * @throws GuzzleException
     */
    public static function getRandomActivityWIthType(EventType $type): array
    {
        $client = new BoredApiClient();

        $response = $client->request('GET', 'activity/', [
            'query' => [
                'type' => $type->value
            ]
        ]);

        return $response;
    }

    /**
     * @throws GuzzleException
     */
    public static function getRandomActivityWithinPriceRange($minPrice, $maxPrice): array
    {
        $client = new BoredApiClient();

        $response = $client->request('GET', 'activity/', [
            'query' => [
                'minprice' => $minPrice,
                'maxprice' => $maxPrice
            ]
        ]);

        return $response;
    }
}