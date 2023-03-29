<?php

namespace App\Console\Commands;

use App\Source\SystemCommunication\Base\Infra\Events\SystemCommunicationEvent;
use App\Source\SystemCommunication\Email\Infra\Value\EmailSystemCommunicationValue;
use Illuminate\Console\Command;

class TestEmailCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:email {--email=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send test email';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $email = (!empty($this->option('email'))) ? $this->option('email') : 'test@mail.com';

        $mail = new EmailSystemCommunicationValue(
            [$email],
            'Test subject',
            [
                'body' => 'Test body',
                'buttonUrl' => config('app.url'),
                'buttonText' => 'Click here'
            ],
        );
        SystemCommunicationEvent::dispatch($mail);
        $this->info('Sent');
        return 0;
    }
}
