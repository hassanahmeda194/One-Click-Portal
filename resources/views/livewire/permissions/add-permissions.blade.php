<div class="page-header d-xl-flex d-block">
    <div class="page-leftheader">
        <h4 class="page-title">Permission List</h4>
    </div>

</div>

<div class="card mt-5">
    <div class="card-body">
        <form method="post" id="firstform">
            @csrf
            <div class="row">
                <div class="col-md-12 col-xl-3">
                    <div class="form-group">
                        <h4>Role</h4>
                        <select id="myDropdown" name="role" class="form-control custom-select select2"
                                data-placeholder="Select Priority">
                            <option label="Select Priority"></option>
                            @foreach ($role as $roles)
                                <option value="{{ $roles->id }}">{{ $roles->Designation_Name}}</option>
                            @endforeach

                        </select>
                    </div>
                </div>
            </div>
            <h4 class="my-4">Permissions:</h4>
            <div id="Permission_Form">
                <div class="mb-4">

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
                                               class="custom-control-input" value="1">
                                        <span class="custom-control-label"></span>
                                    </label>
                                </td>
                                <td class="text-center">
                                    <label class="custom-control custom-checkbox success">
                                        <input type="checkbox" id="checkbox2" name="research_create"
                                               class="custom-control-input" value="1">
                                        <span class="custom-control-label"></span>
                                    </label>
                                </td>
                                <td class="text-center">
                                    <label class="custom-control custom-checkbox success">
                                        <input type="checkbox" id="checkbox3" name="research_update"
                                               class="custom-control-input" value="1">
                                        <span class="custom-control-label"></span>
                                    </label>
                                </td>
                                <td class="text-center">
                                    <label class="custom-control custom-checkbox success">
                                        <input type="checkbox" id="checkbox4" name="research_delete"
                                               class="custom-control-input" value="1">
                                        <span class="custom-control-label"></span>
                                    </label>
                                </td>
                                <td class="text-center">
                                    <label class="custom-control custom-checkbox success">
                                        <input type="checkbox" id="checkbox4" name="research_detail"
                                               class="custom-control-input" value="1">
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
                                               name="Content_list"
                                               value="1">
                                        <span class="custom-control-label"></span>
                                    </label>
                                </td>
                                <td class="text-center">
                                    <label class="custom-control custom-checkbox success">
                                        <input type="checkbox" id="Content_create" class="custom-control-input"
                                               name="Content_create"
                                               value="1">
                                        <span class="custom-control-label"></span>
                                    </label>
                                </td>
                                <td class="text-center">
                                    <label class="custom-control custom-checkbox success">
                                        <input type="checkbox" id="Content_update" class="custom-control-input"
                                               name="Content_update"
                                               value="1">
                                        <span class="custom-control-label"></span>
                                    </label>
                                </td>
                                <td class="text-center">
                                    <label class="custom-control custom-checkbox success">
                                        <input type="checkbox" id="Content_delete" class="custom-control-input"
                                               name="Content_delete" value="1"
                                        >
                                        <span class="custom-control-label"></span>
                                    </label>
                                </td>
                                <td class="text-center">
                                    <label class="custom-control custom-checkbox success">
                                        <input type="checkbox" id="Content_details" class="custom-control-input"
                                               name="Content_details" value="1"
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
                                        <input type="checkbox" id="" class="custom-control-input"
                                               name="Website_list" value="1">
                                        <span class="custom-control-label"></span>
                                    </label>
                                </td>
                                <td class="text-center">
                                    <label class="custom-control custom-checkbox success">
                                        <input type="checkbox" id="" class="custom-control-input"
                                               name="Website_create" value="1">
                                        <span class="custom-control-label"></span>
                                    </label>
                                </td>
                                <td class="text-center">
                                    <label class="custom-control custom-checkbox success">
                                        <input type="checkbox" id="" class="custom-control-input"
                                               name="Website_update" value="1">
                                        <span class="custom-control-label"></span>
                                    </label>
                                </td>
                                <td class="text-center">
                                    <label class="custom-control custom-checkbox success">
                                        <input type="checkbox" id="" class="custom-control-input"
                                               name="Website_delete" value="1">
                                        <span class="custom-control-label"></span>
                                    </label>
                                </td>
                                <td class="text-center">
                                    <label class="custom-control custom-checkbox success">
                                        <input type="checkbox" id="" class="custom-control-input"
                                               name="Website_details" value="1">
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
                                        <input type="checkbox" id="" class="custom-control-input"
                                               name="home_order_list" value="1">
                                        <span class="custom-control-label"></span>
                                    </label>
                                </td>
                                <td class="text-center">
                                    <label class="custom-control custom-checkbox success">
                                        <input type="checkbox" id="" class="custom-control-input"
                                               name="home_order_create" value="1">
                                        <span class="custom-control-label"></span>
                                    </label>
                                </td>
                                <td class="text-center">
                                    <label class="custom-control custom-checkbox success">
                                        <input type="checkbox" id="" class="custom-control-input"
                                               name="home_order_update" value="1">
                                        <span class="custom-control-label"></span>
                                    </label>
                                </td>
                                <td class="text-center">
                                    <label class="custom-control custom-checkbox success">
                                        <input type="checkbox" id="" class="custom-control-input"
                                               name="home_order_delete" value="1">
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
                                        <input type="checkbox" id="" class="custom-control-input"
                                               name="confirmation_list" value="1">
                                        <span class="custom-control-label"></span>
                                    </label>
                                </td>
                                <td class="text-center">
                                    <label class="custom-control custom-checkbox success">
                                        <input type="checkbox" id="" class="custom-control-input"
                                               name="confirmation_create" value="1">
                                        <span class="custom-control-label"></span>
                                    </label>
                                </td>
                                <td class="text-center">
                                    <label class="custom-control custom-checkbox success">
                                        <input type="checkbox" id="" class="custom-control-input"
                                               name="confirmation_update" value="1">
                                        <span class="custom-control-label"></span>
                                    </label>
                                </td>
                                <td class="text-center">
                                    <label class="custom-control custom-checkbox success">
                                        <input type="checkbox" id="" class="custom-control-input"
                                               name="confirmation_delete" value="1">
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
                                        <input type="checkbox" id="" class="custom-control-input"
                                               name="deadline_list" value="1">
                                        <span class="custom-control-label"></span>
                                    </label>
                                </td>
                                <td class="text-center">
                                    <label class="custom-control custom-checkbox success">
                                        <input type="checkbox" id="" class="custom-control-input"
                                               name="deadline_create" value="1">
                                        <span class="custom-control-label"></span>
                                    </label>
                                </td>
                                <td class="text-center">
                                    <label class="custom-control custom-checkbox success">
                                        <input type="checkbox" id="" class="custom-control-input"
                                               name="deadline_update" value="1">
                                        <span class="custom-control-label"></span>
                                    </label>
                                </td>
                                <td class="text-center">
                                    <label class="custom-control custom-checkbox success">
                                        <input type="checkbox" id="" class="custom-control-input"
                                               name="deadline_delete" value="1">
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
                                        <input type="checkbox" id="" class="custom-control-input"
                                               name="employee_list" value="1">
                                        <span class="custom-control-label"></span>
                                    </label>
                                </td>
                                <td class="text-center">
                                    <label class="custom-control custom-checkbox success">
                                        <input type="checkbox" id="" class="custom-control-input"
                                               name="employee_create" value="1">
                                        <span class="custom-control-label"></span>
                                    </label>
                                </td>
                                <td class="text-center">
                                    <label class="custom-control custom-checkbox success">
                                        <input type="checkbox" id="" class="custom-control-input"
                                               name="employee_update" value="1">
                                        <span class="custom-control-label"></span>
                                    </label>
                                </td>
                                <td class="text-center">
                                    <label class="custom-control custom-checkbox success">
                                        <input type="checkbox" id="" class="custom-control-input"
                                               name="employee_delete" value="1">
                                        <span class="custom-control-label"></span>
                                    </label>
                                </td>
                                <td class="text-center">
                                    <label class="custom-control custom-checkbox success">
                                        <input type="checkbox" id="" class="custom-control-input"
                                               name="employee_detail" value="1">
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
                                        <input type="checkbox" id="" class="custom-control-input"
                                               name="department_list" value="1">
                                        <span class="custom-control-label"></span>
                                    </label>
                                </td>
                                <td class="text-center">
                                    <label class="custom-control custom-checkbox success">
                                        <input type="checkbox" id="" class="custom-control-input"
                                               name="department_create" value="1">
                                        <span class="custom-control-label"></span>
                                    </label>
                                </td>
                                <td class="text-center">
                                    <label class="custom-control custom-checkbox success">
                                        <input type="checkbox" id="" class="custom-control-input"
                                               name="department_update" value="1">
                                        <span class="custom-control-label"></span>
                                    </label>
                                </td>
                                <td class="text-center">
                                    <label class="custom-control custom-checkbox success">
                                        <input type="checkbox" id="" class="custom-control-input"
                                               name="department_delete" value="1">
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
                                        <input type="checkbox" id="" class="custom-control-input"
                                               name="department_list" value="1">
                                        <span class="custom-control-label"></span>
                                    </label>
                                </td>
                                <td class="text-center">
                                    <label class="custom-control custom-checkbox success">
                                        <input type="checkbox" id="" class="custom-control-input"
                                               name="department_create" value="1">
                                        <span class="custom-control-label"></span>
                                    </label>
                                </td>
                                <td class="text-center">
                                    <label class="custom-control custom-checkbox success">
                                        <input type="checkbox" id="" class="custom-control-input"
                                               name="department_update" value="1">
                                        <span class="custom-control-label"></span>
                                    </label>
                                </td>
                                <td class="text-center">
                                    <label class="custom-control custom-checkbox success">
                                        <input type="checkbox" id="" class="custom-control-input"
                                               name="department_delete" value="1">
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
                                        <input type="checkbox" id="" class="custom-control-input"
                                               name="designation_list" value="1">
                                        <span class="custom-control-label"></span>
                                    </label>
                                </td>
                                <td class="text-center">
                                    <label class="custom-control custom-checkbox success">
                                        <input type="checkbox" id="" class="custom-control-input"
                                               name="designation_create" value="1">
                                        <span class="custom-control-label"></span>
                                    </label>
                                </td>
                                <td class="text-center">
                                    <label class="custom-control custom-checkbox success">
                                        <input type="checkbox" id="" class="custom-control-input"
                                               name="designation_update" value="1">
                                        <span class="custom-control-label"></span>
                                    </label>
                                </td>
                                <td class="text-center">
                                    <label class="custom-control custom-checkbox success">
                                        <input type="checkbox" id="" class="custom-control-input"
                                               name="designation_delete" value="1">
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
                                        <input type="checkbox" id="" class="custom-control-input"
                                               name="service_list" value="1">
                                        <span class="custom-control-label"></span>
                                    </label>
                                </td>
                                <td class="text-center">
                                    <label class="custom-control custom-checkbox success">
                                        <input type="checkbox" id="" class="custom-control-input"
                                               name="service_create" value="1">
                                        <span class="custom-control-label"></span>
                                    </label>
                                </td>
                                <td class="text-center">
                                    <label class="custom-control custom-checkbox success">
                                        <input type="checkbox" id="" class="custom-control-input"
                                               name="service_update" value="1">
                                        <span class="custom-control-label"></span>
                                    </label>
                                </td>
                                <td class="text-center">
                                    <label class="custom-control custom-checkbox success">
                                        <input type="checkbox" id="" class="custom-control-input"
                                               name="service_delete" value="1">
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
                                        <input type="checkbox" id="" class="custom-control-input"
                                               name="sales_performance_list" value="1">
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
                                        <input type="checkbox" id="" class="custom-control-input"
                                               name="sales_performance_detail" value="1">
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
                                        <input type="checkbox" id="" class="custom-control-input"
                                               name="Writer_performance_list" value="1">
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
                                        <input type="checkbox" id="" class="custom-control-input"
                                               name="Writer_performance_detail" value="1">
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
                                        <input type="checkbox" id="" class="custom-control-input"
                                               name="skills_list" value="1">
                                        <span class="custom-control-label"></span>
                                    </label>
                                </td>
                                <td class="text-center">
                                    <label class="custom-control custom-checkbox success">
                                        <input type="checkbox" id="" class="custom-control-input"
                                               name="skills_create" value="1">
                                        <span class="custom-control-label"></span>
                                    </label>
                                </td>
                                <td class="text-center">
                                    <label class="custom-control custom-checkbox success">
                                        <input type="checkbox" id="" class="custom-control-input"
                                               name="skills_update" value="1">
                                        <span class="custom-control-label"></span>
                                    </label>
                                </td>
                                <td class="text-center">
                                    <label class="custom-control custom-checkbox success">
                                        <input type="checkbox" id="" class="custom-control-input"
                                               name="skills_delete" value="1">
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
                                        <input type="checkbox" id="" class="custom-control-input"
                                               name="attendance_list" value="1">
                                        <span class="custom-control-label"></span>
                                    </label>
                                </td>
                                <td class="text-center">
                                    <label class="custom-control custom-checkbox success">
                                        <input type="checkbox" id="" class="custom-control-input"
                                               name="attendance_update" value="1">
                                        <span class="custom-control-label"></span>
                                    </label>
                                </td>
                                <td class="text-center">
                                    <label class="custom-control custom-checkbox success">
                                        <input type="checkbox" id="" class="custom-control-input"
                                               name="attendance_update" value="1">
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
                                        <input type="checkbox" id="" class="custom-control-input"
                                               name="holiday_list" value="1">
                                        <span class="custom-control-label"></span>
                                    </label>
                                </td>
                                <td class="text-center">
                                    <label class="custom-control custom-checkbox success">
                                        <input type="checkbox" id="" class="custom-control-input"
                                               name="holiday_create" value="1">
                                        <span class="custom-control-label"></span>
                                    </label>
                                </td>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
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
                                        <input type="checkbox" id="" class="custom-control-input"
                                               name="payslip_list" value="1">
                                        <span class="custom-control-label"></span>
                                    </label>
                                </td>
                                <td class="text-center">
                                    <label class="custom-control custom-checkbox success">
                                        <input type="checkbox" id="" class="custom-control-input"
                                               name="payslip_create" value="1">
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
                                        <input type="checkbox" id="" class="custom-control-input"
                                               name="leave_list" value="1">
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
                                        <input type="checkbox" id="" class="custom-control-input"
                                               name="my_attendance_list" value="1">
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
                                        <input type="checkbox" id="" class="custom-control-input"
                                               name="my_payslip_list" value="1">
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
                                        <input type="checkbox" id="" class="custom-control-input"
                                               name="company_policy_list" value="1">
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
                                        <input type="checkbox" id="" class="custom-control-input"
                                               name="search_order_list" value="1">
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
                                        <input type="checkbox" id="" class="custom-control-input"
                                               name="report_list" value="1">
                                        <span class="custom-control-label"></span>
                                    </label>
                                </td>
                                <td class="text-center">
                                    <label class="custom-control custom-checkbox success">
                                        <input type="checkbox" id="" class="custom-control-input"
                                               name="report_create" value="1">
                                        <span class="custom-control-label"></span>
                                    </label>
                                </td>
                                <td class="text-center">
                                    <label class="custom-control custom-checkbox success">
                                        <input type="checkbox" id="" class="custom-control-input"
                                               name="report_update" value="1">
                                        <span class="custom-control-label"></span>
                                    </label>
                                </td>
                                <td class="text-center">
                                    <label class="custom-control custom-checkbox success">
                                        <input type="checkbox" id="" class="custom-control-input"
                                               name="report_delete" value="1">
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
                    <button type="submit" class="btn btn-primary col-md-12">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#firstform').attr('action', '{{ route('Post.Portal.Permissions') }}');
        $('#myDropdown').on('change', function () {
            var selectedOption = $(this).val();

            $.ajax({
                url: '{{ route('Get.Portal.Permissions') }}',
                type: 'GET',
                data: {
                    Role_ID: selectedOption
                },
                success: function (response) {
                    if (response.error !== '404') {
                        $('#firstform').attr('action', "{{ route('Update.Portal.Permission') }}");
                        $('#Permission_Form').html(response);
                    } else {
                        // $('#Permission_Form').hide();
                    }
                },
                error: function (xhr, status, error) {
                    console.log(error);
                }
            });
        });
    });

</script>
