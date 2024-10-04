<?php

namespace App\Services;

use App\Models\Permissions\ModulePermissions;
use App\Models\Permissions\OtherPermissions;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RuntimeException;

class CreateUpdatePortalPermissions
{
    public function updatePortalPermission(Request $request): RedirectResponse
    {
        try {
            DB::beginTransaction();
            $modulePermissions = $this->getModulePermissions($request);
            $otherPermission = $this->getSubModulePermissions($request);
            $Role_ID = (int)$request->role;

            $Order_permission = ModulePermissions::where('role_id', $Role_ID)->update($modulePermissions);
            if ($Order_permission) {
                $Other_permission = OtherPermissions::where('role_id', $Role_ID)->update($otherPermission);
                if ($Other_permission) {
                    DB::commit();
                    return back()->with('Success!', 'Permissions are Updated For Current Role!');
                }
                throw new RuntimeException('Other Permissions Failed to Update!');
            }
            throw new RuntimeException('Module Permissions Failed to Update!');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('Error.Response', ['Message' => $e]);
        }
    }

    public function submitPortalPermissions(Request $request): RedirectResponse
    {
        try {
            DB::beginTransaction();
            $modulePermissions = $this->getModulePermissions($request);
            $otherPermission = $this->getSubModulePermissions($request);

            $Order_permission = ModulePermissions::create($modulePermissions);
            if ($Order_permission) {
                $Other_permission = OtherPermissions::create($otherPermission);
                if ($Other_permission) {
                    DB::commit();
                    return back()->with('Success!', 'Permissions Are Submitted Successfully!');
                }
                throw new RuntimeException('Other Permissions Failed to Submit!');
            }
            throw new RuntimeException('Module Permissions Failed to Submit!');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('Error.Response', ['Message' => $e]);
        }
    }


    private function getModulePermissions(Request $request): array
    {
        return [
            'Research_view' => ($request->research_list === '1' || $request->research_create === '1' || $request->research_update === '1' || $request->research_delete === '1') ? 1 : 0,
            'Research_list' => (int) $request->research_list,
            'Research_create' => (int) $request->research_create,
            'Research_edit' => (int) $request->research_update,
            'Research_delete' => (int) $request->research_delete,
            'Research_detail' => (int) $request->research_detail,

            'Content_view' => ($request->Content_list === '1' || $request->Content_create === '1' || $request->Content_update === '1' || $request->Content_delete === '1') ? 1 : 0,
            'Content_list' => (int) $request->Content_list,
            'Content_create' => (int) $request->Content_create,
            'Content_edit' => (int) $request->Content_update,
            'Content_delete' => (int) $request->Content_delete,
            'Content_detail' => (int) $request->Content_detail,


            'Website_view' => ($request->Website_list === '1' || $request->Website_create === '1' || $request->Website_update === '1' || $request->Website_delete === '1') ? 1 : 0,
            'Website_list' => (int) $request->Website_list,
            'Website_create' => (int) $request->Website_create,
            'Website_edit' => (int) $request->Website_update,
            'Website_delete' => (int) $request->Website_delete,
            'Website_detail' => (int) $request->Website_detail,

            'home_Order_view' => ($request->home_order_list === '1' || $request->home_order_create === '1' || $request->home_order_update === '1' || $request->home_order_delete === '1') ? 1 : 0,
            'home_Order_list' => (int) $request->home_order_list,
            'home_Order_create' => (int) $request->home_order_create,
            'home_Order_update' => (int) $request->home_order_update,
            'home_Order_delete' => (int) $request->home_order_delete,
            'Confirmation_view' => ($request->confirmation_list === '1' || $request->confirmation_create === '1' || $request->confirmation_update === '1' || $request->confirmation_delete === '1') ? 1 : 0,
            'Confirmation_list' => (int) $request->confirmation_list,
            'Confirmation_create' => (int) $request->confirmation_create,
            'Confirmation_update' => (int) $request->confirmation_update,
            'Confirmation_delete' => (int) $request->confirmation_delete,
            'deadline_view' => ($request->deadline_list === '1' || $request->deadline_create === '1' || $request->deadline_update === '1' || $request->deadline_delete === '1') ? 1 : 0,
            'deadline_list' => (int) $request->deadline_list,
            'deadline_create' => (int) $request->deadline_create,
            'deadline_update' => (int) $request->deadline_update,
            'deadline_delete' => (int) $request->deadline_delete,
            'role_id' => (int) $request->role
        ];
    }

    private function getSubModulePermissions(Request $request): array
    {
        return [
            'Employee_view' => ($request->employee_list === '1' || $request->employee_create === '1' || $request->employee_update === '1' || $request->employee_delete === '1') ? 1 : 0,
            'Employee_list' => (int) $request->employee_list,
            'Employee_create' => (int) $request->employee_create,
            'Employee_edit' => (int) $request->employee_update,
            'Employee_delete' => (int) $request->employee_delete,
            'Employee_detail' => (int) $request->employee_detail,

            'department_view' => ($request->department_list === '1' || $request->department_create === '1' || $request->department_update === '1' || $request->department_delete === '1') ? 1 : 0,
            'department_list' => (int) $request->department_list,
            'department_create' => (int) $request->department_create,
            'department_edit' => (int) $request->department_update,
            'department_delete' => (int) $request->department_delete,

            'designation_view' => ($request->designation_list === '1' || $request->designation_create === '1' || $request->designation_update === '1' || $request->designation_delete === '1') ? 1 : 0,
            'designation_list' => (int) $request->designation_list,
            'designation_create' => (int) $request->designation_create,
            'designation_edit' => (int) $request->designation_update,
            'designation_delete' => (int) $request->designation_delete,

            'Services_view' => ($request->service_list === '1' || $request->service_create === '1' || $request->service_update === '1' || $request->service_delete === '1') ? 1 : 0,
            'Services_list' => (int) $request->service_list,
            'Services_create' => (int) $request->service_create,
            'Services_edit' => (int) $request->service_update,
            'Services_delete' => (int) $request->service_delete,

            'Website_view' => ($request->Website_list === '1' || $request->Website_create === '1' || $request->Website_update === '1' || $request->Website_delete === '1') ? 1 : 0,
            'Website_list' => (int) $request->Website_list,
            'Website_create' => (int) $request->Website_create,
            'Website_edit' => (int) $request->Website_update,
            'Website_delete' => (int) $request->Website_delete,

            'Sales_Performance_view' => ($request->sales_performance_list === '1' || $request->sales_performance_detail === '1') ? 1 : 0,
            'Sales_Performance_list' => (int) $request->sales_performance_list,
            'Sales_Performance_details' => (int) $request->sales_performance_detail,

            'Writer_Performance_view' => ($request->Writer_performance_list === '1' || $request->Writer_performance_detail === '1') ? 1 : 0,
            'Writer_Performance_list' => (int) $request->Writer_performance_list,
            'Writer_Performance_details' => (int) $request->Writer_performance_detail,

            'Skill_view' => ($request->skills_list === '1' || $request->skills_create === '1' || $request->skills_update === '1' || $request->skills_delete === '1') ? 1 : 0,
            'Skill_list' => (int) $request->skills_list,
            'Skill_create' => (int) $request->skills_create,
            'Skill_edit' => (int) $request->skills_update,
            'Skill_delete' => (int) $request->skills_delete,

            'Attendance_view' => ($request->attendance_list === '1' || $request->attendence_Update === '1') ? 1 : 0,
            'Attendance_list' => (int) $request->attendance_list,
            'Attendance_Update' => (int) $request->attendance_update,

            'Holiday_view' => ($request->holiday_list === '1' || $request->holiday_create === '1') ? 1 : 0,
            'Holiday_list' => (int) $request->holiday_list,
            'Holiday_Create' => (int) $request->holiday_create,
            'payslip_view' => ($request->payslip_list === '1' || $request->payslip_create === '1') ? 1 : 0,
            'payslip_list' => (int) $request->payslip_list,
            'payslip_Create' => (int) $request->payslip_create,
            'leave_view' => ($request->leave_list === '1') ? 1 : 0,
            'leave_list' => (int) $request->leave_list,

            'my_attendance_view' => ($request->my_attendance_list === '1') ? 1 : 0,
            'my_attendance_list' => (int) $request->my_attendance_list,

            'my_Payslip_view' => ($request->my_payslip_list === '1') ? 1 : 0,
            'my_Payslip_list' => (int) $request->my_payslip_list,
            'Company_policy_view' => ($request->company_policy_list === '1') ? 1 : 0,
            'Search_order_view' => ($request->search_order_list === '1') ? 1 : 0,
            'report_view' => ($request->report_list === '1' || $request->report_create === '1' || $request->report_update === '1' || $request->report_delete === '1') ? 1 : 0,
            'report_list' => (int) $request->report_list,
            'report_create' => (int) $request->report_create,
            'report_edit' => (int) $request->report_update,
            'report_delete' => (int) $request->report_delete,
            'role_id' => (int) $request->role
        ];
    }
}
