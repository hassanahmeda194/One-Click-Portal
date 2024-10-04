<?php

namespace App\Http\Livewire\LeaveEntitlements;

use App\Helpers\PortalHelpers;
use App\Models\Attendance\Attendance;
use App\Models\Auth\User;
use App\Services\AttendanceService;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use App\Models\LeaveEntitlements\UserLeaveQuota;

class MarkUserAttendance extends Component
{
    protected AttendanceService $attendanceService;

    public function mount(AttendanceService $attendanceService): void
    {
        $this->attendanceService = $attendanceService;
    }
    
    public function render(Request $request)
{
    if ($request->date) {
        $currentDate = $request->date;
        $currentMonth = Carbon::parse($currentDate)->format('m');
    } else {
        $currentDate = now()->toDateString();
        $currentMonth = now()->format('m');
    }

$UserInfo = User::with(['basic_info' => function($q){
        $q->orderBy('F_Name', 'asc');
    }, 'attendance' => function ($query) use ($currentDate) {
        $query->whereDate('created_at', $currentDate);
    }])
    ->get();

$UserInfo = $UserInfo->sortBy(function($user) {
    return $user->basic_info->F_Name;
});


// dd($UserInfo->toArray());


    return view('livewire.leave-entitlements.mark-user-attendance', compact('UserInfo'))->layout('layouts.authorized');
}


    public function markAttendance(Request $request): RedirectResponse
    {
        try {
            DB::beginTransaction();
            $currentDate = $request->date ?? Carbon::now();
            $ip_address = PortalHelpers::getIpAddress();

            Attendance::create([
                'check_in' => $request->Shift_Start,
                'check_out' => $request->Shift_End,
                'user_id' => $request->User_ID,
                'status' => 0, // Assuming 0 represents an initial status
                'created_at' => $currentDate,
                'ip_address' => $ip_address
            ]);
            
            

            DB::commit();
            return redirect()->back()->with('success', 'Attendance has been marked successfully');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('Error.Response', ['Message' => $e->getMessage()]);
        }
    }
    
    public function updateAttendance(Request $request)
{
    $currentDate = $request->date ?? Carbon::now();
    $ip_address = PortalHelpers::getIpAddress();
    
    
    if ($request->has('half-day')) {
        $status = 3;  
        $CheckIn = $request->Shift_Start;
        $CheckOut = $request->Shift_End;
    
        
    } elseif($request->has('mark_new')) {
        $status = PortalHelpers::setAttendanceStatus($request->Shift_Start, $request->User_ID);
        $CheckIn = $request->Shift_Start;
        $CheckOut = $request->Shift_End;
    }

    $user = Attendance::where('user_id' , $request->User_ID)->whereDate('created_at', $currentDate)->first();
    if($user){
        $getUserQuota = UserLeaveQuota::where('user_id',$request->User_ID)->first();
        if($user->status == "Annual"){
            $getUserQuota->Annual_Leaves +=1;
        } elseif($user->status == "Casual"){
            $getUserQuota->Casual_Leaves +=1;
        } elseif($user->status == "Sick"){
            $getUserQuota->Sick_Leaves +=1;
        } elseif($user->status == "UnPaid"){
            $getUserQuota->Un_Paid -=1;
        }
        
        $getUserQuota->save();
        
        $user->update([
        'check_in' => $CheckIn,
        'check_out' => $CheckOut,
        'status' => $status,
        'ip_address' => $ip_address,
        'user_id' => $request->User_ID,
        'created_at' => $currentDate,
            ]);
            
    return redirect()->back()->with('Success!', 'Attendance has been updated successfully');
    }else{
        Attendance::create([
            'check_in' => $CheckIn,
        'check_out' => $CheckOut,
        'status' => $status,
        'ip_address' => $ip_address,
        'user_id' => $request->User_ID,
        'created_at' => $currentDate,
            ]);
    return redirect()->back()->with('Success!', 'Attendance has been updated successfully');
    }
    
   

  

}
    
    

    public function getMarkAttendance(Request $request): string
    {
        $Date = date('Y-m-d', strtotime($request->date));
        $UserInfo = User::orderBy('id', 'DESC')
            ->with(['attendance' => function ($query) use ($Date) {
                $query->whereDate('created_at', $Date);
            }])->get();

        $output = '<table class="table table-vcenter text-nowrap table-bordered border-bottom" id="hr-table">
        <thead>
            <tr>
                <th class="border-bottom-0 w-5">#Emp ID</th>
                <th class="border-bottom-0">Emp Name</th>
                <th class="border-bottom-0">Status</th>
                <th class="border-bottom-0">Clock In</th>
                <th class="border-bottom-0">Clock Out</th>
                <th class="border-bottom-0">IP Address</th>
                <th class="border-bottom-0">Working From</th>
                <th class="border-bottom-0">Attendance</th>
                <th class="border-bottom-0">Actions</th>
            </tr>
        </thead>
        <tbody>';

        foreach ($UserInfo as $Info) {
            $output .= '<tr>
            <td>' . $Info->EMP_ID . '</td>
            <td>
                <div class="d-flex">
                    <span class="avatar avatar-md brround me-3" style="background-image: url(../../assets/images/users/1.jpg)"></span>
                    <div class="me-3 mt-0 mt-sm-1 d-block">
                        <h6 class="mb-1 fs-14">' . $Info->basic_info->full_name . '</h6>
                    </div>
                </div>
            </td>';

            if ($Info->attendance->isEmpty()) {
                $output .= '<td><span>-</span></td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>';
            } else {
                foreach ($Info->attendance as $attendance) {
                    $output .= '<td><span>' . ($attendance->status ?? '-') . '</span></td>
                            <td>' . ($attendance->check_in ?? '-') . '</td>
                            <td>' . ($attendance->check_out ?? '-') . '</td>
                            <td>' . ($attendance->ip_address ?? '-') . '</td>';
                }
            }

            $output .= '<td>Office</td>
            <td><span class="badge badge-success">Marked</span></td>
            <td>
                <div class="d-flex">
                    <label class="custom-control custom-checkbox-md">
                        <input type="checkbox" data-id="' . $Info->id . '" class="custom-control-input-success" name="Mark-Attandence" value="option1" id="Mark-Attandence">
                        <span class="custom-control-label-md success"></span>
                    </label>
                    <a href="#" class="action-btns1 bg-light" data-bs-toggle="modal" data-bs-target="#presentmodal">
                        <i class="feather feather-eye primary text-primary" data-bs-toggle="tooltip" data-original-title="View"></i>
                    </a>
                </div>
            </td>
        </tr>';
        }

        $output .= '</tbody>
    </table>';

        return $output;
    }
}
