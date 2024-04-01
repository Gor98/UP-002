<?php


namespace App\Common\Services;

use \GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

/**
 * Class HttpClient
 * @package App\Common\Tools
 */
class HttpClient
{
    /**
     * @var Client
     */
    private Client $client;

    /**
     * HttpClient constructor.send
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param string $method
     * @param string $url
     * @param array $options
     * @return array
     * @throws GuzzleException
     */
    public function send(string $method, string $url, array $options = [])
    {
        $request = $this->client->request($method, $url, $options);
        return is_null($request) ? null : $this->toJson($request);
    }

    /**
     * @param $response
     * @return array
     */
    private function toJson($response)
    {
        return json_decode((string) $response->getBody(), true);
    }
}
