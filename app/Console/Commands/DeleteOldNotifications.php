<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DeleteOldNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notifications:delete-old';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete notifications older than 3 days';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $cutoffDate = Carbon::now()->subDays(3);

        DB::table('notifications')
            ->where('created_at', '<', $cutoffDate)
            ->delete();

        $this->info('Old notifications deleted successfully.');
        return 0;
    }













    
}












