<?php

namespace App\Models\Permissions;

use App\Models\BasicModels\UserDesignations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OtherPermissions extends Model
{
    use HasFactory;
    protected $table = "other_permissions";
    protected $fillable = [

        'role_id',
        'Employee_view',
        'Employee_list',
        'Employee_create',
        'Employee_edit',
        'Employee_delete',
        'Employee_detail;',

        'department_view',
        'department_list',
        'department_create',
        'department_edit',
        'department_delete',

        'designation_view',
        'designation_list',
        'designation_create',
        'designation_edit',
        'designation_delete',

        'Services_view',
        'Services_list',
        'Services_create',
        'Services_edit',
        'Services_delete',

        'Website_view',
        'Website_list',
        'Website_create',
        'Website_edit',
        'Website_delete',

        'Sales_Performance_view',
        'Sales_Performance_list',
        'Sales_Performance_details',

        'Writer_Performance_view',
        'Writer_Performance_list',
        'Writer_Performance_details',

        'Skill_view',
        'Skill_list',
        'Skill_create',
        'Skill_edit',
        'Skill_delete',

        'Attendance_view',
        'Attendance_list',
        'Attendance_Update',

        'Holiday_view',
        'Holiday_list',
        'Holiday_Create',

        'payslip_view',
        'payslip_list',
        'payslip_Create',

        'leave_view',
        'leave_list',

        'my_attendance_view',
        'my_attendance_list',

        'my_Payslip_view',
        'my_Payslip_list',

        'Company_policy_view',

        'Search_order_view',

        'report_view',
        'report_list',
        'report_create',
        'report_edit',
        'report_delete'
    ];

    public function user_role(): BelongsTo
    {
        return $this->belongsTo(UserDesignations::class, 'role_id');
    }
}
