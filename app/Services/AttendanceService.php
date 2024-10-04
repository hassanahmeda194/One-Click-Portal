<?php

namespace App\Services;


use App\Models\Attendance\Attendance;
use App\Models\Auth\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class AttendanceService
{
    public function getUserAttendance($User_ID = null): Collection|array
    {
        $currentMonth = Carbon::now()->month;
        if (!empty($User_ID)){
            return Attendance::where('user_id', $User_ID)
                ->latest('created_at')
                ->whereMonth('created_at', $currentMonth)
                ->get();
        }
        return Attendance::latest('created_at')
            ->whereMonth('created_at', $currentMonth)
            ->get();
    }

    public function getAllUserAttendance(): Collection|array
    {
        $currentMonth = Carbon::now()->month;
        return User::with(['attendance' => function ($query) use ($currentMonth) {
            $query->whereMonth('created_at', $currentMonth);
        }])
            ->latest('id')
            ->get();
    }

    public function getTodayAttendance(): Collection|array
    {
        $today = Carbon::now();
        return User::with(['attendance' => function ($query) use ($today) {
            $query->whereMonth('created_at', $today);
        }])
            ->latest('id')
            ->get();
    }

    public function userAttendanceCounter($User_ID): array
    {
        $currentMonth = Carbon::now()->month;
        $basicInfoCounts = Attendance::where('user_id', $User_ID)
            ->latest('created_at')
            ->whereMonth('created_at', $currentMonth)
            ->select('status', DB::raw('COUNT(*) as count'))
            ->groupBy('status')
            ->get();

        $statusCounts = collect();

        foreach ($basicInfoCounts as $status) {
            $statusCounts->put($status->status . '_Count', $status->count + ($statusCounts->get($status->status . '_Count', 0)));
        }

        $statusCounts->toArray();
        return [
            'Present_Count' => $statusCounts['Present_Count'] ?? 0,
            'Absent_Count' => $statusCounts['Absent_Count'] ?? 0,
            'Late_Count' => $statusCounts['Late_Count'] ?? 0,
            'Half_Day_Count' => $statusCounts['Half-Day_Count'] ?? 0,
        ];
    }

}
