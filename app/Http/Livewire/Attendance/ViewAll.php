<?php

namespace App\Http\Livewire\Attendance;

use App\Services\AttendanceService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ViewAll extends Component
{
    protected AttendanceService $attendanceService;

    public function mount(AttendanceService $attendanceService): void
    {
        $this->attendanceService = $attendanceService;
    }

    public function render(Request $request)
    {
        Auth::guard('Authorized')->user();
        $User_Attendance = $this->attendanceService->getAllUserAttendance();
// dd($User_Attendance->toArray());
        return view('livewire.attendance.view-all', compact('User_Attendance'))->layout('layouts.authorized');
    }
}
