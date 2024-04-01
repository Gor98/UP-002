<?php

namespace App\Modules\Auth\Contracts;

/**
 * Interface Oauth2Contract
 * @package App\Modules\Auth\Contracts
 */
interface Oauth2Contract
{
    /**
     * @param array $config
     * @return string
     */
    public function oauth2Url(array $config): string;

    /**
     * @param array $config
     * @param string $code
     * @return array
     */
    public function token(array $config, string $code): array;

    /**
     * @param array $data
     * @return array
     */
    public function handleData(array $data): array;

    /**
     * @param array $config
     * @param string $token
     * @return array
     */
    public function details(array $config, string $token): array;
}
