<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\{UpdateTempWallet};
use App\Models\{TemporaryWallet};

class RunTempWallet extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'temp_balance:work';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove Expired Balance';

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
        $wallet_temps = TemporaryWallet::where('is_expired',0)->whereDate('end_at',"<=",date("Y-m-d"))->whereTime('end_at',"<=",now()->addHour()->format("H:i:s"))->count();
        if ($wallet_temps) {
            UpdateTempWallet::dispatch()->delay(now()->addHour())->onQueue('temp_balance');
        }
    }
}
