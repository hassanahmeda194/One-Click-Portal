<?php

namespace App\Console\Commands\Portal;

use App\Helpers\PortalHelpers;
use App\Models\Auth\User;
use App\Models\Auth\UserBasicInfo;
use App\Notifications\PortalNotifications;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;


class NotifyHrOnUserProbation extends Command
{
    protected $signature = 'notify:user-probation';

    protected $description = 'Notify HR when a user\'s probation period is about to end';

    public function handle()
    {


    $probation_users = User::with(['basic_info' => function ($q) {
        $q->where('EMP_Status', 1);
    }])
    ->whereHas('basic_info', function ($q) {
        $q->where('EMP_Status', 1);
    })
    ->get();

    $probation_users->each(function ($probation_user) {
        $probationEndDate = Carbon::parse($probation_user->basic_info->Join_Date)->addMonths($probation_user->basic_info->Probation_Period);

        $twoDaysBeforeProbationEnd = $probationEndDate->subDays(2);

      if (Carbon::now()->addDays(2)->isSameDay($probationEndDate)) {


            $notificationData = [
                'Emp_ID' => $probation_user->EMP_ID,
                'Role_Name' => $probation_user->designation->Designation_Name,
                'Message' => 'The Probation Period of ' . $probation_user->basic_info->full_name . ' is Completed within 2 Day',
                'Play_Sound' => true,
                'Order_ID' => "PROBATION",
            ];
            $user = User::whereIn('Role_ID',[2, 14, 15])->get();

            Notification::send($user, new PortalNotifications($notificationData));

        }
    });

    }
}