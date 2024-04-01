<?php

namespace Tests\Feature\User;

use App\Modules\Auth\Models\User;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

/**
 * Class ProfileTest
 * @package Tests\Feature\User
 */
class ProfileTest extends TestCase
{
    /**
     * @return void
     */
    public function testProfileSuccess()
    {
        $user = User::factory()->create();
        $token = JWTAuth::fromUser($user);
        $response = $this->withHeaders([
            'Authorization' => "Bearer $token"
        ])->get(route('user.profile'));

        $response->assertStatus(Response::HTTP_OK);
    }

    /**
     * @return void
     */
    public function testProfileFail()
    {
        $response = $this->get(route('user.profile'));

        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
    }

}
