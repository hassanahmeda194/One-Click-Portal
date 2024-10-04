<?php
// App\Console\Commands\Portal\MarkAbsentUsers.php

namespace App\Console\Commands\Portal;

use App\Models\Attendance\Attendance;
use App\Models\Auth\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class MarkAttendenceUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'attendance:mark';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Mark attendance for users who have not marked it yet';

    /**
     * Execute the console command.
     *
     * @return void
     */
        public function handle()
        {
            $currentDate = Carbon::now();
            // $customDate = Carbon::create($currentDate->year, 2, 21);

            $users = User::all();
        if ($currentDate->isSunday()) {
          $status = 10;
        }else{
          $status = 9;
        }

            foreach ($users as $user) {
                if (!$user->attendance()->whereDate('created_at', $currentDate)->exists()) {
                    Attendance::create([
                        'user_id' => $user->id,
                        'ip_address' => null,
                        'check_in' => null,
                        'check_out' => null,
                        'total_time' => null,
                        'status' => $status,
                        'reason' => null,
                        'created_at' => $currentDate,
                    ]);
                }
            }

            // This line will not be reached if dd() is executed
            $this->info('Attendance marked for users who have not marked it yet.');
        }
}