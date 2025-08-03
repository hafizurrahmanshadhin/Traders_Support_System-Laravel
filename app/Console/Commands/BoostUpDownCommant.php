<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use App\Models\BoostTransaction;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Log as FacadesLog;

class BoostUpDownCommant extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:boost-check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'If Expire time it will decrement boost';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Get All transection
        $boosts = BoostTransaction::where('ended_at', '<', Carbon::now())->with('user')->where('status', 'active')->get();
        foreach ($boosts as $boost) {
            if($boost->user->is_boost > 0) {
                $boost->user->decrement('is_boost');
            }
            
            // Deactive boost transection
            $boost->update(['status' => 'inactive']);
        }
        Log::info('Checking Boosts');


    }
}
