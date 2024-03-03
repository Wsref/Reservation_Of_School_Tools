<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\individuals>
 */

class individualsFactory extends Factory
{
    protected static ?string $password;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [

            // $table->id();
            // $table->integer('usertype')->default(0);
            // $table->string('fname');
            // $table->string('pname');
            // $table->string('branch');
            // $table->string('telephon');
            // $table->integer('year');
            // $table->string('email')->unique();
            // // $table->timestamp('email_verified_at')->nullable();
            // $table->string('password');


            'fname' => fake()->lastName(),
            'pname' => fake()->firstName(),
            'branch' => fake()->randomElement(["GI","TCC","GE"]),
            'telephon' => fake()->phoneNumber(),
            'year' => fake()->randomElement([1, 2]),
            'email' => fake()->unique()->safeEmail(),
            // 'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            // 'remember_token' => Str::random(10),
            // 'created_at' => now(),
            // 'updated_at' => now(),
        ];
    }
}
