<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\user_messages>
 */
class user_messagesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // $table->id('request_id');
            // $table->integer('requester_id');
            // $table->text('request_msg');
            // $table->integer('request_status') ;
            // $table->date('request_date');
            // $table->time('request_time');
            // $table->timestamp('request_timestamp');
            //
            'requester_id' => fake()->numberBetween($min = 1, $max = 10),
            'request_msg' => fake()->text(30),
            'request_status' => fake()->randomElement([0,1,-1]),
            'request_date' => fake()->date(),
            'request_time' => fake()->time(),
            'request_timestamp' => fake()->dateTime(),
            

            // 'material'=>fake()->randomElement(["Ping-Pong","FootBall","BasketBall"]),
            // 'quantity'=>fake()->numberBetween($min = 1, $max = 10),
            // 'msg_date'=>fake()->date(),
            // 'msg_time'=>fake()->time(),
        ];
    }
}
