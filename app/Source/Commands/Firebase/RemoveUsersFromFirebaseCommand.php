<?php

namespace App\Source\Commands\Firebase;

use Illuminate\Console\Command;
use Kreait\Firebase\Contract\Auth;

class RemoveUsersFromFirebaseCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:remove-users-from-firebase';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Removes user from Firebase';

    /**
     * Execute the console command.
     */
    public function handle(Auth $auth)
    {
        $users = $auth->listUsers($defaultMaxResults = 1000, $defaultBatchSize = 1000);

        foreach ($users as $user) {
            /** @var \Kreait\Firebase\Auth\UserRecord $user */
            $this->info($user->phoneNumber);
            $auth->deleteUser($user->uid);
        }
    }
}
