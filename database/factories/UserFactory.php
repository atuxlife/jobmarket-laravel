<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        $hash = Hash::make('password', [
            'memory'    => 1024,
            'time'      => 2,
            'threads'   => 2,
        ]);

        return [
            'name'              => $this->faker->name(),
            'email'             => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password'          => $hash, // password
            'remember_token'    => Str::random(10),
            'role'              => $this->faker->randomElement(['A', 'U']),
            'document_type'     => $this->faker->randomElement(['CC', 'CE', 'PS']),
            'document'          => $this->faker->randomNumber(9, false),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
