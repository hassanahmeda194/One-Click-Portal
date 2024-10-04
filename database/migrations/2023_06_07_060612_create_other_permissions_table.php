<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('other_permissions', static function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('Employee_view')->default(0);
            $table->tinyInteger('Employee_list')->default(0);
            $table->tinyInteger('Employee_create')->default(0);
            $table->tinyInteger('Employee_edit')->default(0);
            $table->tinyInteger('Employee_delete')->default(0);
            $table->tinyInteger('Employee_detail')->default(0);

            $table->tinyInteger('department_view')->default(0);
            $table->tinyInteger('department_list')->default(0);
            $table->tinyInteger('department_create')->default(0);
            $table->tinyInteger('department_edit')->default(0);
            $table->tinyInteger('department_delete')->default(0);

            $table->tinyInteger('designation_view')->default(0);
            $table->tinyInteger('designation_list')->default(0);
            $table->tinyInteger('designation_create')->default(0);
            $table->tinyInteger('designation_edit')->default(0);
            $table->tinyInteger('designation_delete')->default(0);

            $table->tinyInteger('Services_view')->default(0);
            $table->tinyInteger('Services_list')->default(0);
            $table->tinyInteger('Services_create')->default(0);
            $table->tinyInteger('Services_edit')->default(0);
            $table->tinyInteger('Services_delete')->default(0);

            $table->tinyInteger('Website_view')->default(0);
            $table->tinyInteger('Website_list')->default(0);
            $table->tinyInteger('Website_create')->default(0);
            $table->tinyInteger('Website_edit')->default(0);
            $table->tinyInteger('Website_delete')->default(0);

            $table->tinyInteger('Sales_Performance_view')->default(0);
            $table->tinyInteger('Sales_Performance_list')->default(0);
            $table->tinyInteger('Sales_Performance_details')->default(0);

            $table->tinyInteger('Writer_Performance_view')->default(0);
            $table->tinyInteger('Writer_Performance_list')->default(0);
            $table->tinyInteger('Writer_Performance_details')->default(0);

            $table->tinyInteger('Skill_view')->default(0);
            $table->tinyInteger('Skill_list')->default(0);
            $table->tinyInteger('Skill_create')->default(0);
            $table->tinyInteger('Skill_edit')->default(0);
            $table->tinyInteger('Skill_delete')->default(0);

            $table->tinyInteger('Attendance_view')->default(0);
            $table->tinyInteger('Attendance_list')->default(0);
            $table->tinyInteger('Attendance_Update')->default(0);

            $table->tinyInteger('Holiday_view')->default(0);
            $table->tinyInteger('Holiday_list')->default(0);
            $table->tinyInteger('Holiday_Create')->default(0);

            $table->tinyInteger('payslip_view')->default(0);
            $table->tinyInteger('payslip_list')->default(0);
            $table->tinyInteger('payslip_Create')->default(0);

            $table->tinyInteger('leave_view')->default(0);
            $table->tinyInteger('leave_list')->default(0);

            $table->tinyInteger('my_attendance_view')->default(0);
            $table->tinyInteger('my_attendance_list')->default(0);

            $table->tinyInteger('my_Payslip_view')->default(0);
            $table->tinyInteger('my_Payslip_list')->default(0);


            $table->tinyInteger('Company_policy_view')->default(0);

            $table->tinyInteger('Search_order_view')->default(0);

            $table->tinyInteger('report_view')->default(0);
            $table->tinyInteger('report_list')->default(0);
            $table->tinyInteger('report_create')->default(0);
            $table->tinyInteger('report_edit')->default(0);
            $table->tinyInteger('report_delete')->default(0);

            $table->bigInteger('role_id')->unsigned();
            $table->timestamps();
            $table->foreign('role_id')->references('id')->on('user_designations')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('other_permissions');
    }
};
