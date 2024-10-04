<?php

namespace App\Console\Commands\Portal;

use App\Helpers\PortalHelpers;
use App\Models\Attendance\Attendance;
use App\Models\Auth\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class MarkAbsentUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'attendance:mark-absent';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Mark absent for users who have not marked attendance after a specific date';

    /**
     * Execute the console command.
     *
     * @return int|null
     */
    public function handle()
    {
        $currentDate = Carbon::now();

        if ($currentDate->isSunday()) {
            $this->info('Today is Sunday. No absent marking is required.');
            return null;
        }

      $users = User::whereDoesntHave('attendance', function ($query) use ($currentDate) {
    $query->whereDate('created_at', '<', $currentDate->addDay()); // consider today as well
})->get();


    
        $this->info('Absent marked for users who have not marked attendance.');
        return Command::SUCCESS;
    }
}
