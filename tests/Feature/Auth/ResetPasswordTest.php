<?php

namespace Tests\Feature\Auth;

use App\Modules\Auth\Models\User;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

/**
 * Class ResetPasswordTest
 * @package Tests\Feature\Auth
 */
class ResetPasswordTest extends TestCase
{
    /**
     * @return void
     */
    public function testSetPasswordSuccess()
    {
        $user = User::factory()->create();
        $response = $this->post(route('auth.resetPassword', ['email' => $user->email]));
        $response->assertStatus(Response::HTTP_NO_CONTENT);
    }

    /**
     * @dataProvider failDataProvider
     * @param array $data
     * @return void
     */
    public function testLoginFail(array $data)
    {
        $response = $this->post(route('auth.setPassword', $data));
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * @return array[]
     */
    public function failDataProvider(): array
    {
        return [
            [['email' => 'wrong.email@gmail.com']],
            [[]],
        ];
    }
}
