<?php

namespace App\Services;

use App\Models\Auth\User;
use App\Models\LeaveEntitlements\LeaveRequest;
use App\Models\LeaveEntitlements\LeaveSetting;
use Carbon\Carbon;
use Carbon\CarbonInterface;
use Carbon\CarbonPeriod;
use Illuminate\Database\Eloquent\Collection;

class LeaveEntitlementService
{
    public function getLeavesTypesList()
    {
        return LeaveSetting::orderBy('id', 'DESC')->get();
    }

    public function getLeavesTypes()
    {
        return $this->getLeavesTypesList()->flatMap(function ($item) {
            $key = str_replace([' ', '-'], '_', $item->Leave_Type);
            return [
                $key => $item->Leave_Numbers
            ];
        });
    }

    public function getTotalSumLeaves()
    {
        return LeaveSetting::sum('Leave_Numbers');
    }

    public function getLeavesRequests(int $Role_ID = null, int $User_ID = null): Collection|array
    {
        return match ($Role_ID) {
            1, 2 => LeaveRequest::with('user')
                ->get(),
            9 => LeaveRequest::with('user')
                ->whereRelation('user', 'Role_ID', 10)
                ->get(),
            5, 10 => LeaveRequest::with('user')
                ->whereRelation('user', 'CID', $User_ID)
                ->get(),
            4 => LeaveRequest::with('user')
                ->whereRelation('user', 'Role_ID', [5, 7, 12])
                ->get(),
            default => LeaveRequest::with('user')
                ->where('user_id', $User_ID)
                ->get(),
        };
    }

    public function getUserLeaveQuota(): \Illuminate\Support\Collection
    {
        return User::with([
            'leaves',
            'leave_quota',
        ])->withCount(['attendance as half_day_count' => function ($query) {
            $query->where('status', 3);
        }], 'attendance as status_2_count')
            ->get()
            ->map(function ($user) {
                return [
                    'EMP_ID' => $user->EMP_ID,
                    'EMP_Name' => $user->basic_info->full_name,
                    'Profile_Photo' => !empty($user->basic_info->profile_photo_path) ? asset($user->basic_info->profile_photo_path) : asset('assets/images/users/16.jpg'),
                    'Half_Day' => $user->half_day_count,
                    'Sick_Leaves' => $user->leaves->Sick_Leaves - $user->leave_quota->Sick_Leaves,
                    'Annual_Leaves' => $user->leaves->Annual_Leaves - $user->leave_quota->Annual_Leaves,
                    'Casual_Leaves' => $user->leaves->Casual_Leaves - $user->leave_quota->Casual_Leaves,
                    'Un_Paid' => $user->leave_quota->Un_Paid,
                    'Remaining' => $user->leave_quota->Sick_Leaves + $user->leave_quota->Annual_Leaves + $user->leave_quota->Casual_Leaves,
                ];
            });
    }

    public function calculateLeaveQuota(): array
    {
        $Leaves = $this->getLeavesTypes();
        $annualQuota = $Leaves['Annual_Leave'] -1;
        $casualQuota = $Leaves['Casual_Leave'] -1;
        $sickQuota = $Leaves['Sick_Leave'] -1;
        $workingDaysPerWeek = 6;
        $year = Carbon::now()->year;
        $totalWeeksInYear = $this->getWeeksInYear($year);
        $daysInYear = $this->calculateDaysToEndOfYear();

        // Adjust leave quotas based on working days per week
        if ($workingDaysPerWeek < 7) {
            $annualQuota *= ($workingDaysPerWeek / 7);
            $casualQuota *= ($workingDaysPerWeek / 7);
            $sickQuota *= ($workingDaysPerWeek / 7);
        }

        // Adjust leave quotas based on total weeks in a year
        $annualLeaveQuota = round($annualQuota * ($totalWeeksInYear / 52));
        $casualLeaveQuota = round($casualQuota * ($totalWeeksInYear / 52));
        $sickLeaveQuota = round($sickQuota * ($totalWeeksInYear / 52));

        return [
            'Annual' => (int)(($annualLeaveQuota / $daysInYear) * 100),
            'Casual' => (int)(($casualLeaveQuota / $daysInYear) * 100),
            'Sick' => (int)(($sickLeaveQuota / $daysInYear) * 100),
        ];
    }

    private function getWeeksInYear($year): int
    {
        $startDate = Carbon::createFromDate($year, 1, 1); // Start date of the year
        $endDate = Carbon::createFromDate($year, 12, 31); // End date of the year
        $period = CarbonPeriod::create($startDate, '1 week', $endDate); // Create a period of 1-week intervals

        return iterator_count($period); // Count the number of weeks in the year
    }

    private function calculateDaysToEndOfYear(): int
    {
        $startDate = Carbon::now();
        $endDate = Carbon::parse($startDate)->endOfYear();

        $days = 0;
        while ($startDate <= $endDate) {
            if ($startDate->dayOfWeek !== CarbonInterface::SUNDAY) {
                $days++;
            }
            $startDate->addDay();
        }
        return $days;
    }

}
