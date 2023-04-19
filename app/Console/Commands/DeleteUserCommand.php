<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Source\User\Domain\DeleteUser\DeleteUserLogic;
use Illuminate\Console\Command;

class DeleteUserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:delete-user {userId}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete user';

    /**
     * Execute the console command.
     */
    public function handle(DeleteUserLogic $deleteUserLogic): void
    {
        $user = User::findOrFail((int)$this->argument('userId'));
        $deleteUserLogic->delete($user);
    }
}
