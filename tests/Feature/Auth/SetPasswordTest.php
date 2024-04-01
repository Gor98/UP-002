<?php

namespace Tests\Feature\Auth;

use App\Modules\Auth\Models\User;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

/**
 * Class SetPasswordTest
 * @package Tests\Feature\Auth
 */
class SetPasswordTest extends TestCase
{
    /**
     * @return void
     */
    public function testSetPasswordSuccess()
    {
        $user = User::factory()->create(['reset_token' => makeToken()]);
        $response = $this->post(route('auth.setPassword', [
            'email' => $user->email,
            'reset_token' => $user->reset_token,
            'password' => 'Secret123!',
            'password_confirmation' => 'Secret123!'
        ]));

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
            [['email' => '', 'password' => '']],
            [['email' => '', 'password' => 'aa', 'password_confirmation' => 'sssss']],
            [[]],
        ];
    }
}
