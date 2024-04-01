<?php

namespace Tests\Feature\Auth;

use App\Modules\Auth\Models\User;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

/**
 * Class LoginTest
 * @package Tests\Feature\Auth
 */
class VerifyTest extends TestCase
{
    /**
     * @return void
     */
    public function testVerifySuccess()
    {
        $user = User::factory()->create();
        $response = $this->patch(route('auth.verify', ['token' => $user->verification_token]));
        $response->assertStatus(Response::HTTP_NO_CONTENT);
    }


    /**
     * @return void
     */
    public function testLoginFailWrongToken()
    {
        $response = $this->patch(route('auth.verify', ['token' => 'wrong token']));
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * @return void
     */
    public function testLoginFailValidationCheck()
    {
        $response = $this->patch(route('auth.verify'));
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
