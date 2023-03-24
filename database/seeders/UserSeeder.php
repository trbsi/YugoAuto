<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()
            ->state([
                'email' => 'a@a.com'
            ])
            ->has(UserProfile::factory(), 'profile')
            ->create();

        for ($i = 0; $i < 10; $i++) {
            User::factory()
                ->has(UserProfile::factory(), 'profile')
                ->create();
        }
    }
}
