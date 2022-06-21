<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

class RedisSubscribe extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'redis:subscribe';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update Driver Location';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // dump("ssss");
        // Redis::psubscribe(['PresenceChannelUpdated'], function ($message,$channel) {
        //     dump($message);
        // });

        // $client = new \GuzzleHttp\Client();
        // $response = $client->request('POST', "https://caberz.taha.alalmiyalhura.com:6009/apps/APP_ID_TEST/events?auth_key=1519d1c3adde7b27b8aacc4f57443134");
        // $response = json_decode($response->getBody()->getContents(),true);
        // dump($response);

        // Redis::connection('PresenceChannelUpdated')->psubscribe(['*'], function ($message, $channel) {
        //     dump($message);
        // });
    }
}
