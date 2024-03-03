<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\users; // Assuming your User model is in the App\Models namespace
use Illuminate\Support\Str;
use Faker\Generator as Faker;

class UsersFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'usertype' => $this->faker->randomElement([0, 1]),
            'prenom' => $this->faker->firstName,
            'nom' => $this->faker->lastName,
            'telephon' => $this->faker->phoneNumber,
            'filiere' => $this->faker->word,
            'anne' => $this->faker->year,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password' => bcrypt('password'), // Default password is 'password'
            'remember_token' => Str::random(10),
        ];
    }
}
