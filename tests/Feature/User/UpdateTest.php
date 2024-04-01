<?php

namespace Tests\Feature\User;

use App\Modules\Auth\Models\User;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

/**
 * Class UpdateTest
 * @package Tests\Feature\User
 */
class UpdateTest extends TestCase
{
    /**
     * @return void
     */
    public function testUpdateSuccess()
    {
        $user = User::factory()->create();
        $token = JWTAuth::fromUser($user);
        $response = $this->withHeaders([
            'Authorization' => "Bearer $token"
        ])->put(route('user.update', [
            'first_name' => 'test',
            'last_name' => 'test',
        ]));

        $response->assertStatus(Response::HTTP_OK);
    }

    /**
     * @return void
     */
    public function testUpdateFailNoAuth()
    {
        $response = $this->put(route('user.update', [
            'first_name' => 'test',
            'last_name' => 'test',
        ]));

        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
    }

    /**
     * @return void
     */
    public function testUpdateFailBadData()
    {
        $user = User::factory()->create();
        $token = JWTAuth::fromUser($user);
        $response = $this->withHeaders([
            'Authorization' => "Bearer $token"
        ])->put(route('user.update', [
            'first_name' => '',
            'last_name' => '',
        ]));

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
