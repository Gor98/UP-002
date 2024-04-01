<?php


namespace App\Modules\Auth\Services;


use App\Common\Services\HttpClient;
use App\Modules\Auth\Contracts\Oauth2Contract;
use GuzzleHttp\Exception\GuzzleException;

/**
 * Class GoogleService
 * @package App\Modules\Auth\Services
 */
class GoogleService implements Oauth2Contract
{
    /**
     * @var HttpClient
     */
    private HttpClient $client;

    /**
     * GoogleService constructor.
     * @param HttpClient $client
     */
    public function __construct(HttpClient $client)
    {
        $this->client = $client;
    }

    /**
     * @param $config
     * @return string
     */
    public function oauth2Url(array $config): string
    {
        return $config['urls']['oauth2']['url']
            . '?response_type='
            . $config['params']['response_type']
            . '&client_id='
            . $config['params']['client_id']
            . '&redirect_uri='
            . $config['params']['redirect_uri']
            . '&scope='
            . $config['params']['scope']
            . '&state='
            . $config['params']['state'];
    }

    /**
     * @param array $config
     * @param string $code
     * @return array
     * @throws GuzzleException
     */
    public function token(array $config, string $code): array
    {
        return $this->handleData(
            $this->client->send(
                'POST',
                $config['urls']['oauth2']['token'],
                $this->prepareTokenRequest($config, $code)
            )
        );
    }

    /**
     * @param array $config
     * @param string $token
     * @return array
     * @throws GuzzleException
     */
    public function details(array $config, string $token): array
    {
        $userinfo =  $this->client->send(
            'GET',
            $config['urls']['data']['userinfo'],
            ['headers' => ['Authorization' => 'Bearer ' . $token]]
        );

        return [
            'oauth_id' =>  $userinfo['id'],
            'email' => $userinfo['email'],
            'last_name' => $userinfo['family_name'],
            'first_name' => $userinfo['given_name'],
        ];
    }

    /**
     * @param array $config
     * @param string $code
     * @return array
     */
    private function prepareTokenRequest(array $config, string $code): array
    {
        $headers = [
            'Content-Type' => 'application/x-www-form-urlencoded'
        ];
        $params = [
            'grant_type' => $config['params']['grant_type'],
            'client_id' => $config['params']['client_id'],
            'client_secret' => $config['params']['secret'],
            'redirect_uri' => $config['params']['redirect_uri'],
            'code' => $code,
        ];

        return ['headers' => $headers, 'query' => $params];
    }

    /**
     * @param array $data
     * @return array
     */
    public function handleData(array $data): array
    {
        return [
            'access_token' => $data['access_token'],
            'token_type' => $data['token_type'],
            'expires_in' => toDate($data['expires_in']),
        ];
    }
}
