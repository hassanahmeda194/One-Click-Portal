<?php

namespace App\Http\Livewire\Employees;

use App\Models\Auth\User;
use App\Models\Auth\UserBankDetails;
use App\Models\Auth\UserBasicInfo;
use App\Models\Auth\UserEmergencyInfo;
use App\Models\Auth\UserLeaveInfo;
use App\Models\Auth\UserOfficeTiming;
use App\Models\LeaveEntitlements\UserLeaveQuota;
use App\Services\LeaveEntitlementService;
use App\Services\Pre_Villages;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class NewEmployee extends Component
{
    protected Pre_Villages $pre_Villages;
    protected LeaveEntitlementService $leaveEntitlementService;

    public function mount(Pre_Villages $pre_Villages, LeaveEntitlementService $leaveEntitlementService): void
    {
        $this->pre_Villages = $pre_Villages;
        $this->leaveEntitlementService = $leaveEntitlementService;
    }

    public function render()
    {
        $Departments = $this->pre_Villages->getDepartments();
        $Designations = $this->pre_Villages->getDesignations();
        $Coordinators = $this->pre_Villages->getCoordinators();
        $Writer_Skills = $this->pre_Villages->getWriterSkills();
        $lastUser = User::withTrashed()->orderBy('created_at', 'desc')->first();
        if ($lastUser === null) {
            $L_UID = 'REG-1';
        } else {
            $L_UID = 'REG-' . ($lastUser->id + 1);
        }
        $Leaves = $this->leaveEntitlementService->getLeavesTypes();
        return view('livewire.employees.new-employee', compact('L_UID', 'Departments', 'Designations', 'Coordinators', 'Writer_Skills', 'Leaves'))->layout('layouts.authorized');
    }

    public function UserRegistration(Request $request, LeaveEntitlementService $leaveEntitlementService): RedirectResponse
    {
        try {
            DB::beginTransaction();
            $flag = false;
            $auth_info = Auth::guard('Authorized')->user();
            $Leaves = $leaveEntitlementService->calculateLeaveQuota();
            $User = User::create([
                'EMP_ID' => $request->Employee_Id,
                'email' => $request->User_Email,
                'password' => bcrypt($request->Password),
                'Role_ID' => (int)$request->Designation,
                'CID' => (empty($request->Coordinator)) ? null : (int)$request->Coordinator,
                'Skill_ID' => (empty($request->Writer_Skill)) ? null : (int)$request->Writer_Skill,
                'created_by' => null
            ]);
            if ($User) {
                $UserBasicInfo = UserBasicInfo::create([
                    'F_Name' => $request->F_Name,
                    'L_Name' => $request->L_Name,
                    'Phone_Number' => $request->Phone_Number,
                    'CNIC_Number' => $request->CNIC_No,
                    'Join_Date' => date('Y-m-d', strtotime($request->Joining_Date)),
                    'Permanent_Date' => ($request->EMP_Status === 2) ? Carbon::now() : null,
                    'Probation_Period' => $request->Probation_Period,
                    'Dep_ID' => (int)$request->Department,
                    'EMP_Status' => $request->Employee_Status,
                    'Job_Type' => $request->Job_Type,
                    'Basic_Salary' => $request->Basic_Salary,
                    'user_id' => $User->id
                ]);
                if ($UserBasicInfo) {
                    foreach ($request->Emergency_Name as $key => $value) {
                        UserEmergencyInfo::create([
                            'Name' => $request->Emergency_Name[$key],
                            'Phone_Number' => $request->Emergency_Phone[$key],
                            'Relation' => $request->Emergency_Relation[$key],
                            'user_id' => $User->id
                        ]);
                        $flag = true;
                    }
                    if ($flag) {
                        if ($request->EMP_Status === 2) {
                            $UserLeaveInfo = UserLeaveInfo::create([
                                'Sick_Leaves' => $Leaves['Sick'],
                                'Annual_Leaves' => $Leaves['Annual'],
                                'Casual_Leaves' => $Leaves['Casual'],
                                'Off_Day' => $request->Off_Day,
                                'user_id' => $User->id
                            ]);
                            $UserLeaveQuota = UserLeaveQuota::create([
                                'Sick_Leaves' => $Leaves['Sick'],
                                'Annual_Leaves' => $Leaves['Annual'],
                                'Casual_Leaves' => $Leaves['Casual'],
                                'Off_Day' => $request->Off_Day,
                                'user_id' => $User->id
                            ]);
                        } else {
                            $UserLeaveInfo = UserLeaveInfo::create([
                                'Sick_Leaves' => $request->Sick_Leave,
                                'Annual_Leaves' => $request->Annual_Leave,
                                'Casual_Leaves' => $request->Casual_Leave,
                                'Off_Day' => $request->Off_Days,
                                'user_id' => $User->id
                            ]);
                            $UserLeaveQuota = UserLeaveQuota::create([
                                'Sick_Leaves' => $request->Sick_Leave,
                                'Annual_Leaves' => $request->Annual_Leave,
                                'Casual_Leaves' => $request->Casual_Leave,
                                'Off_Day' => $request->Off_Days,
                                'user_id' => $User->id
                            ]);
                        }
                        if ($UserLeaveInfo && $UserLeaveQuota) {
                            $UserOfficeTiming = UserOfficeTiming::create([
                                'Start_Time' => $request->Start_Time,
                                'End_Time' => $request->End_Time,
                                'user_id' => $User->id
                            ]);
                            if ($UserOfficeTiming) {
                                $UserBankDetails = UserBankDetails::create([
                                    'Bank_Name' => $request->Bank_Name,
                                    'Account_Title' => $request->Account_Title,
                                    'Account_Number' => $request->Account_Number,
                                    'user_id' => $User->id
                                ]);
                                if ($UserBankDetails) {
                                    DB::commit();
                                    return back()->with('Success!', "New User Added Successfully!");
                                }
                                DB::rollBack();
                                return back()->with('Error!', "Bank Details Error!");
                            }
                            DB::rollBack();
                            return back()->with('Error!', "Office Timing Failed!");
                        }
                        DB::rollBack();
                        return back()->with('Error!', "User Leaves Failed!");
                    }
                    DB::rollBack();
                    return back()->with('Error!', "Emergency Contact Failed!");
                }
                DB::rollBack();
                return back()->with('Error!', "Basic Registration Failed!");
            }
            DB::rollBack();
            return back()->with('Error!', "New Registration Failed!");
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('Error.Response', ['Message' => $e]);
        }
    }
}
