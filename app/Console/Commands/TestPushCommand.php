<?php

namespace App\Console\Commands;

use App\Source\SystemCommunication\Base\Infra\Events\SystemCommunicationEvent;
use App\Source\SystemCommunication\PushNotification\Infra\Value\PushNotificationGenericValue;
use Illuminate\Console\Command;

class TestPushCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:push {receiverId}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send test push';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $event = new PushNotificationGenericValue(
            title: 'Test title',
            body: 'Test body',
            receiverId: (int)$this->argument('receiverId')
        );
        SystemCommunicationEvent::dispatch($event);
        $this->info('Sent');
        return 0;
    }
}
