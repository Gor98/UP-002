<?php

namespace Tests\Feature\Auth;

use App\Common\Constants\CommonDeviceConstant;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

/**
 * Class OauthTest
 * @package Tests\Feature\Auth
 */
class OauthTest extends TestCase
{
    /**
     * @dataProvider successProvider
     *
     * @param $deviceType
     * @return void
     */
    public function testOauthUrlSuccess($deviceType)
    {
        $response = $this->get(route('auth.oauth2Url', ['device_type' => $deviceType]));
        $response->assertStatus(Response::HTTP_OK);
    }

    /**
     * @dataProvider failProvider
     *
     * @param $deviceType
     * @return void
     */
    public function testOauthUrlFail($deviceType)
    {
        $response = $this->get(route('auth.oauth2Url', ['device_type' => $deviceType]));
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * @return int[]
     */
    public function failProvider(): array
    {
        return [
            ['any', 'other', 'data']
        ];
    }

    /**
     * @return int[]
     */
    public function successProvider(): array
    {
        return [
            CommonDeviceConstant::DEVICES
        ];
    }
}
