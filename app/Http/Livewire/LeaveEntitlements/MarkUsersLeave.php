<?php

namespace App\Http\Livewire\LeaveEntitlements;

use App\Models\Auth\User;
use App\Models\LeaveEntitlements\LeaveSetting;
use App\Models\LeaveEntitlements\UserLeaveQuota;
use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\PortalHelpers;
use App\Models\Attendance\Attendance;
use Exception;
use Carbon\Carbon;
use Carbon\CarbonPeriod;


class MarkUsersLeave extends Component
{
public function render(Request $request)
{
    if ($request->query('month') || $request->query('year')) {

        $users = User::with(['leave_quota', 'basic_info', 'attendance' => function ($query) use ($request) {
            $query->whereIn('status', [4, 5, 6, 7]);
            if ($request->query('month')) {
                $query->whereMonth('created_at', $request->query('month'));
            }
            if ($request->query('year')) {
                $query->whereYear('created_at', $request->query('year'));
            }
        }])->whereHas('attendance', function ($query) use ($request) {
            $query->whereIn('status', [4, 5, 6, 7]);
            if ($request->query('month')) {
                $query->whereMonth('created_at', $request->query('month'));
            }
            if ($request->query('year')) {
                $query->whereYear('created_at', $request->query('year'));
            }
        })->get();
    } else {
        $users = User::with(['leave_quota', 'basic_info', 'attendance' => function ($query) {
            $query->whereIn('status', [4, 5, 6, 7])->whereMonth('created_at', Carbon::now()->month);
        }])->whereHas('attendance', function ($query) {
            $query->whereIn('status', [4, 5, 6, 7])->whereMonth('created_at', Carbon::now()->month);
        })->get();
    }

    $all_user = User::with('basic_info')->get();
    $leave_types = LeaveSetting::get();

    return view('livewire.leave-entitlements.mark-user-leave', compact('all_user', 'users', 'leave_types'))->layout('layouts.authorized');
}


    public function markLeave(Request $request)
    {
        $start_date = Carbon::parse($request->start_date)->startOfDay();
        $end_date = Carbon::parse($request->end_date)->endOfDay();
        $nowOfDays = $end_date->diffInDays($start_date) + 1;

        $leaveType = (int)$request->leave_type;
        $userId = $request->user_id;

        $reason = $request->reason;

        $user = User::with('leave_quota', 'basic_info')->find($userId);
        $userLeaveQuota = $user->leave_quota;

        $typeName = [
            1 => 'Annual_Leaves',
            2 => 'Casual_Leaves',
            3 => 'Sick_Leaves',
            4 => 'Un_Paid',
        ];

        $availableLeaves = $userLeaveQuota->{$typeName[$leaveType]};
        if ($user->basic_info->EMP_Status == 1 && $leaveType !== 4) {
            return redirect()->back()->with('Error!', 'For Probation Employee Only unpaid leave allowed.');
        }
        if ($leaveType !== 4 && $availableLeaves < $nowOfDays) {
            return redirect()->back()->with('Error!', 'Insufficient leave balance. Available leaves: ' . $availableLeaves);
        }

        $existingRecords = Attendance::where('user_id', $userId)
            ->whereBetween('created_at', [$start_date, $end_date])
            ->get();

        $datesToUpdate = $existingRecords->pluck('created_at')->map(function ($date) {
            return Carbon::parse($date)->toDateString();
        })->toArray();

        $allDatesInRange = collect(CarbonPeriod::create($start_date, $end_date))->map(function ($date) {
            return $date->toDateString();
        })->toArray();

        $datesToCreate = array_diff($allDatesInRange, $datesToUpdate);
            // dd("Dates to Create:", $datesToCreate,"Dates to Update:", $datesToUpdate);

     
        $status = NULL;
        if ($leaveType == 1) {
            $status = 4;
        } else if ($leaveType == 2) {
            $status = 5;
        } else if ($leaveType == 3) {
            $status = 6;
        } else if ($leaveType == 4) {
            $status = 7;
        }

        // Dates to update
        Attendance::whereIn('id', $existingRecords->pluck('id'))->update([
            'check_in' => null,
            'check_out' => null,
            'total_time' => null,
            'status' => $status,
            'reason' => $reason,
            'user_id' => $userId,
        ]);

        // Dates to create
        foreach ($datesToCreate as $date) {
            Attendance::create([
                'check_in' => null,
                'check_out' => null,
                'total_time' => null,
                'status' => $status,
                'reason' => $reason,
                'user_id' => $userId,
                'created_at' => $date,
            ]);
        }

        // Update leave quota
        $userLeaveQuota->{$typeName[$leaveType]} += ($leaveType == 4) ? $nowOfDays : -$nowOfDays;
        $userLeaveQuota->save();
        
   



        return redirect()->back()->with('Success!', 'Leave Marked successfully');
    }
}
