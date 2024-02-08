<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\messages>
 */
class messagesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // //
            // $table->integer('sender_id');
            // $table->string('the_sender');
            // $table->integer('receiver_id');
            // $table->string('the_receiver');
            // $table->text('msg');
            // $table->date('msg_date');
            // $table->time('msg_time');

            'sender_id' => fake()->numberBetween($min = 1, $max = 20),
            'the_sender' => fake()->randomElement(["user","admin"]),
            'receiver_id' => fake()->numberBetween($min = 1, $max = 20),
            'the_receiver' => fake()->randomElement(["user","admin"]),
            'msg' => fake()->text(100),

            // 'material'=>fake()->randomElement(["Ping-Pong","FootBall","BasketBall"]),
            // 'quantity'=>fake()->numberBetween($min = 1, $max = 10),
            'msg_date'=>fake()->date(),
            'msg_time'=>fake()->time(),
        ];
    }
}
