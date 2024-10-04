<!--Page header-->
<div class="page-header d-xl-flex d-block">
    <div class="page-leftheader">
        <h4 class="page-title">New <span class="font-weight-normal text-muted ms-2">Employee</span></h4>
    </div>
</div>
<!--End Page header-->
<!-- Row -->
<div class="row">
    <div class="col-xl-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('Auth.Reg.User') }}" method="POST" class="needs-validation was-validated">
                    @csrf
                    <h4 class="my-4">Personal Information</h4>
                    <div class="row row-sm mb-4">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label">First Name</label>
                                <input class="form-control" name="F_Name" type="text"
                                       placeholder="Enter First Name" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label">Last Name</label>
                                <input class="form-control" type="text" name="L_Name"
                                       placeholder="Enter Last Name" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label">Phone</label>
                                <input class="form-control Phone-Number" type="text" name="Phone_Number"
                                       placeholder="Enter Number" required>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label">CNIC No</label>
                                <input class="form-control CNIC-Number" type="text" name="CNIC_No"
                                       placeholder="Enter Number"
                                       required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Joining Date</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <span class="feather feather-calendar"></span>
                                    </div>
                                </div>
                                <input class="form-control fc-datepicker-2" name="Joining_Date"
                                       placeholder="MM/DD/YYYY" type="date" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label">Department </label>
                                <select name="Department" class="form-control custom-select select2"
                                        data-placeholder="Select Department" required>
                                    <option label="Select Department"></option>
                                    @foreach($Departments as $Depart)
                                        <option value="{{ $Depart->id }}">{{ $Depart->Department_Name }}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label">Employment Status</label>
                                <select name="Employee_Status" class="form-control custom-select select2 Employee_Status"
                                        data-placeholder="Employment Status" required>
                                    <option label="Select Country"></option>
                                    <option value="1">Probation</option>
                                    <option value="2">Permanent</option>

                                </select>
                            </div>
                        </div>
                        <div class="col-md-3 Probation-Div">
                            <div class="form-group">
                                <label class="form-label">Probation Period</label>
                                <select name="Probation_Period" class="form-control custom-select select2"
                                        data-placeholder="Probation Period">
                                    <option label="Select Probation"></option>
                                    @for($i = 1; $i < 7; $i++)
                                        <option value="{{ $i }}">{{ $i }} Month{{ ($i > 1)? '\'s': '' }} </option>
                                    @endfor
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label">Job Title</label>
                                <select name="Job_Type" class="form-control custom-select select2"
                                        data-placeholder="Select Job Type" required>
                                    <option label="Select Job Type"></option>
                                    <option value="1">Office Base</option>
                                    <option value="2">Home Base</option>
                                </select>
                            </div>

                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label">Salary</label>
                                <input class="form-control" name="Basic_Salary" type="number"
                                       placeholder="Enter salary" required>
                            </div>
                        </div>
                    </div>
                    <h4 class="my-4">Employee Information</h4>
                    <div class="row row-sm mb-4">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label">Employee ID</label>
                                <input class="form-control" name="Employee_Id" type="text"
                                       placeholder="Enter Number" value="{{ $L_UID }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label">Email</label>
                                <input class="form-control" type="email" name="User_Email"
                                       placeholder="Enter Your Email" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label">Password</label>
                                <input class="form-control" name="Password" type="password" placeholder="Enter Name"
                                       required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label">Confirm Password</label>
                                <input class="form-control" type="password" name="Confirm_Password"
                                       placeholder="Enter Number" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label">Designation</label>
                                <select name="Designation" class="form-control custom-select select2 Designation"
                                        data-placeholder="Select Level" required>
                                    <option label="Select Designation"></option>
                                    @foreach($Designations as $Designation)
                                        <option
                                            value="{{ $Designation->id }}">{{ $Designation->Designation_Name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3 Coordinators-Div">
                            <div class="form-group">
                                <label class="form-label">Coordinator</label>
                                <select name="Coordinator" class="form-control custom-select select2 Coordinator"
                                        data-placeholder="Select Coordinator">
                                    <option label="Select Coordinator"></option>
                                    @foreach($Coordinators as $Coordinator)
                                        <option
                                            value="{{ $Coordinator->id }}">{{ $Coordinator->basic_info->full_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3 Writer-Skill-Div">
                            <div class="form-group">
                                <label class="form-label">Select Writer Skill</label>
                                <select name="Writer_Skill" class="form-control custom-select select2 Writer_Skill"
                                        data-placeholder="Select Skill">
                                    <option label="Select Skill"></option>
                                    @foreach($Writer_Skills as $Skill)
                                        <option
                                            value="{{ $Skill->id }}">{{ $Skill->Skill_Name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <h4 class="my-4">Emergency Contact 1</h4>
                    <div class="row row-sm mb-4">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Name</label>
                                <input class="form-control" name="Emergency_Name[]" type="text"
                                       placeholder="Enter Phone Number" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Phone Number</label>
                                <input class="form-control Phone-Number" name="Emergency_Phone[]" type="text"
                                       placeholder="Enter Phone Number" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Relation</label>
                                <input class="form-control" name="Emergency_Relation[]" type="text"
                                       placeholder="Enter Relation (e.g Father)" required>
                            </div>
                        </div>
                    </div>
                    <h4 class="my-4">Emergency Contact 2</h4>
                    <div class="row row-sm mb-4">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Name</label>
                                <input class="form-control" name="Emergency_Name[]" type="text"
                                       placeholder="Enter Name">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Phone Number</label>
                                <input class="form-control Phone-Number" name="Emergency_Phone[]" type="text"
                                       placeholder="Enter Name">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Relation</label>
                                <input class="form-control" name="Emergency_Relation[]" type="text"
                                       placeholder="Enter Relation (e.g Father)">
                            </div>
                        </div>
                    </div>
                    @php
                        $Start_Time = date('H:i', strtotime('09:00 AM'));
                        $End_Time = date('H:i', strtotime('05:00 PM'));
                    @endphp
                    <h4 class="my-4">Office Shift Timing</h4>
                    <div class="row row-sm mb-4">
                        <div class="col-md-6">
                            <label class=" ">Start Time</label>
                            <div class="d-flex">
                                <div class="input-group wd-150">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <span class="feather feather-clock"></span>
                                        </div>
                                    </div><!-- input-group-prepend -->
                                    <input class="form-control" name="Start_Time"
                                           placeholder="Set time" type="time" value="{{ $Start_Time }}" required>
                                </div><!-- input-group -->
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class=" ">End Time</label>
                            <div class="d-flex">
                                <div class="input-group wd-150">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <span class="feather feather-clock"></span>
                                        </div>
                                    </div><!-- input-group-prepend -->
                                    <input class="form-control" name="End_Time"
                                           placeholder="Set time" type="time" value="{{ $End_Time }}" required>
                                </div><!-- input-group -->
                            </div>
                        </div>


                    </div>
                    <h4 class="my-4">Leave Entitlement</h4>
                    <div class="row row-sm mb-4">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label">Sick</label>
                                <input class="form-control" name="Sick_Leave" type="text" placeholder="Sick Leave"
                                       value="{{ $Leaves['Sick_Leave'] }}" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label">Annual</label>
                                <input class="form-control" name="Annual_Leave" type="text"
                                       placeholder="Annual leave" value="{{ $Leaves['Annual_Leave'] }}" required>
                            </div>
                        </div>


                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label">Off Days</label>
                                <select name="Off_Days" class="form-control custom-select select2"
                                        data-placeholder="Select Country" required>
                                    <option label="Select Country"></option>
                                    <option value="Monday">Monday</option>
                                    <option value="Tuesday">Tuesday</option>
                                    <option value="Wednesday">Wednesday</option>
                                    <option value="Thursday">Thursday</option>
                                    <option value="Friday">Friday</option>
                                    <option value="Saturday">Saturday</option>
                                    <option selected value="Sunday">Sunday</option>
                                </select>
                            </div>

                        </div>
                        <div class="col-md-3" data-select2-id="select2-data-6-52to">
                            <div class="form-group">
                                <label class="form-label">Casual</label>
                                <input class="form-control" name="Casual_Leave" type="text"
                                       placeholder="Casual leave" value="{{ $Leaves['Casual_Leave'] }}" required>
                            </div>
                        </div>
                    </div>
                    <h4 class="my-4">Bank Details</h4>
                    <div class="row row-sm mb-4">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Bank Name</label>
                                <input class="form-control" name="Bank_Name" type="text"
                                       placeholder="Enter Name" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Account Title</label>
                                <input class="form-control" name="Account_Title" type="text"
                                       placeholder="Enter Name" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Account Number(With IBAN)</label>
                                <input class="form-control" name="Account_Number" type="text"
                                       placeholder="Enter Name" required>
                            </div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <button type="submit" class="btn btn-primary btn-block">Finish & Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Row-->
<script>
    $(document).ready(function () {
        $('.Coordinators-Div').hide();
        $('.Writer-Skill-Div').hide();
        $('.Designation').change(function () {
            var Role_ID = $(this).val();
            if (Role_ID === '6' || Role_ID === '7' || Role_ID === '11') {
                $('.Coordinators-Div').show();
            } else {
                $('.Coordinators-Div').hide();
            }
            if (Role_ID === '8' || Role_ID === '12') {
                $('.Writer-Skill-Div').show();
            } else {
                $('.Writer-Skill-Div').hide();
            }
        });
        $('input[type="checkbox"]').val(0);
        $('input[type="checkbox"]').change(function () {
            var value = this.checked ? 1 : 0;
            if (value === 1) {
                $(this).val(1);
            } else {
                $(this).val(0);
            }
        });

        const Probation_Div = $('.Probation-Div');
        Probation_Div.hide();
        $('.Employee_Status').change(function () {
            const Status = $(this).val();
            if (Status === '1') {
                Probation_Div.show();
                Probation_Div.attr('required', 'true');
            } else {
                Probation_Div.hide();
                Probation_Div.attr('required', 'false');
            }
        });
    });
</script>
