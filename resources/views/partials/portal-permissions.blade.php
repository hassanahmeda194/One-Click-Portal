<div class="mb-4">
    <input type="hidden" name="role_id" value="{{ $role_id }}"/>
    <div class="table-responsive">
        <table class="table table-bordered border-top text-nowrap mb-0 client-perm-table">
            <thead>
            <tr>
                <th>Module Permissions</th>
                <th class="text-center">View</th>
                <th class="text-center">Create</th>
                <th class="text-center">Update</th>
                <th class="text-center">Delete</th>
                <th class="text-center">Details</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="font-weight-semibold">
                    Research Order
                    <input type="hidden" id="hiddenCheckbox" name="research_view"/>
                </td>
                <td class="text-center">
                    <label class="custom-control custom-checkbox success">
                        <input type="checkbox" id="checkbox1" name="research_list"
                               class="custom-control-input" {{ PortalHelpers::checkValue($module_permission->Research_list) }} value="1">
                        <span class="custom-control-label"></span>
                    </label>
                </td>
                <td class="text-center">
                    <label class="custom-control custom-checkbox success">
                        <input type="checkbox" id="checkbox2" name="research_create"
                               class="custom-control-input" {{ PortalHelpers::checkValue($module_permission->Research_create) }} value="1">
                        <span class="custom-control-label"></span>
                    </label>
                </td>
                <td class="text-center">
                    <label class="custom-control custom-checkbox success">
                        <input type="checkbox" id="checkbox3" name="research_update"
                               class="custom-control-input" {{ PortalHelpers::checkValue($module_permission->Research_edit) }} value="1">
                        <span class="custom-control-label"></span>
                    </label>
                </td>
                <td class="text-center">
                    <label class="custom-control custom-checkbox success">
                        <input type="checkbox" id="checkbox4" name="research_delete"
                               class="custom-control-input" {{ PortalHelpers::checkValue($module_permission->Research_delete) }} value="1">
                        <span class="custom-control-label"></span>
                    </label>
                </td>
                <td class="text-center">
                    <label class="custom-control custom-checkbox success">
                        <input type="checkbox" id="checkbox4" name="research_detail"
                               class="custom-control-input" {{ PortalHelpers::checkValue($module_permission->Research_detail) }} value="1">
                        <span class="custom-control-label"></span>
                    </label>
                </td>
            </tr>
            <tr>
                <td class="font-weight-semibold">
                    Content Writing
                    <input type="hidden" id="Content_hidden" name="Content_view"/>
                </td>
                <td class="text-center">
                    <label class="custom-control custom-checkbox success">
                        <input type="checkbox" id="Content_list" class="custom-control-input"
                               name="Content_list" {{ PortalHelpers::checkValue($module_permission->Content_list) }} value="1">
                        <span class="custom-control-label"></span>
                    </label>
                </td>
                <td class="text-center">
                    <label class="custom-control custom-checkbox success">
                        <input type="checkbox" id="Content_create" class="custom-control-input"
                               name="Content_create" {{ PortalHelpers::checkValue($module_permission->Content_create) }} value="1">
                        <span class="custom-control-label"></span>
                    </label>
                </td>
                <td class="text-center">
                    <label class="custom-control custom-checkbox success">
                        <input type="checkbox" id="Content_update" class="custom-control-input"
                               name="Content_update" {{ PortalHelpers::checkValue($module_permission->Content_edit) }} value="1">
                        <span class="custom-control-label"></span>
                    </label>
                </td>
                <td class="text-center">
                    <label class="custom-control custom-checkbox success">
                        <input type="checkbox" id="Content_delete" class="custom-control-input"
                               name="Content_delete" {{ PortalHelpers::checkValue($module_permission->Content_delete) }} value="1"
                        >
                        <span class="custom-control-label"></span>
                    </label>
                </td>
                <td class="text-center">
                    <label class="custom-control custom-checkbox success">
                        <input type="checkbox" id="Content_delete" class="custom-control-input"
                               name="Content_detail" {{ PortalHelpers::checkValue($module_permission->Content_detail) }} value="1"
                        >
                        <span class="custom-control-label"></span>
                    </label>
                </td>

            </tr>
            <tr>
                <td class="font-weight-semibold">
                    Website Order
                    <input type="hidden" id="Website_hidden" name="Website_view"/>
                </td>
                <td class="text-center">
                    <label class="custom-control custom-checkbox success">
                        <input type="checkbox" class="custom-control-input"
                               name="Website_list" {{ PortalHelpers::checkValue($module_permission->Website_list) }} value="1">
                        <span class="custom-control-label"></span>
                    </label>
                </td>
                <td class="text-center">
                    <label class="custom-control custom-checkbox success">
                        <input type="checkbox" class="custom-control-input"
                               name="Website_create" {{ PortalHelpers::checkValue($module_permission->Website_create) }} value="1">
                        <span class="custom-control-label"></span>
                    </label>
                </td>
                <td class="text-center">
                    <label class="custom-control custom-checkbox success">
                        <input type="checkbox" class="custom-control-input"
                               name="Website_update" {{ PortalHelpers::checkValue($module_permission->Website_edit) }} value="1">
                        <span class="custom-control-label"></span>
                    </label>
                </td>
                <td class="text-center">
                    <label class="custom-control custom-checkbox success">
                        <input type="checkbox" class="custom-control-input"
                               name="Website_delete" {{ PortalHelpers::checkValue($module_permission->Website_delete) }} value="1">
                        <span class="custom-control-label"></span>
                    </label>
                </td>
                <td class="text-center">
                    <label class="custom-control custom-checkbox success">
                        <input type="checkbox" class="custom-control-input"
                               name="Website_detail" {{ PortalHelpers::checkValue($module_permission->Website_detail) }} value="1">
                        <span class="custom-control-label"></span>
                    </label>
                </td>

            </tr>
            <tr>
                <td class="font-weight-semibold">
                    Home Based Order
                    <input type="hidden" id="home_based_hidden" name="home_based_view"/>
                </td>
                <td class="text-center">
                    <label class="custom-control custom-checkbox success">
                        <input type="checkbox" class="custom-control-input"
                               name="home_order_list" {{ PortalHelpers::checkValue($module_permission->home_Order_list) }} value="1">
                        <span class="custom-control-label"></span>
                    </label>
                </td>
                <td class="text-center">
                    <label class="custom-control custom-checkbox success">
                        <input type="checkbox" class="custom-control-input"
                               name="home_order_create" {{ PortalHelpers::checkValue($module_permission->home_Order_create) }} value="1">
                        <span class="custom-control-label"></span>
                    </label>
                </td>
                <td class="text-center">
                    <label class="custom-control custom-checkbox success">
                        <input type="checkbox" class="custom-control-input"
                               name="home_order_update" {{ PortalHelpers::checkValue($module_permission->home_Order_update) }} value="1">
                        <span class="custom-control-label"></span>
                    </label>
                </td>
                <td class="text-center">
                    <label class="custom-control custom-checkbox success">
                        <input type="checkbox" class="custom-control-input"
                               name="home_order_delete" {{ PortalHelpers::checkValue($module_permission->home_Order_delete) }} value="1">
                        <span class="custom-control-label"></span>
                    </label>
                </td>
                <td class="text-center">

                </td>

            </tr>

            <tr>
                <td class="font-weight-semibold">
                    Order Conformation
                    <input type="hidden" id="Confirmation_hidden" name="confirmation_view"/>
                </td>
                <td class="text-center">
                    <label class="custom-control custom-checkbox success">
                        <input type="checkbox" class="custom-control-input"
                               name="confirmation_list" {{ PortalHelpers::checkValue($module_permission->Confirmation_list) }} value="1">
                        <span class="custom-control-label"></span>
                    </label>
                </td>
                <td class="text-center">
                    <label class="custom-control custom-checkbox success">
                        <input type="checkbox" class="custom-control-input"
                               name="confirmation_create" {{ PortalHelpers::checkValue($module_permission->Confirmation_create) }} value="1">
                        <span class="custom-control-label"></span>
                    </label>
                </td>
                <td class="text-center">
                    <label class="custom-control custom-checkbox success">
                        <input type="checkbox" class="custom-control-input"
                               name="confirmation_update" {{ PortalHelpers::checkValue($module_permission->Confirmation_update) }} value="1">
                        <span class="custom-control-label"></span>
                    </label>
                </td>
                <td class="text-center">
                    <label class="custom-control custom-checkbox success">
                        <input type="checkbox" class="custom-control-input"
                               name="confirmation_delete" {{ PortalHelpers::checkValue($module_permission->Confirmation_delete) }} value="1">
                        <span class="custom-control-label"></span>
                    </label>
                </td>
                <td class="text-center">

                </td>

            </tr>
            <tr>
                <td class="font-weight-semibold">
                    Deladline Manage
                    <input type="hidden" id="deadline_hidden" name="deadline_view"/>
                </td>
                <td class="text-center">
                    <label class="custom-control custom-checkbox success">
                        <input type="checkbox" class="custom-control-input"
                               name="deadline_list" {{ PortalHelpers::checkValue($module_permission->deadline_list) }} value="1">
                        <span class="custom-control-label"></span>
                    </label>
                </td>
                <td class="text-center">
                    <label class="custom-control custom-checkbox success">
                        <input type="checkbox" class="custom-control-input"
                               name="deadline_create" {{ PortalHelpers::checkValue($module_permission->deadline_create) }} value="1">
                        <span class="custom-control-label"></span>
                    </label>
                </td>
                <td class="text-center">
                    <label class="custom-control custom-checkbox success">
                        <input type="checkbox" class="custom-control-input"
                               name="deadline_update" {{ PortalHelpers::checkValue($module_permission->deadline_update) }} value="1">
                        <span class="custom-control-label"></span>
                    </label>
                </td>
                <td class="text-center">
                    <label class="custom-control custom-checkbox success">
                        <input type="checkbox" class="custom-control-input"
                               name="deadline_delete" {{ PortalHelpers::checkValue($module_permission->deadline_delete) }} value="1">
                        <span class="custom-control-label"></span>
                    </label>
                </td>
                <td class="text-center">

                </td>
            </tr>
            <tr>
                <td class="font-weight-semibold">
                    Employee
                    <input type="hidden" id="employee_hidden" name="employee_view"/>
                </td>
                <td class="text-center">
                    <label class="custom-control custom-checkbox success">
                        <input type="checkbox" class="custom-control-input"
                               name="employee_list" {{ PortalHelpers::checkValue($other_permission->Employee_list) }} value="1">
                        <span class="custom-control-label"></span>
                    </label>
                </td>
                <td class="text-center">
                    <label class="custom-control custom-checkbox success">
                        <input type="checkbox" class="custom-control-input"
                               name="employee_create" {{ PortalHelpers::checkValue($other_permission->Employee_create) }} value="1">
                        <span class="custom-control-label"></span>
                    </label>
                </td>
                <td class="text-center">
                    <label class="custom-control custom-checkbox success">
                        <input type="checkbox" class="custom-control-input"
                               name="employee_update" {{ PortalHelpers::checkValue($other_permission->Employee_edit) }} value="1">
                        <span class="custom-control-label"></span>
                    </label>
                </td>
                <td class="text-center">
                    <label class="custom-control custom-checkbox success">
                        <input type="checkbox" class="custom-control-input"
                               name="employee_delete" {{ PortalHelpers::checkValue($other_permission->Employee_delete) }} value="1">
                        <span class="custom-control-label"></span>
                    </label>
                </td>
                <td class="text-center">
                    <label class="custom-control custom-checkbox success">
                        <input type="checkbox" class="custom-control-input"
                               name="employee_detail" {{ PortalHelpers::checkValue($other_permission->Employee_detail) }} value="1">
                        <span class="custom-control-label"></span>
                    </label>
                </td>

            </tr>
            <tr>
                <td class="font-weight-semibold">
                    Department
                    <input type="hidden" id="department_hidden" name="department_view"/>
                </td>
                <td class="text-center">
                    <label class="custom-control custom-checkbox success">
                        <input type="checkbox" class="custom-control-input"
                               name="department_list" {{ PortalHelpers::checkValue($other_permission->department_list) }} value="1">
                        <span class="custom-control-label"></span>
                    </label>
                </td>
                <td class="text-center">
                    <label class="custom-control custom-checkbox success">
                        <input type="checkbox" class="custom-control-input"
                               name="department_create" {{ PortalHelpers::checkValue($other_permission->department_create) }} value="1">
                        <span class="custom-control-label"></span>
                    </label>
                </td>
                <td class="text-center">
                    <label class="custom-control custom-checkbox success">
                        <input type="checkbox" class="custom-control-input"
                               name="department_update" {{ PortalHelpers::checkValue($other_permission->department_edit) }} value="1">
                        <span class="custom-control-label"></span>
                    </label>
                </td>
                <td class="text-center">
                    <label class="custom-control custom-checkbox success">
                        <input type="checkbox" class="custom-control-input"
                               name="department_delete" {{ PortalHelpers::checkValue($other_permission->department_delete) }} value="1">
                        <span class="custom-control-label"></span>
                    </label>
                </td>
                <td class="text-center">

                </td>

            </tr>

            <tr>
                <td class="font-weight-semibold">
                    Department
                    <input type="hidden" id="department_hidden" name="department_view"/>
                </td>
                <td class="text-center">
                    <label class="custom-control custom-checkbox success">
                        <input type="checkbox" class="custom-control-input"
                               name="department_list" {{ PortalHelpers::checkValue($other_permission->department_list) }} value="1">
                        <span class="custom-control-label"></span>
                    </label>
                </td>
                <td class="text-center">
                    <label class="custom-control custom-checkbox success">
                        <input type="checkbox" class="custom-control-input"
                               name="department_create" {{ PortalHelpers::checkValue($other_permission->department_create) }} value="1">
                        <span class="custom-control-label"></span>
                    </label>
                </td>
                <td class="text-center">
                    <label class="custom-control custom-checkbox success">
                        <input type="checkbox" class="custom-control-input"
                               name="department_update" {{ PortalHelpers::checkValue($other_permission->department_edit) }} value="1">
                        <span class="custom-control-label"></span>
                    </label>
                </td>
                <td class="text-center">
                    <label class="custom-control custom-checkbox success">
                        <input type="checkbox" class="custom-control-input"
                               name="department_delete" {{ PortalHelpers::checkValue($other_permission->department_delete) }} value="1">
                        <span class="custom-control-label"></span>
                    </label>
                </td>
                <td class="text-center">

                </td>

            </tr>

            <tr>
                <td class="font-weight-semibold">
                    Designation
                    <input type="hidden" id="designation_hidden" name="designation_view"/>
                </td>
                <td class="text-center">
                    <label class="custom-control custom-checkbox success">
                        <input type="checkbox" class="custom-control-input"
                               name="designation_list" {{ PortalHelpers::checkValue($other_permission->designation_delete) }} value="1">
                        <span class="custom-control-label"></span>
                    </label>
                </td>
                <td class="text-center">
                    <label class="custom-control custom-checkbox success">
                        <input type="checkbox" class="custom-control-input"
                               name="designation_create" {{ PortalHelpers::checkValue($other_permission->designation_delete) }} value="1">
                        <span class="custom-control-label"></span>
                    </label>
                </td>
                <td class="text-center">
                    <label class="custom-control custom-checkbox success">
                        <input type="checkbox" class="custom-control-input"
                               name="designation_update" {{ PortalHelpers::checkValue($other_permission->designation_delete) }} value="1">
                        <span class="custom-control-label"></span>
                    </label>
                </td>
                <td class="text-center">
                    <label class="custom-control custom-checkbox success">
                        <input type="checkbox" class="custom-control-input"
                               name="designation_delete" {{ PortalHelpers::checkValue($other_permission->designation_delete) }} value="1">
                        <span class="custom-control-label"></span>
                    </label>
                </td>
                <td class="text-center">

                </td>

            </tr>

            <tr>
                <td class="font-weight-semibold">
                    Service
                    <input type="hidden" id="service_hidden" name="service_view"/>
                </td>
                <td class="text-center">
                    <label class="custom-control custom-checkbox success">
                        <input type="checkbox" class="custom-control-input"
                               name="service_list" {{ PortalHelpers::checkValue($other_permission->Services_list) }} value="1">
                        <span class="custom-control-label"></span>
                    </label>
                </td>
                <td class="text-center">
                    <label class="custom-control custom-checkbox success">
                        <input type="checkbox" class="custom-control-input"
                               name="service_create" {{ PortalHelpers::checkValue($other_permission->Services_create) }} value="1">
                        <span class="custom-control-label"></span>
                    </label>
                </td>
                <td class="text-center">
                    <label class="custom-control custom-checkbox success">
                        <input type="checkbox" class="custom-control-input"
                               name="service_update" {{ PortalHelpers::checkValue($other_permission->Services_edit) }} value="1">
                        <span class="custom-control-label"></span>
                    </label>
                </td>
                <td class="text-center">
                    <label class="custom-control custom-checkbox success">
                        <input type="checkbox" class="custom-control-input"
                               name="service_delete" {{ PortalHelpers::checkValue($other_permission->Services_delete) }} value="1">
                        <span class="custom-control-label"></span>
                    </label>
                </td>
                <td class="text-center">

                </td>

            </tr>

            <tr>
                <td class="font-weight-semibold">
                    sales performance
                    <input type="hidden" id="service_hidden" name="sales_performance_view"/>
                </td>
                <td class="text-center">
                    <label class="custom-control custom-checkbox success">
                        <input type="checkbox" class="custom-control-input"
                               name="sales_performance_list" {{ PortalHelpers::checkValue($other_permission->Sales_Performance_list) }} value="1">
                        <span class="custom-control-label"></span>
                    </label>
                </td>
                <td class="text-center">

                </td>
                <td class="text-center">

                </td>
                <td class="text-center">

                </td>
                <td class="text-center">
                    <label class="custom-control custom-checkbox success">
                        <input type="checkbox" class="custom-control-input"
                               name="sales_performance_detail" {{ PortalHelpers::checkValue($other_permission->Sales_Performance_details) }} value="1">
                        <span class="custom-control-label"></span>
                    </label>
                </td>

            </tr>

            <tr>
                <td class="font-weight-semibold">
                    Writer performance
                    <input type="hidden" id="service_hidden" name="writer_performance_view"/>
                </td>
                <td class="text-center">
                    <label class="custom-control custom-checkbox success">
                        <input type="checkbox" class="custom-control-input"
                               name="Writer_performance_list" {{ PortalHelpers::checkValue($other_permission->Writer_Performance_list) }} value="1'">
                        <span class="custom-control-label"></span>
                    </label>
                </td>
                <td class="text-center">

                </td>
                <td class="text-center">

                </td>
                <td class="text-center">

                </td>
                <td class="text-center">
                    <label class="custom-control custom-checkbox success">
                        <input type="checkbox" class="custom-control-input"
                               name="Writer_performance_detail" {{ PortalHelpers::checkValue($other_permission->Writer_Performance_details) }} value="1">
                        <span class="custom-control-label"></span>
                    </label>
                </td>

            </tr>
            <tr>
                <td class="font-weight-semibold">
                    Skills
                    <input type="hidden" id="service_hidden" name="skills_view"/>
                </td>
                <td class="text-center">
                    <label class="custom-control custom-checkbox success">
                        <input type="checkbox" class="custom-control-input"
                               name="skills_list" {{ PortalHelpers::checkValue($other_permission->Skill_list) }} value="1">
                        <span class="custom-control-label"></span>
                    </label>
                </td>
                <td class="text-center">
                    <label class="custom-control custom-checkbox success">
                        <input type="checkbox" class="custom-control-input"
                               name="skills_create" {{ PortalHelpers::checkValue($other_permission->Skill_create) }} value="1">
                        <span class="custom-control-label"></span>
                    </label>
                </td>
                <td class="text-center">
                    <label class="custom-control custom-checkbox success">
                        <input type="checkbox" class="custom-control-input"
                               name="skills_update" {{ PortalHelpers::checkValue($other_permission->Skill_edit) }} value="1">
                        <span class="custom-control-label"></span>
                    </label>
                </td>
                <td class="text-center">
                    <label class="custom-control custom-checkbox success">
                        <input type="checkbox" class="custom-control-input"
                               name="skills_delete" {{ PortalHelpers::checkValue($other_permission->Skill_delete) }} value="1">
                        <span class="custom-control-label"></span>
                    </label>
                </td>
                <td class="text-center">

                </td>
            </tr>
            <tr>
                <td class="font-weight-semibold">
                    Attendance
                    <input type="hidden" id="service_hidden" name="attendance_view"/>
                </td>
                <td class="text-center">
                    <label class="custom-control custom-checkbox success">
                        <input type="checkbox" class="custom-control-input"
                               name="attendance_list" {{ PortalHelpers::checkValue($other_permission->Attendance_list) }} value="1">
                        <span class="custom-control-label"></span>
                    </label>
                </td>
                <td class="text-center">

                </td>
                <td class="text-center">
                    <label class="custom-control custom-checkbox success">
                        <input type="checkbox" class="custom-control-input"
                               name="attendance_update" {{ PortalHelpers::checkValue($other_permission->Attendance_Update) }} value="1">
                        <span class="custom-control-label"></span>
                    </label>
                </td>
                <td class="text-center">

                </td>
                <td class="text-center">

                </td>

            </tr>

            <tr>
                <td class="font-weight-semibold">
                    Holiday
                    <input type="hidden" id="holiday_hidden" name="holiday_view"/>
                </td>
                <td class="text-center">
                    <label class="custom-control custom-checkbox success">
                        <input type="checkbox" class="custom-control-input"
                               name="holiday_list" {{ PortalHelpers::checkValue($other_permission->Holiday_list) }} value="1">
                        <span class="custom-control-label"></span>
                    </label>
                </td>
                <td class="text-center">
                    <label class="custom-control custom-checkbox success">
                        <input type="checkbox" class="custom-control-input"
                               name="holiday_create" {{ PortalHelpers::checkValue($other_permission->Holiday_Create) }} value="1">
                        <span class="custom-control-label"></span>
                    </label>
                </td>
                <td class="text-center">

                </td>
                <td class="text-center">

                </td>
                <td class="text-center">

                </td>

            </tr>

            <tr>
                <td class="font-weight-semibold">
                    Pay Slip
                    <input type="hidden" id="holiday_hidden" name="payslip_view"/>
                </td>
                <td class="text-center">
                    <label class="custom-control custom-checkbox success">
                        <input type="checkbox" class="custom-control-input"
                               name="payslip_list" {{ PortalHelpers::checkValue($other_permission->payslip_list) }} value="1">
                        <span class="custom-control-label"></span>
                    </label>
                </td>
                <td class="text-center">
                    <label class="custom-control custom-checkbox success">
                        <input type="checkbox" class="custom-control-input"
                               name="payslip_create" {{ PortalHelpers::checkValue($other_permission->payslip_Create) }} value="1">
                        <span class="custom-control-label"></span>
                    </label>
                </td>
                <td class="text-center">

                </td>
                <td class="text-center">

                </td>
                <td class="text-center">

                </td>

            </tr>
            <tr>
                <td class="font-weight-semibold">
                    Leave
                    <input type="hidden" id="holiday_hidden" name="leave_view"/>
                </td>
                <td class="text-center">
                    <label class="custom-control custom-checkbox success">
                        <input type="checkbox" class="custom-control-input"
                               name="leave_list" {{ PortalHelpers::checkValue($other_permission->leave_list) }} value="1">
                        <span class="custom-control-label"></span>
                    </label>
                </td>
                <td class="text-center">

                </td>
                <td class="text-center">

                </td>
                <td class="text-center">

                </td>
                <td class="text-center">

                </td>

            </tr>
            <tr>
                <td class="font-weight-semibold">
                    My Attendance
                    <input type="hidden" id="holiday_hidden" name="my_attendance_view"/>
                </td>
                <td class="text-center">
                    <label class="custom-control custom-checkbox success">
                        <input type="checkbox" class="custom-control-input"
                               name="my_attendance_list" {{ PortalHelpers::checkValue($other_permission->my_attendance_list) }} value="1">
                        <span class="custom-control-label"></span>
                    </label>
                </td>
                <td class="text-center">

                </td>
                <td class="text-center">

                </td>
                <td class="text-center">

                </td>
                <td class="text-center">

                </td>

            </tr>

            <tr>
                <td class="font-weight-semibold">
                    My Payslip
                    <input type="hidden" id="holiday_hidden" name="my_payslip_view"/>
                </td>
                <td class="text-center">
                    <label class="custom-control custom-checkbox success">
                        <input type="checkbox" class="custom-control-input"
                               name="my_payslip_list" {{ PortalHelpers::checkValue($other_permission->my_Payslip_list) }} value="1">
                        <span class="custom-control-label"></span>
                    </label>
                </td>
                <td class="text-center">

                </td>
                <td class="text-center">

                </td>
                <td class="text-center">

                </td>
                <td class="text-center">

                </td>

            </tr>
            <tr>
                <td class="font-weight-semibold">
                    Company Policy
                    <input type="hidden" id="holiday_hidden" name="company_policy_view"/>
                </td>
                <td class="text-center">
                    <label class="custom-control custom-checkbox success">
                        <input type="checkbox" class="custom-control-input"
                               name="company_policy_list" {{ PortalHelpers::checkValue($other_permission->Company_policy_view) }} value="1">
                        <span class="custom-control-label"></span>
                    </label>
                </td>
                <td class="text-center">

                </td>
                <td class="text-center">

                </td>
                <td class="text-center">

                </td>
                <td class="text-center">

                </td>

            </tr>
            <tr>
                <td class="font-weight-semibold">
                    Search Order
                    <input type="hidden" id="holiday_hidden" name="search_order_view"/>
                </td>
                <td class="text-center">
                    <label class="custom-control custom-checkbox success">
                        <input type="checkbox" class="custom-control-input"
                               name="search_order_list" {{ PortalHelpers::checkValue($other_permission->Search_order_view) }} value="1" >
                        <span class="custom-control-label"></span>
                    </label>
                </td>
                <td class="text-center">

                </td>
                <td class="text-center">

                </td>
                <td class="text-center">

                </td>
                <td class="text-center">

                </td>

            </tr>
            <tr>
                <td class="font-weight-semibold">
                    Report
                    <input type="hidden" id="holiday_hidden" name="report_view"/>
                </td>
                <td class="text-center">
                    <label class="custom-control custom-checkbox success">
                        <input type="checkbox" class="custom-control-input"
                               name="report_list" {{ PortalHelpers::checkValue($other_permission->report_list) }} value="1" >
                        <span class="custom-control-label"></span>
                    </label>
                </td>
                <td class="text-center">
                    <label class="custom-control custom-checkbox success">
                        <input type="checkbox" class="custom-control-input"
                               name="report_create" {{ PortalHelpers::checkValue($other_permission->report_create) }} value="1" >
                        <span class="custom-control-label"></span>
                    </label>
                </td>
                <td class="text-center">
                    <label class="custom-control custom-checkbox success">
                        <input type="checkbox" class="custom-control-input"
                               name="report_update" {{ PortalHelpers::checkValue($other_permission->report_edit) }} value="1" >
                        <span class="custom-control-label"></span>
                    </label>
                </td>
                <td class="text-center">
                    <label class="custom-control custom-checkbox success">
                        <input type="checkbox" class="custom-control-input"
                               name="report_delete" {{ PortalHelpers::checkValue($other_permission->report_delete) }} value="1" >
                        <span class="custom-control-label"></span>
                    </label>
                </td>
                <td class="text-center">

                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="card-footer">
    <button type="submit" class="btn btn-primary col-md-12">Update</button>
</div>
