<?php

namespace Database\Factories\Modules\Auth\Models;

use App\Modules\Auth\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * Class UserFactory
 * @package Database\Factories
 */
class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_name' => $this->faker->name(),
            'last_name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'verification_token' => $this->faker->uuid(),
            'verification_token_expires_at' => now()->addHour(),
            'password' => 'Secret123!'
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return Factory
     */
    public function verified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => now(),
            ];
        });
    }
}
