<?php

namespace App\Source\Commands\Runcloud;

use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class RestartRunCloudSupervisorCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'runcloud:restart-supervisor';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Restarts supervisors on runcloud';

    /**
     * Execute the console command.
     * @link https://runcloud.io/docs/api/supervisor
     * @return int
     */
    public function handle()
    {
        if (empty(env('RUNCLOUD_API_KEY')) || empty(env('RUNCLOUD_API_SECRET'))) {
            throw new Exception('Missing env varialbes');
        }

        $serverId = 187332;
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => 'Basic ' . base64_encode(
                    env('RUNCLOUD_API_KEY') . ':' . env('RUNCLOUD_API_SECRET')
                )
        ])
            ->post('https://manage.runcloud.io/api/v2/servers/' . $serverId . '/supervisors/rebuild');

        $this->info($response->body());
        return Command::SUCCESS;
    }
}
