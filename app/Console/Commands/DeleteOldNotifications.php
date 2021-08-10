<?php

namespace App\Console\Commands;

use App\Models\Notification;
use Carbon\Carbon;
use Illuminate\Console\Command;

class DeleteOldNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notifications:delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deletes old notifications';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

//    /**
//     * Execute the console command.
//     *
//     * @return int
//     */
    public function handle()
    {
        Notification::where('created_at', '<', Carbon::now()->subDays(7))->each(function ($item) {
            $item->delete();
        });
    }
}
