<?php

namespace App\Http\Livewire\Employees;

use App\Models\Auth\LoginHistory;
use App\Models\Auth\User;
use App\Models\Auth\UserBankDetails;
use App\Models\Auth\UserBasicInfo;
use App\Models\Auth\UserBenchMark;
use App\Models\Auth\UserLeaveInfo;
use App\Models\Auth\UserOfficeTiming;
use App\Models\LeaveEntitlements\UserLeaveQuota;
use App\Services\LeaveEntitlementService;
use App\Services\Pre_Villages;
use App\Services\UsersPerformanceService;
use Carbon\Carbon;
use DateTime;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class ViewEmployee extends Component
{
    protected Pre_Villages $pre_Villages;
    protected LeaveEntitlementService $leaveEntitlementService;
    protected UsersPerformanceService $performanceService;

    public function mount(Pre_Villages $pre_Villages, LeaveEntitlementService $leaveEntitlementService, UsersPerformanceService $performanceService): void
    {
        $this->pre_Villages = $pre_Villages;
        $this->leaveEntitlementService = $leaveEntitlementService;
        $this->performanceService = $performanceService;
    }
    public function render(Request $request)
    {


        $Emp_ID = Crypt::decryptString($request->EMP_ID);


        //  if (Auth::guard('Authorized')->user()->EMP_ID == $Emp_ID ||  Auth::guard('Authorized')->user()->Role_ID == 1 || Auth::guard('Authorized')->user()->Role_ID == 2 ) {

        $Departments = $this->pre_Villages->getDepartments();
        $Designations = $this->pre_Villages->getDesignations();
        $Reporting_Authorities = $this->pre_Villages->getCoordinators();

        $User_Info = User::with([
            'designation',
            'basic_info',
            'bank_detail',
            'timing',
            'leaves'
        ])
            ->withTrashed()
            ->where('EMP_ID', $Emp_ID)->firstOrFail();

        $Role_ID = (int)$User_Info->Role_ID;
        $EMP_ID = $User_Info->EMP_ID;

        $loginHistory = LoginHistory::where('user_id', $User_Info->id)->get();

        // dd($Role_ID);
        $User_Performance = $this->performanceService->getUserPerformances($Role_ID, $EMP_ID);
        $Benchmark_List = UserBenchMark::with('user')
            ->where('user_id', $User_Info->id)
            ->orderBy('id', 'DESC')
            ->get();


        // dd($User_Info->toArray());
        $currenetUserRole = Auth::guard('Authorized')->user()->Role_ID;
        return view('livewire.employees.view-employee', compact('currenetUserRole', 'User_Info', 'Departments', 'Designations', 'loginHistory', 'User_Performance', 'EMP_ID', 'Role_ID', 'Benchmark_List', 'Reporting_Authorities'))->layout('layouts.authorized');
        // }else{
        //    abort(403);
        //    }

    }
    public function updateEMPBasicInfo(Request $request, LeaveEntitlementService $leaveEntitlementService)
    {
        
        if($request->has('user_update')){
            $emp_id = (int)$request->emp_id;
            
            UserBasicInfo::where('user_id', $emp_id)
                ->update([
                    'F_Name' => $request->F_Name,
                    'L_Name' => $request->L_Name,
                    'Phone_Number' => $request->Phone_Number,
                    'CNIC_Number' => $request->CNIC_Number,
                    'DOB' => (!empty($request->DOB)) ? date('Y-m-d', strtotime($request->DOB)) : null,
                 
                ]);
                
            return back()->with('Success!', 'Employee Updated Successfully!');
            
        }else{
        
        
        DB::beginTransaction();
        try {
            $Leaves = $leaveEntitlementService->calculateLeaveQuota();
            $emp_id = (int)$request->emp_id;
            $empLeaveInfo = UserLeaveInfo::where('user_id', $emp_id)->first();
            User::where('id', $emp_id)
                ->update([
                    'email' => $request->User_Email,
                    'Role_ID' => (int)$request->Designation,
                    'CID' => (!empty($request->CID)) ? (int)$request->CID : null,
                ]);

            UserBasicInfo::where('user_id', $emp_id)
                ->update([
                    'F_Name' => $request->F_Name,
                    'L_Name' => $request->L_Name,
                    'Phone_Number' => $request->Phone_Number,
                    'CNIC_Number' => $request->CNIC_Number,
                    'Join_Date' => date('Y-m-d', strtotime($request->Joining_Date)),
                    'Permanent_Date' => ($request->EMP_Status === 2) ? Carbon::now() : null,
                    'Probation_Period' => $request->Probation_Period,
                    'DOB' => (!empty($request->DOB)) ? date('Y-m-d', strtotime($request->DOB)) : null,
                    'Dep_ID' => (int)$request->Department,
                    'EMP_Status' => $request->EMP_Status,
                    'Job_Type' => $request->Job_Type,
                    'Basic_Salary' => (float)$request->Basic_Salary,
                ]);

            UserOfficeTiming::where('user_id', $emp_id)
                ->update([
                    'Start_Time' => $request->Start_Time,
                    'End_Time' => $request->End_Time,
                ]);
 
            DB::commit();
            return back()->with('Success!', 'Employee Updated Successfully!');
        } catch (Exception $e) {
            return redirect()->route('Error.Response', ['Message' => $e->getMessage()]);
        }
        
        
        }
    }
    public function updateEMPLeaveInfo(Request $request): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $emp_id = (int)$request->emp_id;
            UserLeaveInfo::where('user_id', $emp_id)
                ->update([
                    'Sick_Leaves' => $request->Sick_Leaves,
                    'Annual_Leaves' => $request->Annual_Leaves,
                    'Casual_Leaves' => $request->Casual_Leaves,
                    'Off_Day' => $request->Off_Day,
                    'Un_Paid' => 0
                ]);
            UserLeaveQuota::where('user_id', $emp_id)
                ->update([
                    'Sick_Leaves' => $request->Sick_Leaves,
                    'Annual_Leaves' => $request->Annual_Leaves,
                    'Casual_Leaves' => $request->Casual_Leaves,
                    'Off_Day' => $request->Off_Day,
                     'Un_Paid' => 0
                ]);
            DB::commit();
            return back()->with('Success!', 'Employee Updated Successfully!');
        } catch (Exception $e) {
            return redirect()->route('Error.Response', ['Message' => $e->getMessage()]);
        }
    }

    public function updateEMPBankInfo(Request $request): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $emp_id = (int)$request->emp_id;
            UserBankDetails::where('user_id', $emp_id)
                ->update([
                    'Bank_Name' => $request->Bank_Name,
                    'Account_Title' => $request->Account_Title,
                    'Account_Number' => $request->Account_Number,
                ]);
            DB::commit();
            return back()->with('Success!', 'Employee Updated Successfully!');
        } catch (Exception $e) {
            return redirect()->route('Error.Response', ['Message' => $e->getMessage()]);
        }
    }

    public function updateEMPPassword(Request $request): RedirectResponse
    {
        //        try {
        //            $request->validate([
        //                'current_password' => ['required', new MatchOldPassword($request->current_password)],
        //                'new_password' => ['required'],
        //                'new_confirm_password' => ['same:new_password'],
        //            ]);
        //
        //            DB::beginTransaction();
        //            $emp_id = (int) $request->emp_id;
        //
        //            User::where('id', $emp_id)
        //                ->update([
        //                    'password' => Hash::make($request->new_password),
        //                ]);
        //
        //            DB::commit();
        //            return back()->with('Success!', 'Employee Updated Successfully!');
        //        } catch (Exception $e) {
        //            DB::rollback();
        //            return back()->with('Error!', 'Something Went Wrong!');
        //        }
        //        if (Hash::check($request->current_password, Auth::guard('Authorized')->user()->password)) {
        $emp_id = (int)$request->emp_id;
        if ($request->new_password === $request->password_confirmation) {
            User::where('id', $emp_id)
                ->update([
                    'password' => Hash::make($request->new_password),
                ]);
            return back()->with('Success!', 'Password Updated Successfully!');
        }
        return back()->with('Error!', 'Confirm Password are not same!');
        //        }
        //        return back()->with('Error!', 'you Enter the Wrong Password!');
    }

    public function updateProfileImage(Request $request): RedirectResponse
    {
        try {
            DB::beginTransaction();
            $current_user = Auth::guard('Authorized')->user();
            $previous_img = UserBasicInfo::where('user_id', $current_user->id)
                ->select('profile_photo_path')
                ->first();
            $old_image = asset($previous_img->profile_photo_path);
            if (file_exists($old_image)) {
                unlink($old_image);
            }
            $name = $request->file('Profile_Image')->getClientOriginalName();
            $request->file('Profile_Image')->move(public_path('Uploads/Profiles/'), $name);
            $FileName = 'Uploads/Profiles/' . $name;
            UserBasicInfo::where('user_id', $current_user->id)->update([
                'profile_photo_path' => $FileName,
            ]);

            DB::commit();
            return redirect()->back()->with('Success!', 'Image updated successfully.');
        } catch (Exception $e) {
            return redirect()->route('Error.Response', ['Message' => $e->getMessage()]);
        }
    }
}
