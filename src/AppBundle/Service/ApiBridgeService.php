<?php
/** Created by PhpStorm. */

namespace AppBundle\Service;

use GuzzleHttp\Client;
use Exception;


class ApiBridgeService
{
    /** @var Client $client */
    private $client;

    /**
     * ApiBridgeService constructor.
     * @param $apiHost
     */
    public function __construct($apiHost)
    {
        $this->client = new Client(['base_uri' => $apiHost]);
    }

    /**
     * @param $path
     * @return array
     * @throws Exception
     */
    public function get($path)
    {
        try {
            $json = $this->client->request('GET', $path);
        } catch (Exception $exception) {
            $json = [];
        }

        $response = json_decode($json->getBody(), 1);

        if (json_last_error()) {
            return [];
        }

        return $response;
    }
}
