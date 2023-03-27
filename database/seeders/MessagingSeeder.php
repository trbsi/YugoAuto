<?php

namespace Database\Seeders;

use App\Models\Conversation;
use App\Models\Message;
use App\Models\Ride;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\QueryException;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class MessagingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();
        $user = User::first();
        $rides = Ride::where('driver_id', $user->getId())->get();

        foreach ($rides as $ride) {
            $randomUser = User::inRandomOrder()->where('id', '>', 1)->first();

            try {
                $conversationState = rand(0, 1) % 2 === 0 ?
                    [
                        'sender_id' => $user->getId(),
                        'recipient_id' => $randomUser->getId(),
                    ] :
                    [
                        'recipient_id' => $user->getId(),
                        'sender_id' => $randomUser->getId(),
                    ];
                $conversation = Conversation::factory()
                    ->state($conversationState)->create();

                $now = Carbon::now();
                for ($i = 0; $i < 25; $i++) {
                    Message::factory()
                        ->state(
                            [
                                'conversation_id' => $conversation->getId(),
                                'sender_id' => rand(0, 1) % 2 === 0 ? $randomUser->getId() : $user->getId(),
                                'created_at' => $now->addMinutes(rand(1, 10)),
                                'content' => sprintf('%s. %s', $i + 1, $faker->realText)
                            ]
                        )
                        ->create();
                }
            } catch (QueryException $exception) {
                //duplicate entry
            }
        }
    }
}
