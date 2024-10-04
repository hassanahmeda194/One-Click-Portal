<?php

namespace App\Http\Livewire\Attendance;

use App\Helpers\PortalHelpers;
use App\Models\Attendance\Attendance;
use App\Services\AttendanceService;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use PDOException;
use RuntimeException;

class UserAttendance extends Component
{
    protected AttendanceService $attendanceService;
    public function mount(AttendanceService $attendanceService): void
    {
        $this->attendanceService = $attendanceService;
    }
    public function render(Request $request)
    {

        $Filter_User_Attendance = [];
        $Filter_User_Attendance_Counter = [];
        if ($request->has('Month')) {
            $User_ID = Crypt::decryptString($request->User_ID);
            $FilterMonth = \Carbon\Carbon::parse("1 {$request->input('Month')}")->month;
            $Filter_User_Attendance = Attendance::whereMonth('created_at', $FilterMonth)
                ->where('user_id', $User_ID)
                ->get();
            $Filter_User_Attendance_Counter = $this->attendanceService->userAttendanceCounter((int) $User_ID, $FilterMonth);
        }
        Auth::guard('Authorized')->user();
        $User_ID = Crypt::decryptString($request->User_ID);
        $User_Attendance = $this->attendanceService->getUserAttendance((int) $User_ID);
        $User_Attendance_Counter = $this->attendanceService->userAttendanceCounter((int) $User_ID);
        return view('livewire.attendance.user-attendance', compact(
            'User_Attendance',
            'User_Attendance_Counter',
            'Filter_User_Attendance',
            'Filter_User_Attendance_Counter'
        ))->layout('layouts.authorized');
    }
    
    public function markUserAttendanceIn(Request $request): RedirectResponse
    {
        try {
            DB::beginTransaction();
            $ip_address = PortalHelpers::getIpAddress();
            $check_in = Carbon::now();
            $status = PortalHelpers::setAttendanceStatus($check_in, $request->user_id);

            $attendance = Attendance::where('user_id', $request->user_id)
                ->whereDate('created_at', Carbon::today())
                ->first(); 

            if (!$attendance) {
                Attendance::create([
                    'user_id' => $request->user_id,
                    'ip_address' => $ip_address,
                    'check_in' => $check_in,
                    'status' => $status
                ]);
            } else {
                $attendance->update([
                    'ip_address' => $ip_address,
                    'check_in' => $check_in,
                    'status' => $status
                ]);
            }

            DB::commit();
            return back()->with('success', "Your Attendance has been Marked!!");
        } catch (PDOException $e) {
            DB::rollBack();
            return redirect()->route('Error.Response', ['Message' => $e->getMessage()]);
        }
    }

    public function markUserAttendanceOut(Request $request): RedirectResponse
    {
        try {
            DB::beginTransaction();
            $ip_address = PortalHelpers::getIpAddress();
            $attendance = Attendance::find($request->lastAttendanceID);
            if (!$attendance) {
                throw new RuntimeException("Attendance not found.");
            }
            $attendance->user_id = $request->user_id;
            $attendance->ip_address = $ip_address;
            $attendance->check_out = Carbon::now();
            $attendance->save();
            $total_time = PortalHelpers::calculateTotalTime($attendance->check_in, $attendance->check_out);
            $attendance->total_time = $total_time;
            $attendance->save();
            DB::commit();
            return back()->with('Success!', "Your Attendance has been marked successfully!");
        } catch (PDOException | Exception $e) {
            DB::rollBack();
            return redirect()->route('Error.Response', ['Message' => $e]);
        }
    }
}
