<?php

namespace App\Source\Commands\Messaging;

use App\Models\Conversation;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class DeleteOldMessagesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:delete-old-messages-command {days=30}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deletes conversations that are older than 30 days.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $now = Carbon::now()->subDays((int)$this->argument('days'));

        Conversation::query()
            ->where('updated_at', '<=', $now->format('Y-m-d H:i:s'))
            ->delete();
    }
}
