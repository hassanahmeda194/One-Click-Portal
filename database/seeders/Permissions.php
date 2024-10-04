<?php

namespace Database\Seeders;

use App\Models\Permissions\ModulePermissions;
use App\Models\Permissions\OtherPermissions;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class Permissions extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        ModulePermissions::insert([
            [
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'role_id' => 1,
                'Research_view' => 1,
                'Research_list' => 1,
                'Research_create' => 1,
                'Research_edit' => 1,
                'Research_delete' => 1,
                'Research_detail' => 1,

                'Content_view' => 1,
                'Content_list' => 1,
                'Content_create' => 1,
                'Content_edit' => 1,
                'Content_delete' => 1,
                'Content_detail' => 1,

                'Website_view' => 1,
                'Website_list' => 1,
                'Website_create' => 1,
                'Website_edit' => 1,
                'Website_delete' => 1,
                'Website_detail' => 1,

                'home_Order_view' => 1,
                'home_Order_list' => 1,
                'home_Order_create' => 1,
                'home_Order_update' => 1,
                'home_Order_delete' => 1,
                'Confirmation_view' => 1,
                'Confirmation_list' => 1,
                'Confirmation_create' => 1,
                'Confirmation_update' => 1,
                'Confirmation_delete' => 1,
                'deadline_view' => 1,
                'deadline_list' => 1,
                'deadline_create' => 1,
                'deadline_update' => 1,
                'deadline_delete' => 1

            ],[
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'role_id' => 4,

                'Research_view' => 1,
                'Research_list' => 1,
                'Research_create' => 0,
                'Research_edit' => 0,
                'Research_delete' => 0,
                'Research_detail' => 1,


                'Content_view' => 0,
                'Content_list' => 0,
                'Content_create' => 0,
                'Content_edit' => 0,
                'Content_delete' => 0,
                'Content_detail' => 0,

                'Website_view' => 0,
                'Website_list' => 0,
                'Website_create' => 0,
                'Website_edit' => 0,
                'Website_delete' => 0,
                'Website_detail' => 0,

                'home_Order_view' => 0,
                'home_Order_list' => 0,
                'home_Order_create' => 0,
                'home_Order_update' => 0,
                'home_Order_delete' => 0,

                'Confirmation_view' => 0,
                'Confirmation_list' => 0,
                'Confirmation_create' => 0,
                'Confirmation_update' => 0,
                'Confirmation_delete' => 0,
                'deadline_view' => 0,
                'deadline_list' => 0,
                'deadline_create' => 0,
                'deadline_update' => 0,
                'deadline_delete' => 0
            ],
            [
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'role_id' => 5,
                'Research_view' => 1,
                'Research_list' => 1,
                'Research_create' => 0,
                'Research_edit' => 0,
                'Research_delete' => 0,
                'Research_detail' => 1,

                'Content_view' => 0,
                'Content_list' => 0,
                'Content_create' => 0,
                'Content_edit' => 0,
                'Content_delete' => 0,
                'Content_detail' => 0,

                'Website_view' => 0,
                'Website_list' => 0,
                'Website_create' => 0,
                'Website_edit' => 0,
                'Website_delete' => 0,
                'Website_detail' => 0,

                'home_Order_view' => 0,
                'home_Order_list' => 0,
                'home_Order_create' => 0,
                'home_Order_update' => 0,
                'home_Order_delete' => 0,
                'Confirmation_view' => 0,
                'Confirmation_list' => 0,
                'Confirmation_create' => 0,
                'Confirmation_update' => 0,
                'Confirmation_delete' => 0,
                'deadline_view' => 0,
                'deadline_list' => 0,
                'deadline_create' => 0,
                'deadline_update' => 0,
                'deadline_delete' => 0
            ],
            [
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'role_id' => 6,
                'Research_view' => 1,
                'Research_list' => 1,
                'Research_create' => 0,
                'Research_edit' => 0,
                'Research_delete' => 0,
                'Research_detail' => 1,

                'Content_view' => 0,
                'Content_list' => 0,
                'Content_create' => 0,
                'Content_edit' => 0,
                'Content_delete' => 0,
                'Content_detail' => 1,

                'Website_view' => 0,
                'Website_list' => 0,
                'Website_create' => 0,
                'Website_edit' => 0,
                'Website_delete' => 0,
                'Website_detail' => 0,

                'home_Order_view' => 0,
                'home_Order_list' => 0,
                'home_Order_create' => 0,
                'home_Order_update' => 0,
                'home_Order_delete' => 0,
                'Confirmation_view' => 0,
                'Confirmation_list' => 0,
                'Confirmation_create' => 0,
                'Confirmation_update' => 0,
                'Confirmation_delete' => 0,
                'deadline_view' => 0,
                'deadline_list' => 0,
                'deadline_create' => 0,
                'deadline_update' => 0,
                'deadline_delete' => 0
            ],
            [
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'role_id' => 7,
                'Research_view' => 1,
                'Research_list' => 1,
                'Research_create' => 0,
                'Research_edit' => 0,
                'Research_delete' => 0,
                'Research_detail' => 1,

                'Content_view' => 0,
                'Content_list' => 0,
                'Content_create' => 0,
                'Content_edit' => 0,
                'Content_delete' => 0,
                'Content_detail' => 0,

                'Website_view' => 0,
                'Website_list' => 0,
                'Website_create' => 0,
                'Website_edit' => 0,
                'Website_delete' => 0,
                'Website_detail' => 0,

                'home_Order_view' => 0,
                'home_Order_list' => 0,
                'home_Order_create' => 0,
                'home_Order_update' => 0,
                'home_Order_delete' => 0,
                'Confirmation_view' => 0,
                'Confirmation_list' => 0,
                'Confirmation_create' => 0,
                'Confirmation_update' => 0,
                'Confirmation_delete' => 0,
                'deadline_view' => 0,
                'deadline_list' => 0,
                'deadline_create' => 0,
                'deadline_update' => 0,
                'deadline_delete' => 0
            ],
            [
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'role_id' => 7,
                'Research_view' => 1,
                'Research_list' => 1,
                'Research_create' => 0,
                'Research_edit' => 0,
                'Research_delete' => 0,
                'Research_detail' => 1,

                'Content_view' => 0,
                'Content_list' => 0,
                'Content_create' => 0,
                'Content_edit' => 0,
                'Content_delete' => 0,
                'Content_detail' => 1,


                'Website_view' => 0,
                'Website_list' => 0,
                'Website_create' => 0,
                'Website_edit' => 0,
                'Website_delete' => 0,
                'Website_detail' => 0,

                'home_Order_view' => 0,
                'home_Order_list' => 0,
                'home_Order_create' => 0,
                'home_Order_update' => 0,
                'home_Order_delete' => 0,
                'Confirmation_view' => 0,
                'Confirmation_list' => 0,
                'Confirmation_create' => 0,
                'Confirmation_update' => 0,
                'Confirmation_delete' => 0,
                'deadline_view' => 0,
                'deadline_list' => 0,
                'deadline_create' => 0,
                'deadline_update' => 0,
                'deadline_delete' => 0
            ],
            [
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'role_id' => 9,
                'Research_view' => 1,
                'Research_list' => 1,
                'Research_create' => 1,
                'Research_edit' => 1,
                'Research_delete' => 1,
                'Research_detail' => 1,

                'Content_view' => 1,
                'Content_list' => 1,
                'Content_create' => 1,
                'Content_edit' => 1,
                'Content_delete' => 1,
                'Content_detail' => 1,

                'Website_view' => 1,
                'Website_list' => 1,
                'Website_create' => 1,
                'Website_edit' => 1,
                'Website_delete' => 1,
                'Website_detail' => 1,

                'home_Order_view' => 1,
                'home_Order_list' => 1,
                'home_Order_create' => 1,
                'home_Order_update' => 1,
                'home_Order_delete' => 1,
                'Confirmation_view' => 1,
                'Confirmation_list' => 1,
                'Confirmation_create' => 1,
                'Confirmation_update' => 1,
                'Confirmation_delete' => 1,
                'deadline_view' => 1,
                'deadline_list' => 1,
                'deadline_create' => 1,
                'deadline_update' => 1,
                'deadline_delete' => 1
            ],
            [
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'role_id' => 10,
                'Research_view' => 1,
                'Research_list' => 1,
                'Research_create' => 1,
                'Research_edit' => 1,
                'Research_delete' => 1,
                'Research_detail' => 1,


                'Content_view' => 1,
                'Content_list' => 1,
                'Content_create' => 1,
                'Content_edit' => 1,
                'Content_delete' => 1,
                'Content_detail' => 1,

                'Website_view' => 1,
                'Website_list' => 1,
                'Website_create' => 1,
                'Website_edit' => 1,
                'Website_delete' => 1,
                'Website_detail' => 1,

                'home_Order_view' => 1,
                'home_Order_list' => 1,
                'home_Order_create' => 1,
                'home_Order_update' => 1,
                'home_Order_delete' => 1,
                'Confirmation_view' => 1,
                'Confirmation_list' => 1,
                'Confirmation_create' => 1,
                'Confirmation_update' => 1,
                'Confirmation_delete' => 1,
                'deadline_view' => 1,
                'deadline_list' => 1,
                'deadline_create' => 1,
                'deadline_update' => 1,
                'deadline_delete' => 1
            ],
            [
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'role_id' => 10,
                'Research_view' => 1,
                'Research_list' => 1,
                'Research_create' => 1,
                'Research_edit' => 1,
                'Research_delete' => 1,
                'Research_detail' => 1,

                'Content_view' => 1,
                'Content_list' => 1,
                'Content_create' => 1,
                'Content_edit' => 1,
                'Content_delete' => 1,
                'Content_detail' => 1,

                'Website_view' => 1,
                'Website_list' => 1,
                'Website_create' => 1,
                'Website_edit' => 1,
                'Website_delete' => 1,
                'Website_detail' => 1,

                'home_Order_view' => 1,
                'home_Order_list' => 1,
                'home_Order_create' => 1,
                'home_Order_update' => 1,
                'home_Order_delete' => 1,
                'Confirmation_view' => 1,
                'Confirmation_list' => 1,
                'Confirmation_create' => 1,
                'Confirmation_update' => 1,
                'Confirmation_delete' => 1,
                'deadline_view' => 1,
                'deadline_list' => 1,
                'deadline_create' => 1,
                'deadline_update' => 1,
                'deadline_delete' => 1
            ],
            [
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'role_id' => 11,
                'Research_view' => 1,
                'Research_list' => 1,
                'Research_create' => 1,
                'Research_edit' => 1,
                'Research_delete' => 1,
                'Research_detail' => 1,

                'Content_view' => 1,
                'Content_list' => 1,
                'Content_create' => 1,
                'Content_edit' => 1,
                'Content_delete' => 1,
                'Content_detail' => 1,

                'Website_view' => 1,
                'Website_list' => 1,
                'Website_create' => 1,
                'Website_edit' => 1,
                'Website_delete' => 1,
                'Website_detail' => 1,

                'home_Order_view' => 1,
                'home_Order_list' => 1,
                'home_Order_create' => 1,
                'home_Order_update' => 1,
                'home_Order_delete' => 1,
                'Confirmation_view' => 1,
                'Confirmation_list' => 1,
                'Confirmation_create' => 1,
                'Confirmation_update' => 1,
                'Confirmation_delete' => 1,
                'deadline_view' => 1,
                'deadline_list' => 1,
                'deadline_create' => 1,
                'deadline_update' => 1,
                'deadline_delete' => 1
            ],
            [
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'role_id' => 2,
                'Research_view' => 0,
                'Research_list' => 0,
                'Research_create' => 0,
                'Research_edit' => 0,
                'Research_delete' => 0,
                'Research_detail' => 0,

                'Content_view' => 0,
                'Content_list' => 0,
                'Content_create' => 0,
                'Content_edit' => 0,
                'Content_delete' => 0,
                'Content_detail' => 0,

                'Website_view' => 0,
                'Website_list' => 0,
                'Website_create' => 0,
                'Website_edit' => 0,
                'Website_delete' => 0,
                'Website_detail' => 0,

                'home_Order_view' => 0,
                'home_Order_list' => 0,
                'home_Order_create' => 0,
                'home_Order_update' => 0,
                'home_Order_delete' => 0,
                'Confirmation_view' => 0,
                'Confirmation_list' => 0,
                'Confirmation_create' => 0,
                'Confirmation_update' => 0,
                'Confirmation_delete' => 0,
                'deadline_view' => 0,
                'deadline_list' => 0,
                'deadline_create' => 0,
                'deadline_update' => 0,
                'deadline_delete' => 0
            ],
            [
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'role_id' => 3,
                'Research_view' => 0,
                'Research_list' => 0,
                'Research_create' => 0,
                'Research_edit' => 0,
                'Research_delete' => 0,
                'Research_detail' => 0,


                'Content_view' => 0,
                'Content_list' => 0,
                'Content_create' => 0,
                'Content_edit' => 0,
                'Content_delete' => 0,
                'Content_detail' => 0,

                'Website_view' => 1,
                'Website_list' => 1,
                'Website_create' => 0,
                'Website_edit' => 0,
                'Website_delete' => 0,
                'Website_detail' => 0,

                'home_Order_view' => 0,
                'home_Order_list' => 0,
                'home_Order_create' => 0,
                'home_Order_update' => 0,
                'home_Order_delete' => 0,
                'Confirmation_view' => 0,
                'Confirmation_list' => 0,
                'Confirmation_create' => 0,
                'Confirmation_update' => 0,
                'Confirmation_delete' => 0,
                'deadline_view' => 0,
                'deadline_list' => 0,
                'deadline_create' => 0,
                'deadline_update' => 0,
                'deadline_delete' => 0
            ],




        ]);

        OtherPermissions::insert([
            [
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'role_id' => 1 ,
                'Employee_view' => 1 ,
                'Employee_list' => 1 ,
                'Employee_create' => 1 ,
                'Employee_edit' => 1 ,
                'Employee_delete' => 1 ,
                'Employee_detail' => 1 ,

                'department_view' => 1 ,
                'department_list' => 1 ,
                'department_create' => 1 ,
                'department_edit' => 1 ,
                'department_delete' => 1 ,

                'designation_view' => 1 ,
                'designation_list' => 1 ,
                'designation_create' => 1 ,
                'designation_edit' => 1 ,
                'designation_delete' => 1 ,

                'Services_view' => 1 ,
                'Services_list' => 1 ,
                'Services_create' => 1 ,
                'Services_edit' => 1 ,
                'Services_delete' => 1 ,

                'Website_view' => 1 ,
                'Website_list' => 1 ,
                'Website_create' => 1 ,
                'Website_edit' => 1 ,
                'Website_delete' => 1 ,

                'Sales_Performance_view' => 1 ,
                'Sales_Performance_list' => 1 ,
                'Sales_Performance_details' => 1 ,

                'Writer_Performance_view' => 1 ,
                'Writer_Performance_list' => 1 ,
                'Writer_Performance_details' => 1 ,

                'Skill_view' => 1 ,
                'Skill_list' => 1 ,
                'Skill_create' => 1 ,
                'Skill_edit' => 1 ,
                'Skill_delete' => 1 ,

                'Attendance_view' => 1 ,
                'Attendance_list' => 1 ,
                'Attendance_Update' => 1 ,

                'Holiday_view' => 1 ,
                'Holiday_list' => 1 ,
                'Holiday_Create' => 1 ,

                'payslip_view' => 1 ,
                'payslip_list' => 1 ,
                'payslip_Create' => 1 ,

                'leave_view' => 1 ,
                'leave_list' => 1 ,

                'my_attendance_view' => 1 ,
                'my_attendance_list' => 1 ,

                'my_Payslip_view' => 1 ,
                'my_Payslip_list' => 1 ,

                'Company_policy_view' => 1 ,

                'Search_order_view' => 1 ,

                'report_view' => 1 ,
                'report_list' => 1 ,
                'report_create' => 1 ,
                'report_edit' => 1 ,
                'report_delete' => 1
            ],
            [
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'role_id' => 2 ,
                'Employee_view' => 1 ,
                'Employee_list' => 1 ,
                'Employee_create' => 1 ,
                'Employee_edit' => 1 ,
                'Employee_delete' => 1 ,
                'Employee_detail' => 1 ,

                'department_view' => 1 ,
                'department_list' => 1 ,
                'department_create' => 1 ,
                'department_edit' => 1 ,
                'department_delete' => 1 ,

                'designation_view' => 1 ,
                'designation_list' => 1 ,
                'designation_create' => 1 ,
                'designation_edit' => 1 ,
                'designation_delete' => 1 ,

                'Services_view' => 1 ,
                'Services_list' => 1 ,
                'Services_create' => 1 ,
                'Services_edit' => 1 ,
                'Services_delete' => 1 ,

                'Website_view' => 1 ,
                'Website_list' => 1 ,
                'Website_create' => 1 ,
                'Website_edit' => 1 ,
                'Website_delete' => 1 ,

                'Sales_Performance_view' => 1 ,
                'Sales_Performance_list' => 1 ,
                'Sales_Performance_details' => 1 ,

                'Writer_Performance_view' => 1 ,
                'Writer_Performance_list' => 1 ,
                'Writer_Performance_details' => 1 ,

                'Skill_view' => 1 ,
                'Skill_list' => 1 ,
                'Skill_create' => 1 ,
                'Skill_edit' => 1 ,
                'Skill_delete' => 1 ,

                'Attendance_view' => 1 ,
                'Attendance_list' => 1 ,
                'Attendance_Update' => 1 ,

                'Holiday_view' => 1 ,
                'Holiday_list' => 1 ,
                'Holiday_Create' => 1 ,

                'payslip_view' => 1 ,
                'payslip_list' => 1 ,
                'payslip_Create' => 1 ,

                'leave_view' => 1 ,
                'leave_list' => 1 ,

                'my_attendance_view' => 1 ,
                'my_attendance_list' => 1 ,

                'my_Payslip_view' => 1 ,
                'my_Payslip_list' => 1 ,

                'Company_policy_view' => 1 ,

                'Search_order_view' => 1 ,

                'report_view' => 1 ,
                'report_list' => 1 ,
                'report_create' => 1 ,
                'report_edit' => 1 ,
                'report_delete' => 1
            ],
            [
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'role_id' => 3,
                'Employee_view' => 0,
                'Employee_list' => 0,
                'Employee_create' => 0,
                'Employee_edit' => 0,
                'Employee_delete' => 0,
                'Employee_detail' => 1 ,

                'department_view' => 0,
                'department_list' => 0,
                'department_create' => 0,
                'department_edit' => 0,
                'department_delete' => 0,

                'designation_view' => 0,
                'designation_list' => 0,
                'designation_create' => 0,
                'designation_edit' => 0,
                'designation_delete' => 0,

                'Services_view' => 0,
                'Services_list' => 0,
                'Services_create' => 0,
                'Services_edit' => 0,
                'Services_delete' => 0,

                'Website_view' => 0,
                'Website_list' => 0,
                'Website_create' => 0,
                'Website_edit' => 0,
                'Website_delete' => 0,

                'Sales_Performance_view' => 0,
                'Sales_Performance_list' => 0,
                'Sales_Performance_details' => 0,

                'Writer_Performance_view' => 0,
                'Writer_Performance_list' => 0,
                'Writer_Performance_details' => 0,

                'Skill_view' => 0,
                'Skill_list' => 0,
                'Skill_create' => 0,
                'Skill_edit' => 0,
                'Skill_delete' => 0,

                'Attendance_view' => 0,
                'Attendance_list' => 0,
                'Attendance_Update' => 0,

                'Holiday_view' => 0,
                'Holiday_list' => 0,
                'Holiday_Create' => 0,

                'payslip_view' => 0,
                'payslip_list' => 0,
                'payslip_Create' => 0,

                'leave_view' => 0,
                'leave_list' => 0,

                'my_attendance_view' => 1,
                'my_attendance_list' => 1,

                'my_Payslip_view' => 1,
                'my_Payslip_list' => 1,

                'Company_policy_view' => 1,

                'Search_order_view' => 0,

                'report_view' => 0,
                'report_list' => 0,
                'report_create' => 0,
                'report_edit' => 0,
                'report_delete' => 0
            ],
            [
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),

                'role_id' => 4,
                'Employee_view' => 0,
                'Employee_list' => 0,
                'Employee_create' => 0,
                'Employee_edit' => 0,
                'Employee_delete' => 0,
                'Employee_detail' => 1 ,

                'department_view' => 0,
                'department_list' => 0,
                'department_create' => 0,
                'department_edit' => 0,
                'department_delete' => 0,

                'designation_view' => 0,
                'designation_list' => 0,
                'designation_create' => 0,
                'designation_edit' => 0,
                'designation_delete' => 0,

                'Services_view' => 0,
                'Services_list' => 0,
                'Services_create' => 0,
                'Services_edit' => 0,
                'Services_delete' => 0,

                'Website_view' => 0,
                'Website_list' => 0,
                'Website_create' => 0,
                'Website_edit' => 0,
                'Website_delete' => 0,

                'Sales_Performance_view' => 0,
                'Sales_Performance_list' => 0,
                'Sales_Performance_details' => 0,

                'Writer_Performance_view' => 0,
                'Writer_Performance_list' => 0,
                'Writer_Performance_details' => 0,

                'Skill_view' => 0,
                'Skill_list' => 0,
                'Skill_create' => 0,
                'Skill_edit' => 0,
                'Skill_delete' => 0,

                'Attendance_view' => 0,
                'Attendance_list' => 0,
                'Attendance_Update' => 0,

                'Holiday_view' => 0,
                'Holiday_list' => 0,
                'Holiday_Create' => 0,

                'payslip_view' => 0,
                'payslip_list' => 0,
                'payslip_Create' => 0,

                'leave_view' => 0,
                'leave_list' => 0,

                'my_attendance_view' => 1,
                'my_attendance_list' => 1,

                'my_Payslip_view' => 1,
                'my_Payslip_list' => 1,

                'Company_policy_view' => 1,

                'Search_order_view' => 0,

                'report_view' => 0,
                'report_list' => 0,
                'report_create' => 0,
                'report_edit' => 0,
                'report_delete' => 0
            ],
            [
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),

                'role_id' => 4,
                'Employee_view' => 0,
                'Employee_list' => 0,
                'Employee_create' => 0,
                'Employee_edit' => 0,
                'Employee_delete' => 0,
                'Employee_detail' => 1 ,

                'department_view' => 0,
                'department_list' => 0,
                'department_create' => 0,
                'department_edit' => 0,
                'department_delete' => 0,

                'designation_view' => 0,
                'designation_list' => 0,
                'designation_create' => 0,
                'designation_edit' => 0,
                'designation_delete' => 0,

                'Services_view' => 0,
                'Services_list' => 0,
                'Services_create' => 0,
                'Services_edit' => 0,
                'Services_delete' => 0,

                'Website_view' => 0,
                'Website_list' => 0,
                'Website_create' => 0,
                'Website_edit' => 0,
                'Website_delete' => 0,

                'Sales_Performance_view' => 0,
                'Sales_Performance_list' => 0,
                'Sales_Performance_details' => 0,

                'Writer_Performance_view' => 0,
                'Writer_Performance_list' => 0,
                'Writer_Performance_details' => 0,

                'Skill_view' => 0,
                'Skill_list' => 0,
                'Skill_create' => 0,
                'Skill_edit' => 0,
                'Skill_delete' => 0,

                'Attendance_view' => 0,
                'Attendance_list' => 0,
                'Attendance_Update' => 0,

                'Holiday_view' => 0,
                'Holiday_list' => 0,
                'Holiday_Create' => 0,

                'payslip_view' => 0,
                'payslip_list' => 0,
                'payslip_Create' => 0,

                'leave_view' => 0,
                'leave_list' => 0,

                'my_attendance_view' => 1,
                'my_attendance_list' => 1,

                'my_Payslip_view' => 1,
                'my_Payslip_list' => 1,

                'Company_policy_view' => 1,

                'Search_order_view' => 0,

                'report_view' => 0,
                'report_list' => 0,
                'report_create' => 0,
                'report_edit' => 0,
                'report_delete' => 0
            ],
            [
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),

                'role_id' => 5,
                'Employee_view' => 0,
                'Employee_list' => 0,
                'Employee_create' => 0,
                'Employee_edit' => 0,
                'Employee_delete' => 0,
                'Employee_detail' => 1 ,

                'department_view' => 0,
                'department_list' => 0,
                'department_create' => 0,
                'department_edit' => 0,
                'department_delete' => 0,

                'designation_view' => 0,
                'designation_list' => 0,
                'designation_create' => 0,
                'designation_edit' => 0,
                'designation_delete' => 0,

                'Services_view' => 0,
                'Services_list' => 0,
                'Services_create' => 0,
                'Services_edit' => 0,
                'Services_delete' => 0,

                'Website_view' => 0,
                'Website_list' => 0,
                'Website_create' => 0,
                'Website_edit' => 0,
                'Website_delete' => 0,

                'Sales_Performance_view' => 0,
                'Sales_Performance_list' => 0,
                'Sales_Performance_details' => 0,

                'Writer_Performance_view' => 0,
                'Writer_Performance_list' => 0,
                'Writer_Performance_details' => 0,

                'Skill_view' => 0,
                'Skill_list' => 0,
                'Skill_create' => 0,
                'Skill_edit' => 0,
                'Skill_delete' => 0,

                'Attendance_view' => 0,
                'Attendance_list' => 0,
                'Attendance_Update' => 0,

                'Holiday_view' => 0,
                'Holiday_list' => 0,
                'Holiday_Create' => 0,

                'payslip_view' => 0,
                'payslip_list' => 0,
                'payslip_Create' => 0,

                'leave_view' => 0,
                'leave_list' => 0,

                'my_attendance_view' => 1,
                'my_attendance_list' => 1,

                'my_Payslip_view' => 1,
                'my_Payslip_list' => 1,

                'Company_policy_view' => 1,

                'Search_order_view' => 0,

                'report_view' => 0,
                'report_list' => 0,
                'report_create' => 0,
                'report_edit' => 0,
                'report_delete' => 0
            ],
            [
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),

                'role_id' => 6,
                'Employee_view' => 0,
                'Employee_list' => 0,
                'Employee_create' => 0,
                'Employee_edit' => 0,
                'Employee_delete' => 0,
                'Employee_detail' => 1 ,

                'department_view' => 0,
                'department_list' => 0,
                'department_create' => 0,
                'department_edit' => 0,
                'department_delete' => 0,

                'designation_view' => 0,
                'designation_list' => 0,
                'designation_create' => 0,
                'designation_edit' => 0,
                'designation_delete' => 0,

                'Services_view' => 0,
                'Services_list' => 0,
                'Services_create' => 0,
                'Services_edit' => 0,
                'Services_delete' => 0,

                'Website_view' => 0,
                'Website_list' => 0,
                'Website_create' => 0,
                'Website_edit' => 0,
                'Website_delete' => 0,

                'Sales_Performance_view' => 0,
                'Sales_Performance_list' => 0,
                'Sales_Performance_details' => 0,

                'Writer_Performance_view' => 0,
                'Writer_Performance_list' => 0,
                'Writer_Performance_details' => 0,

                'Skill_view' => 0,
                'Skill_list' => 0,
                'Skill_create' => 0,
                'Skill_edit' => 0,
                'Skill_delete' => 0,

                'Attendance_view' => 0,
                'Attendance_list' => 0,
                'Attendance_Update' => 0,

                'Holiday_view' => 0,
                'Holiday_list' => 0,
                'Holiday_Create' => 0,

                'payslip_view' => 0,
                'payslip_list' => 0,
                'payslip_Create' => 0,

                'leave_view' => 0,
                'leave_list' => 0,

                'my_attendance_view' => 1,
                'my_attendance_list' => 1,

                'my_Payslip_view' => 1,
                'my_Payslip_list' => 1,

                'Company_policy_view' => 1,

                'Search_order_view' => 0,

                'report_view' => 0,
                'report_list' => 0,
                'report_create' => 0,
                'report_edit' => 0,
                'report_delete' => 0
            ],
            [
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),

                'role_id' => 7,
                'Employee_view' => 0,
                'Employee_list' => 0,
                'Employee_create' => 0,
                'Employee_edit' => 0,
                'Employee_delete' => 0,
                'Employee_detail' => 1 ,

                'department_view' => 0,
                'department_list' => 0,
                'department_create' => 0,
                'department_edit' => 0,
                'department_delete' => 0,

                'designation_view' => 0,
                'designation_list' => 0,
                'designation_create' => 0,
                'designation_edit' => 0,
                'designation_delete' => 0,

                'Services_view' => 0,
                'Services_list' => 0,
                'Services_create' => 0,
                'Services_edit' => 0,
                'Services_delete' => 0,

                'Website_view' => 0,
                'Website_list' => 0,
                'Website_create' => 0,
                'Website_edit' => 0,
                'Website_delete' => 0,

                'Sales_Performance_view' => 0,
                'Sales_Performance_list' => 0,
                'Sales_Performance_details' => 0,

                'Writer_Performance_view' => 0,
                'Writer_Performance_list' => 0,
                'Writer_Performance_details' => 0,

                'Skill_view' => 0,
                'Skill_list' => 0,
                'Skill_create' => 0,
                'Skill_edit' => 0,
                'Skill_delete' => 0,

                'Attendance_view' => 0,
                'Attendance_list' => 0,
                'Attendance_Update' => 0,

                'Holiday_view' => 0,
                'Holiday_list' => 0,
                'Holiday_Create' => 0,

                'payslip_view' => 0,
                'payslip_list' => 0,
                'payslip_Create' => 0,

                'leave_view' => 0,
                'leave_list' => 0,

                'my_attendance_view' => 1,
                'my_attendance_list' => 1,

                'my_Payslip_view' => 1,
                'my_Payslip_list' => 1,

                'Company_policy_view' => 1,

                'Search_order_view' => 0,

                'report_view' => 0,
                'report_list' => 0,
                'report_create' => 0,
                'report_edit' => 0,
                'report_delete' => 0
            ],
            [
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),

                'role_id' => 8,
                'Employee_view' => 0,
                'Employee_list' => 0,
                'Employee_create' => 0,
                'Employee_edit' => 0,
                'Employee_delete' => 0,
                'Employee_detail' => 1 ,

                'department_view' => 0,
                'department_list' => 0,
                'department_create' => 0,
                'department_edit' => 0,
                'department_delete' => 0,

                'designation_view' => 0,
                'designation_list' => 0,
                'designation_create' => 0,
                'designation_edit' => 0,
                'designation_delete' => 0,

                'Services_view' => 0,
                'Services_list' => 0,
                'Services_create' => 0,
                'Services_edit' => 0,
                'Services_delete' => 0,

                'Website_view' => 0,
                'Website_list' => 0,
                'Website_create' => 0,
                'Website_edit' => 0,
                'Website_delete' => 0,

                'Sales_Performance_view' => 0,
                'Sales_Performance_list' => 0,
                'Sales_Performance_details' => 0,

                'Writer_Performance_view' => 0,
                'Writer_Performance_list' => 0,
                'Writer_Performance_details' => 0,

                'Skill_view' => 0,
                'Skill_list' => 0,
                'Skill_create' => 0,
                'Skill_edit' => 0,
                'Skill_delete' => 0,

                'Attendance_view' => 0,
                'Attendance_list' => 0,
                'Attendance_Update' => 0,

                'Holiday_view' => 0,
                'Holiday_list' => 0,
                'Holiday_Create' => 0,

                'payslip_view' => 0,
                'payslip_list' => 0,
                'payslip_Create' => 0,

                'leave_view' => 0,
                'leave_list' => 0,

                'my_attendance_view' => 1,
                'my_attendance_list' => 1,

                'my_Payslip_view' => 1,
                'my_Payslip_list' => 1,

                'Company_policy_view' => 1,

                'Search_order_view' => 0,

                'report_view' => 0,
                'report_list' => 0,
                'report_create' => 0,
                'report_edit' => 0,
                'report_delete' => 0
            ],
            [
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),

                'role_id' => 9,
                'Employee_view' => 0,
                'Employee_list' => 0,
                'Employee_create' => 0,
                'Employee_edit' => 0,
                'Employee_delete' => 0,
                'Employee_detail' => 1 ,

                'department_view' => 0,
                'department_list' => 0,
                'department_create' => 0,
                'department_edit' => 0,
                'department_delete' => 0,

                'designation_view' => 0,
                'designation_list' => 0,
                'designation_create' => 0,
                'designation_edit' => 0,
                'designation_delete' => 0,

                'Services_view' => 0,
                'Services_list' => 0,
                'Services_create' => 0,
                'Services_edit' => 0,
                'Services_delete' => 0,

                'Website_view' => 0,
                'Website_list' => 0,
                'Website_create' => 0,
                'Website_edit' => 0,
                'Website_delete' => 0,

                'Sales_Performance_view' => 0,
                'Sales_Performance_list' => 0,
                'Sales_Performance_details' => 0,

                'Writer_Performance_view' => 0,
                'Writer_Performance_list' => 0,
                'Writer_Performance_details' => 0,

                'Skill_view' => 0,
                'Skill_list' => 0,
                'Skill_create' => 0,
                'Skill_edit' => 0,
                'Skill_delete' => 0,

                'Attendance_view' => 0,
                'Attendance_list' => 0,
                'Attendance_Update' => 0,

                'Holiday_view' => 0,
                'Holiday_list' => 0,
                'Holiday_Create' => 0,

                'payslip_view' => 0,
                'payslip_list' => 0,
                'payslip_Create' => 0,

                'leave_view' => 0,
                'leave_list' => 0,

                'my_attendance_view' => 1,
                'my_attendance_list' => 1,

                'my_Payslip_view' => 1,
                'my_Payslip_list' => 1,

                'Company_policy_view' => 1,

                'Search_order_view' => 1,

                'report_view' => 0,
                'report_list' => 0,
                'report_create' => 0,
                'report_edit' => 0,
                'report_delete' => 0
            ],
            [
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),

                'role_id' => 10,
                'Employee_view' => 0,
                'Employee_list' => 0,
                'Employee_create' => 0,
                'Employee_edit' => 0,
                'Employee_delete' => 0,
                'Employee_detail' => 1 ,

                'department_view' => 0,
                'department_list' => 0,
                'department_create' => 0,
                'department_edit' => 0,
                'department_delete' => 0,

                'designation_view' => 0,
                'designation_list' => 0,
                'designation_create' => 0,
                'designation_edit' => 0,
                'designation_delete' => 0,

                'Services_view' => 0,
                'Services_list' => 0,
                'Services_create' => 0,
                'Services_edit' => 0,
                'Services_delete' => 0,

                'Website_view' => 0,
                'Website_list' => 0,
                'Website_create' => 0,
                'Website_edit' => 0,
                'Website_delete' => 0,

                'Sales_Performance_view' => 0,
                'Sales_Performance_list' => 0,
                'Sales_Performance_details' => 0,

                'Writer_Performance_view' => 0,
                'Writer_Performance_list' => 0,
                'Writer_Performance_details' => 0,

                'Skill_view' => 0,
                'Skill_list' => 0,
                'Skill_create' => 0,
                'Skill_edit' => 0,
                'Skill_delete' => 0,

                'Attendance_view' => 0,
                'Attendance_list' => 0,
                'Attendance_Update' => 0,

                'Holiday_view' => 0,
                'Holiday_list' => 0,
                'Holiday_Create' => 0,

                'payslip_view' => 0,
                'payslip_list' => 0,
                'payslip_Create' => 0,

                'leave_view' => 0,
                'leave_list' => 0,

                'my_attendance_view' => 1,
                'my_attendance_list' => 1,

                'my_Payslip_view' => 1,
                'my_Payslip_list' => 1,

                'Company_policy_view' => 1,

                'Search_order_view' => 1,

                'report_view' => 0,
                'report_list' => 0,
                'report_create' => 0,
                'report_edit' => 0,
                'report_delete' => 0
            ],
            [
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),

                'role_id' => 11,
                'Employee_view' => 0,
                'Employee_list' => 0,
                'Employee_create' => 0,
                'Employee_edit' => 0,
                'Employee_delete' => 0,
                'Employee_detail' => 1 ,

                'department_view' => 0,
                'department_list' => 0,
                'department_create' => 0,
                'department_edit' => 0,
                'department_delete' => 0,

                'designation_view' => 0,
                'designation_list' => 0,
                'designation_create' => 0,
                'designation_edit' => 0,
                'designation_delete' => 0,

                'Services_view' => 0,
                'Services_list' => 0,
                'Services_create' => 0,
                'Services_edit' => 0,
                'Services_delete' => 0,

                'Website_view' => 0,
                'Website_list' => 0,
                'Website_create' => 0,
                'Website_edit' => 0,
                'Website_delete' => 0,

                'Sales_Performance_view' => 0,
                'Sales_Performance_list' => 0,
                'Sales_Performance_details' => 0,

                'Writer_Performance_view' => 0,
                'Writer_Performance_list' => 0,
                'Writer_Performance_details' => 0,

                'Skill_view' => 0,
                'Skill_list' => 0,
                'Skill_create' => 0,
                'Skill_edit' => 0,
                'Skill_delete' => 0,

                'Attendance_view' => 0,
                'Attendance_list' => 0,
                'Attendance_Update' => 0,

                'Holiday_view' => 0,
                'Holiday_list' => 0,
                'Holiday_Create' => 0,

                'payslip_view' => 0,
                'payslip_list' => 0,
                'payslip_Create' => 0,

                'leave_view' => 0,
                'leave_list' => 0,

                'my_attendance_view' => 1,
                'my_attendance_list' => 1,

                'my_Payslip_view' => 1,
                'my_Payslip_list' => 1,

                'Company_policy_view' => 1,

                'Search_order_view' => 0,

                'report_view' => 0,
                'report_list' => 0,
                'report_create' => 0,
                'report_edit' => 0,
                'report_delete' => 0
            ],


        ]);
    }
}
