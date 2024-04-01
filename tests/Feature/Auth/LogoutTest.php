<?php

namespace Tests\Feature\Auth;

use App\Modules\Auth\Models\User;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

/**
 * Class LogoutTest
 * @package Tests\Feature\Auth
 */
class LogoutTest extends TestCase
{
    /**
     * @return void
     */
    public function testLogOutSuccess()
    {
        $user = User::factory()->create();
        $token = JWTAuth::fromUser($user);
        $response = $this->withHeaders([
            'Authorization' => "Bearer $token"
        ])->post(route('auth.logout'));
        $response->assertStatus(Response::HTTP_NO_CONTENT);
    }

    /**
     * @return void
     */
    public function testLogOutFail()
    {
        $response = $this->withHeaders([
            'Authorization' => "Bearer NO token"
        ])->post(route('auth.logout'));
        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
    }
}
