<style>
    .file-input-wrapper {
        position: relative;
        display: inline-block;
    }

    .file-input {
        opacity: 0;
        width: 0.1px;
        height: 0.1px;
        position: absolute;
        z-index: -1;
    }

    .file-input-label {
        display: inline-block;
        padding: 8px 16px;
        background-color: #DEE3F3;
        border: none;
        color: black;
        cursor: pointer;
        border-radius: 4px;
        /* font-weight: bold; */
    }

    .file-input-label:hover {
        background-color: #DEE3F3;
    }

    .file-input-label:active {
        background-color: #DEE3F3;
    }
</style>
<!--Page header-->
<div class="page-header d-xl-flex d-block">
    <div class="page-leftheader">
    </div>
</div>
@php
    if(in_array($currenetUserRole , [1,2,14,15])){
    
    $readOnly = "";
    }else{
    $readOnly = "readonly";
    }
    

@endphp
<!--End Page header-->
<!-- Row -->
<div class="row">
    <div class="col-xl-3 col-md-12 col-lg-12">
        <div class="card user-pro-list overflow-hidden">
            <div class="card-body">
                <div class="text-center">
                    <div class="widget-user-image mx-auto text-center">
                        <img class="avatar avatar-xxl brround" alt="img"
                            src="{{ !empty($User_Info->basic_info->profile_photo_path) ? asset($User_Info->basic_info->profile_photo_path) : asset('assets/images/users/16.jpg') }}">
                    </div>
                    <div class="pro-user mt-3">
                        <h5 class="pro-user-username text-dark mb-1 fs-16">{{ $User_Info->basic_info->full_name }}</h5>
                        <h6 class="pro-user-desc text-muted fs-12">{{ $User_Info->designation->Designation_Name }}</h6>
                    </div>
                </div>
                <h5 class="mb-2 mt-4 font-weight-semibold">Basic Details</h5>
                <div class="table-responsive">
                    <table class="table text-nowrap">
                        <tbody>
                            <tr>
                                <td>
                                    Employee ID
                                </td>
                                <td>:</td>
                                <td>
                                    <strong>{{ $User_Info->EMP_ID }}</strong>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="">Email</span>
                                </td>
                                <td>:</td>
                                <td>
                                    <span>{{ $User_Info->email }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="">Phone</span>
                                </td>
                                <td>:</td>
                                <td>
                                    <span>{{ $User_Info->basic_info->Phone_Number }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="">NIC No</span>
                                </td>
                                <td>:</td>
                                <td>
                                    <span>{{ $User_Info->basic_info->CNIC_Number }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="">Date Of Birth</span>
                                </td>
                                <td>:</td>
                                <td>
                                    <span>{{ !empty($User_Info->basic_info->DOB) ? date('M d, Y', strtotime($User_Info->basic_info->DOB)) : null }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="">Designation</span>
                                </td>
                                <td>:</td>
                                <td>
                                    <span class="">{{ $User_Info->designation->Designation_Name }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="">Join Date</span>
                                </td>
                                <td>:</td>
                                <td>
                                    <span
                                        class="">{{ date('M d, Y', strtotime($User_Info->basic_info->Join_Date)) }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="">Shift Time</span>
                                </td>
                                <td>:</td>
                                <td>
                                    <span class="">{{ date('H:i A', strtotime($User_Info->timing->Start_Time)) }}
                                        to {{ date('H:i A', strtotime($User_Info->timing->End_Time)) }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="">Salary</span>
                                </td>
                                <td>:</td>
                                <td>
                                    <span class="">{{ (float) $User_Info->basic_info->Basic_Salary }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="">Status</span>
                                </td>
                                <td>:</td>
                                <td>
                                    <span class="">Active</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
    <div class="col-xl-9 col-md-12 col-lg-12">
        <div class="tab-menu-heading hremp-tabs p-0 ">
            <div class="tabs-menu1">
                <!-- Tabs -->
                <ul class="nav panel-tabs">
                    <li><a href="#tab6" data-bs-toggle="tab" style="margin: 0 0.2rem;" class="active">Basic Info</a>
                    </li>
                    @if ($currenetUserRole == 1 || $currenetUserRole == 2 || $currenetUserRole == 14 || $currenetUserRole == 15)
                        <li><a href="#tab7" data-bs-toggle="tab" style="margin: 0 0.2rem;">Leaves Info</a></li>
                        <li><a href="#tab8" data-bs-toggle="tab" style="margin: 0 0.2rem;">Bank Account</a></li>
                    @endif
                    @if (in_array(Auth::guard('Authorized')->user()->Role_ID, [1, 2, 14, 15]))
                        <li><a href="#tab10" data-bs-toggle="tab" style="margin: 0 0.2rem;">Change Password</a></li>
                    @endif

                    <li><a href="#tab12" data-bs-toggle="tab" style="margin: 0 0.2rem;">Profile Image</a></li>
                    <li><a href="#tab11" data-bs-toggle="tab" style="margin: 0 0.2rem;">Performance</a></li>
                    <li><a href="#tab14" data-bs-toggle="tab" style="margin: 0 0.2rem;">Assigned Target</a></li>
                    @if (Auth::guard('Authorized')->user()->Role_ID === 1 || Auth::guard('Authorized')->user()->Role_ID === 2)
                        <li><a href="#tab13" data-bs-toggle="tab" style="margin: 0 0.2rem;">Login History</a></li>
                    @endif
                </ul>
            </div>
        </div>
        <div class="panel-body tabs-menu-body hremp-tabs1 p-0">
            <div class="tab-content">
                <div class="tab-pane active" id="tab6">
                    <div class="card-body">
                        <form action="{{ route('Update.Basic.Employee.Info') }}" method="POST"
                            class="needs-validation was-validated">
                            @csrf
                            <input type="hidden" name="emp_id" value="{{ $User_Info->id }}" />
                            <h4 class="my-4">Personal Information</h4>
                            <div class="row row-sm mb-4">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">First Name</label>
                                        <input class="form-control" name="F_Name" type="text"
                                            placeholder="Enter First Name" value="{{ $User_Info->basic_info->F_Name }}"
                                            required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Last Name</label>
                                        <input class="form-control" type="text" name="L_Name"
                                            placeholder="Enter Last Name" value="{{ $User_Info->basic_info->L_Name }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Phone</label>
                                        <input class="form-control Phone-Number" type="text" name="Phone_Number"
                                            placeholder="Enter Number"
                                            value="{{ $User_Info->basic_info->Phone_Number }}" required>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Email</label>
                                        <input class="form-control" type="email" name="User_Email"
                                            placeholder="Enter Your Email" value="{{ $User_Info->email }}" required>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">CNIC No</label>
                                        <input class="form-control" type="text" name="CNIC_Number"
                                            placeholder="Enter CNIC Number"
                                            value="{{ $User_Info->basic_info->CNIC_Number }}" required>
                                    </div>
                                </div>
                                @if ($currenetUserRole == 1 || $currenetUserRole == 2 || $currenetUserRole == 14 || $currenetUserRole == 15)
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Designation </label>
                                        <select name="Designation" {{$readOnly}} class="form-control select2"
                                             required>
                                            <option label="Select Designation"></option>
                                            @foreach ($Designations as $Designation)
                                                <option {{ $Designation->id == $User_Info->Role_ID ? 'Selected' : '' }}
                                                    value="{{ $Designation->id }}">
                                                    {{ $Designation->Designation_Name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                @endif
                                <div class="col-md-4">
                                    <p class="mg-b-20 mg-sm-b-40"><b>Date Of Birth</b></p>
                                    <div class="wd-200 mg-b-30">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <span class="feather feather-calendar"></span>
                                                </div>
                                            </div>
                                            <input class="form-control fc-datepicker-2" name="DOB"
                                                placeholder="MM/DD/YYYY" type="date"
                                                value="{{ $User_Info->basic_info->DOB ? date('Y-m-d', strtotime($User_Info->basic_info->DOB)) : null }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            @if ($currenetUserRole == 1 || $currenetUserRole == 2 || $currenetUserRole == 14 || $currenetUserRole == 15)
                            <h4 class="my-4">Employee Information</h4>
                            <div class="row row-sm mb-4">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Department </label>
                                        <select {{$readOnly}} name="Department" class="form-control custom-select select2"
                                            data-placeholder="Select Department" required>
                                            @foreach ($Departments as $Depart)
                                                <option @selected($User_Info->basic_info->Dep_ID === $Depart->id) value="{{ $Depart->id }}">
                                                    {{ $Depart->Department_Name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Joining Date</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <span class="feather feather-calendar"></span>
                                            </div>
                                        </div>
                                        <input {{$readOnly}} class="form-control fc-datepicker-2" name="Joining_Date"
                                            placeholder="MM/DD/YYYY" type="date"
                                            value="{{ date('Y-m-d', strtotime($User_Info->basic_info->Join_Date)) }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Salary</label>
                                        <input {{$readOnly}} class="form-control" name="Basic_Salary" type="number"
                                            placeholder="Enter salary"
                                            value="{{ $User_Info->basic_info->Basic_Salary }}" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Employee Status</label>
                                        <select name="EMP_Status" {{$readOnly}}
                                            class="form-control custom-select select2 EMP_Status"
                                            data-placeholder="Select Entitlement" required>
                                            <option label="Select Country"></option>
                                            <option @selected($User_Info->basic_info->EMP_Status === '2') value="2">
                                                Permanent
                                            </option>
                                            <option @selected($User_Info->basic_info->EMP_Status === '1') value="1">
                                                Probation
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4 Probation-Div">
                                    <div class="form-group">
                                        <label class="form-label">Probation Period</label>
                                        <select {{$readOnly}} name="Probation_Period" class="form-control custom-select select2"
                                            data-placeholder="Probation Period">
                                            <option label="Select Probation"></option>
                                            @for ($i = 1; $i < 7; $i++)
                                                <option @selected($User_Info->basic_info->Probation_Period === $i) value="{{ $i }}">
                                                    {{ $i }}
                                                    Month{{ $i > 1 ? '\'s' : '' }} </option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Job Type</label>
                                        <select {{$readOnly}} name="Job_Type" class="form-control custom-select select2"
                                            data-placeholder="Select Job Details" required>
                                            <option label="Select Country"></option>
                                            <option @selected($User_Info->basic_info->Job_Type === '1') value="1">Office
                                                Based
                                            </option>
                                            <option @selected($User_Info->basic_info->Job_Type === '2') value="2">Home
                                                Based
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Reporting Authority</label>
                                        <select {{$readOnly}} name="CID" class="form-control "
                                            data-placeholder="Select Coordinator">
                                            @foreach ($Reporting_Authorities as $Coordinator)
                                                <option {{ $User_Info->CID == $Coordinator->id ? 'Selected' : '' }}
                                                    value="{{ $Coordinator->id }}">
                                                    {{ $Coordinator->basic_info->full_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <h4 class="my-4">Office Shift Timing</h4>
                            <div class="row row-sm mb-4">
                                <div class="col-md-4">
                                    <label class=" ">Start Time</label>
                                    <div class="d-flex">
                                        <div class="input-group wd-150">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <span class="feather feather-clock"></span>
                                                </div>
                                            </div><!-- input-group-prepend -->
                                            <input {{$readOnly}} class="form-control" name="Start_Time" placeholder="Set time"
                                                type="time" value="{{ $User_Info->timing->Start_Time }}" required>
                                        </div><!-- input-group -->
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label class=" ">End Time</label>
                                    <div class="d-flex">
                                        <div class="input-group wd-150">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <span class="feather feather-clock"></span>
                                                </div>
                                            </div><!-- input-group-prepend -->
                                            <input {{$readOnly}} class="form-control" name="End_Time" placeholder="Set time"
                                                type="time" value="{{ $User_Info->timing->End_Time }}" required>
                                        </div><!-- input-group -->
                                    </div>
                                </div>
                            </div>
                            @endif
                            @if ($currenetUserRole == 1 || $currenetUserRole == 2 || $currenetUserRole == 14 || $currenetUserRole == 15)
                            
                            
                                <div class="mb-4">
                                    <button type="submit" class="btn btn-primary btn-block">Update Now</button>
                                </div>
                            @else
                             <div class="mb-4">
                                    <button type="submit" class="btn btn-primary btn-block" name="user_update">Update Now</button>
                                </div>
                            @endif
                        </form>
                    </div>
                </div>
                <div class="tab-pane" id="tab7">
                    <div class="card-body">
                        <h4 class="mb-5 font-weight-semibold">Leave Entitlement</h4>
                        <form action="{{ route('Update.Leave.Employee.Info') }}" method="POST"
                            class="needs-validation was-validated">
                            @csrf
                            <input type="hidden" name="emp_id" value="{{ $User_Info->id }}" />
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-label">Off Days</label>
                                        <select name="Off_Day" class="form-control custom-select select2"
                                            data-placeholder="Select Off Days" required>
                                            <option label="Select Country"></option>
                                            <option @selected($User_Info->leaves->Off_Day === 'Monday') value="Monday">
                                                Monday
                                            </option>
                                            <option @selected($User_Info->leaves->Off_Day === 'Tuesday') value="Tuesday">
                                                Tuesday
                                            </option>
                                            <option @selected($User_Info->leaves->Off_Day === 'Wednesday') value="Wednesday">
                                                Wednesday
                                            </option>
                                            <option @selected($User_Info->leaves->Off_Day === 'Thursday') value="Thursday">
                                                Thursday
                                            </option>
                                            <option @selected($User_Info->leaves->Off_Day === 'Friday') value="Friday">
                                                Friday
                                            </option>
                                            <option @selected($User_Info->leaves->Off_Day === 'Saturday') value="Saturday">
                                                Saturday
                                            </option>
                                            <option @selected($User_Info->leaves->Off_Day === 'Sunday') value="Sunday">
                                                Sunday
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-label">Sick Leave</label>
                                        <input class="form-control" name="Sick_Leaves" type="number"
                                            placeholder="Sick Leave"
                                            value="{{ (float) $User_Info->leaves->Sick_Leaves }}" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-label">Annual Leave</label>
                                        <input class="form-control" name="Annual_Leaves" type="number"
                                            placeholder="Annual leave"
                                            value="{{ (float) $User_Info->leaves->Annual_Leaves }}" required>
                                    </div>
                                </div>
                                <div class="col-md-3" data-select2-id="select2-data-6-52to">
                                    <div class="form-group">
                                        <label class="form-label">Casual Leave</label>
                                        <input class="form-control" name="Casual_Leaves" type="number"
                                            placeholder="Casual leave"
                                            value="{{ (float) $User_Info->leaves->Casual_Leaves }}" required>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <button type="submit" class="btn btn-primary btn-block">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="tab-pane" id="tab8">
                    <div class="card-body">
                        <h4 class="my-4">Bank Details</h4>
                        <form action="{{ route('Update.Bank.Employee.Info') }}" method="POST"
                            class="needs-validation was-validated">
                            @csrf
                            <input type="hidden" name="emp_id" value="{{ $User_Info->id }}" />
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Bank Name</label>
                                        <input class="form-control" name="Bank_Name" type="text"
                                            placeholder="Enter Bank Name"
                                            value="{{ $User_Info->bank_detail->Bank_Name }}" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Account Title</label>
                                        <input class="form-control" name="Account_Title" type="text"
                                            placeholder="Enter Account Title"
                                            value="{{ $User_Info->bank_detail->Account_Title }}" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Account Number(With IBAN)</label>
                                        <input class="form-control" name="Account_Number" type="text"
                                            placeholder="Enter Account Name"
                                            value="{{ $User_Info->bank_detail->Account_Number }}" required>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <button type="submit" class="btn btn-primary btn-block">Update</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
                <div class="tab-pane" id="tab10">
                    <div class="card-body">
                        <form action="{{ route('Update.Employee.Password') }}" method="POST"
                            class="needs-validation was-validated">
                            @csrf
                            <input type="hidden" name="emp_id" value="{{ $User_Info->id }}" />
                            @foreach ($errors->all() as $error)
                                <p class="text-danger">{{ $error }}</p>
                            @endforeach
                            <h4 class="mb-5 font-weight-semibold">Change Password</h4>
                            <div class="row">
                                {{--                                <div class="col-md-4"> --}}
                                {{--                                    <div class="form-group"> --}}
                                {{--                                        <label class="form-label">Old Password</label> --}}
                                {{--                                        <input id="password" class="form-control" name="current_password" --}}
                                {{--                                               type="password" placeholder="Enter Password" required --}}
                                {{--                                               autocomplete="current-password"> --}}
                                {{--                                    </div> --}}
                                {{--                                </div> --}}
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">New Password</label>
                                        <input id="new_password" class="form-control" name="new_password"
                                            type="password" placeholder="Enter Password" required
                                            autocomplete="current-password">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Confirm Password</label>
                                        <input id="new_confirm_password" class="form-control"
                                            name="password_confirmation" type="password"
                                            placeholder="Enter Confirm Password" required
                                            autocomplete="current-password">

                                    </div>
                                </div>
                            </div>
                            <div class="mb-4">
                                <button type="submit" class="btn btn-primary btn-block">Update Password</button>
                            </div>
                        </form>
                    </div>

                </div>
                <div class="tab-pane" id="tab12">
                    <div class="card-body">
                        <div class="widget-user-image mx-auto text-center">

                            <img class="avatar avatar-xxl brround" alt="img"
                                src="{{ asset($User_Info->basic_info->profile_photo_path) }}">

                        </div>
                        <div class="text-center mt-5">
                            <form action="{{ route('Update.Profile.Image') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="file-input-wrapper">
                                    <input type="file" id="myFile" name="Profile_Image" class="file-input"
                                        accept="*/Images" required>
                                    <label for="myFile" class="file-input-label">upload file</label>
                                </div>
                                <button class="btn btn-light" type="submit">Update Image</button>
                            </form>
                        </div>

                    </div>

                </div>
                <div class="tab-pane" id="tab11">
                    <div class="card-body">
                        @if ((int) $Role_ID === 6 || (int) $Role_ID === 7 || (int) $Role_ID === 12)
                            <div class="table-responsive">
                                <table class="table table-vcenter text-nowrap table-bordered border-bottom"
                                    id="responsive-datatable">
                                    <thead>
                                        <tr>
                                            <th class="border-bottom-0 text-center">Order ID</th>
                                            <th class="border-bottom-0">Target Word</th>
                                            <th class="border-bottom-0">Achieve Word</th>
                                            <th class="border-bottom-0">Percentage</th>
                                            <th class="border-bottom-0">Cancel Word</th>
                                            <th class="border-bottom-0">Cancel Percentage</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (!empty($User_Performance))
                                            @forelse ($User_Performance['stats'] as $Info)
                                                @if (empty($User_Performance['bench_mark']))
                                                    @continue
                                                @endif
                                                @php
                                                    $benchMark = isset($User_Performance['bench_mark'][0]['Bench_Mark']) ? $User_Performance['bench_mark'][0]['Bench_Mark'] : 0;
                                                @endphp
                                                <tr>
                                                    <td class="text-center">
                                                        {{ $Info['order_info']['Order_ID'] }}
                                                    </td>
                                                    <td>
                                                        {{ number_format((float) $benchMark) }}
                                                    </td>
                                                    <td>
                                                        {{ number_format($Info['Completed']) }}
                                                    </td>
                                                    <td>
                                                        {{ PortalHelpers::getPercentage((float) $Info['Completed'], (float) $benchMark) }}
                                                    </td>
                                                    <td>
                                                        {{ (float) $Info['Canceled'] }}
                                                    </td>
                                                    <td>
                                                        {{ PortalHelpers::getPercentage((float) $Info['Canceled'], $Info['Completed']) }}
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="6">
                                                        No Records are Available!
                                                    </td>
                                                </tr>
                                            @endforelse
                                        @endif
                                    </tbody>

                                </table>
                            </div>
                        @endif
                        @if ((int) $Role_ID === 5)
                            <div class="table-responsive">
                                <table class="table table-vcenter text-nowrap table-bordered border-bottom"
                                    id="responsive-datatable">
                                    <thead>
                                        <tr>
                                            <th class="border-bottom-0 text-center">EMP ID</th>
                                            <th class="border-bottom-0 text-center">Name</th>
                                            <th class="border-bottom-0 text-center">Order ID</th>
                                            <th class="border-bottom-0">Target Word</th>
                                            <th class="border-bottom-0">Achieve Word</th>
                                            <th class="border-bottom-0">Percentage</th>
                                            <th class="border-bottom-0">Cancel Word</th>
                                            <th class="border-bottom-0">Cancel Percentage</th>
                                            <th class="border-bottom-0">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (!empty($User_Performance))
                                            @forelse ($User_Performance as $user)
                                                @if (isset($user->writers) && count($user->writers) > 0)
                                                    @foreach ($user->writers as $key => $writer)
                                                        @if (empty($writer['assign_task'][$key]['stats']['Completed']) || empty($writer['bench_mark']))
                                                            @continue
                                                        @endif
                                                        @php
                                                            $benchMark = isset($writer['bench_mark'][0]['Bench_Mark']) ? number_format($writer['bench_mark'][0]['Bench_Mark']) : 0;
                                                        @endphp
                                                        <tr>
                                                            <td class="text-center">
                                                                {{ $writer['EMP_ID'] }}
                                                            </td>
                                                            <td class="text-center">
                                                                {{ $writer->basic_info->full_name }}
                                                            </td>
                                                            <td class="text-center">
                                                                {{ $writer['assign_task'][$key]['order_info']['Order_ID'] }}
                                                            </td>
                                                            <td>
                                                                {{ $benchMark }}
                                                            </td>
                                                            <td>
                                                                {{ number_format($writer['assign_task'][$key]['stats']['Completed']) }}
                                                            </td>
                                                            <td>
                                                                {{ PortalHelpers::getPercentage($writer['assign_task'][$key]['stats']['Completed'], (float) $benchMark) }}
                                                            </td>
                                                            <td>
                                                                {{ number_format($writer['assign_task'][$key]['stats']['Canceled']) }}
                                                            </td>
                                                            <td>
                                                                {{ PortalHelpers::getPercentage($writer['assign_task'][$key]['stats']['Canceled'], $writer['assign_task'][$key]['stats']['Completed']) }}
                                                            </td>
                                                            <td>
                                                                <div class="d-flex">
                                                                    <a href="{{ route('User.Performance', ['EMP_ID' => $writer['EMP_ID'], 'Role_ID' => $writer['Role_ID']]) }}"
                                                                        class="action-btns1" data-bs-toggle="tooltip"
                                                                        data-bs-placement="top" title="View">
                                                                        <i
                                                                            class="feather feather-eye text-primary"></i>
                                                                    </a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            @empty
                                                <tr>
                                                    <td colspan="6">
                                                        No Records are Available!
                                                    </td>
                                                </tr>
                                            @endforelse
                                        @endif
                                    </tbody>

                                </table>
                            </div>
                        @endif
                        @if ((int) $Role_ID === 4)
                            <div class="table-responsive">
                                <table class="table table-vcenter text-nowrap table-bordered border-bottom"
                                    id="responsive-datatable">
                                    <thead>
                                        <tr>
                                            <th class="border-bottom-0 text-center">No</th>
                                            <th class="border-bottom-0">Name</th>
                                            <th class="border-bottom-0">Target Word</th>
                                            <th class="border-bottom-0">Achieve Word</th>
                                            <th class="border-bottom-0">Percentage</th>
                                            <th class="border-bottom-0">Cancel Word</th>
                                            <th class="border-bottom-0">Cancel Percentage</th>
                                            <th class="border-bottom-0">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (!empty($User_Performance))
                                            @forelse($User_Performance as $Info)
                                                <tr>
                                                    <td class="text-center">{{ $Info['EMP_ID'] }}</td>
                                                    <td>
                                                        {{ $Info['Name'] }}
                                                    </td>
                                                    <td>
                                                        {{ number_format($Info['Assign_Words']) }}
                                                    </td>
                                                    <td>
                                                        {{ number_format($Info['Achieve_Words']) }}
                                                    </td>
                                                    <td>
                                                        {{ PortalHelpers::getPercentage($Info['Achieve_Words'], $Info['Assign_Words']) }}
                                                    </td>
                                                    <td>
                                                        {{ number_format($Info['Cancel_Words']) }}
                                                    </td>
                                                    <td>
                                                        {{ PortalHelpers::getPercentage($Info['Cancel_Words'], $Info['Achieve_Words']) }}
                                                    </td>
                                                    <td>
                                                        <div class="d-flex">
                                                            <a href="{{ route('User.Performance', ['EMP_ID' => $Info['EMP_ID'], 'Role_ID' => 5]) }}"
                                                                class="action-btns1" data-bs-toggle="tooltip"
                                                                data-bs-placement="top" title="View"><i
                                                                    class="feather feather-eye  text-primary"></i>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="6">
                                                        No Records are Available!
                                                    </td>
                                                </tr>
                                            @endforelse
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        @endif
                        @if ((int) $Role_ID === 15)
                            <div class="table-responsive">
                                <table class="table table-vcenter text-nowrap table-bordered border-bottom"
                                    id="responsive-datatable">
                                    <thead>
                                        <tr>
                                            <th class="border-bottom-0 text-center">No</th>
                                            <th class="border-bottom-0">Name</th>
                                            <th class="border-bottom-0">Target Hiring</th>
                                            <th class="border-bottom-0">Achieve Hiring</th>
                                            <th class="border-bottom-0">Percentage</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($User_Performance as $Info)
                                            @if ($Info->bench_mark->isEmpty())
                                                @continue
                                            @endif
                                            @php
                                                $benchMark = isset($Info->bench_mark[0]['Bench_Mark']) ? $Info->bench_mark[0]['Bench_Mark'] : 0;
                                            @endphp
                                            <tr>
                                                <td class="text-center">{{ $Info->EMP_ID }}</td>
                                                <td>{{ $Info->basic_info->full_name }}</td>
                                                <td>{{ $benchMark }}</td>
                                                <td>{{ number_format($Info->users_count) }}</td>
                                                <td>{{ PortalHelpers::getPercentage($Info->users_count, $benchMark) }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="tab-pane" id="tab14">
                    @if (Auth::guard('Authorized')->user()->Role_ID === 1 || Auth::guard('Authorized')->user()->Role_ID === 2)
                        <div class="card">
                            <div class="card-header border-0">
                                <h4 class="card-title">Assign Benchmark</h4>
                            </div>
                            <form action="{{ route('Assigned.Target') }}" method="POST">
                                @csrf
                                <div class="card-body">
                                    <div class="leave-types">
                                        <div class="row">
                                            <input type="text" name="Emp_ID" class="form-control"
                                                value="{{ $User_Info->id }}" hidden>
                                            <div class="col-xl-3">
                                                <div class="form-group">
                                                    <label class="form-label">Employee ID</label>
                                                    <input type="text" name="Employee_ID" class="form-control"
                                                        value="{{ $User_Info->EMP_ID }}" readonly>
                                                </div>
                                            </div>
                                            <div class="col-xl-3">
                                                <div class="form-group">
                                                    <label class="form-label">Targets</label>
                                                    <input type="text" name="Benchmark" class="form-control"
                                                        placeholder="Enter Benchmark">
                                                </div>
                                            </div>
                                            <div class="col-xl-3">
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-primary w-100 mt-5">Assigned
                                                        Benchmark
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    @endif
                    <div class="card">
                        <div class="card-header  border-0">
                            <h4 class="card-title">Assigned Benchmark List</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered text-nowrap border-bottom text-center"
                                    id="responsive-datatable-2">
                                    <thead>
                                        <tr>
                                            <th class="border-bottom-0">S.No</th>
                                            <th class="border-bottom-0">Employee Name</th>
                                            <th class="border-bottom-0">Domain</th>
                                            <th class="border-bottom-0">Assigned Target</th>
                                            <th class="border-bottom-0">Created At</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($Benchmark_List as $Benchmark)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td class="">{{ $Benchmark->user->basic_info->full_name }}</td>
                                                <td class="">
                                                    {{ $Benchmark->user->basic_info->department->Department_Name }}
                                                </td>
                                                <td class="">{{ $Benchmark->Bench_Mark }}</td>
                                                <td class="">{{ $Benchmark->created_at }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="tab13">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-vcenter text-nowrap table-bordered border-bottom"
                                id="responsive-datatable">
                                <thead>
                                    <tr>
                                        <th class="border-bottom-0 ">S.No</th>
                                        <th class="border-bottom-0 ">Date</th>
                                        <th class="border-bottom-0">Time</th>
                                        <th class="border-bottom-0">Ip Address</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($loginHistory as $history)
                                        <tr>
                                            <td>
                                                {{ $loop->iteration }}
                                            </td>
                                            <td>
                                                {{ date('F d, Y', strtotime($history->created_at)) }}
                                            </td>
                                            <td>
                                                {{ date('H:i:s A', strtotime($history->created_at)) }}
                                            </td>
                                            <td>
                                                {{ $history->ip_address }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- End Row-->

<script>
    $(document).ready(function() {

        const Probation_Div = $('.Probation-Div');

        // Initial check based on EMP_Status
        var EMP_Status = $('.EMP_Status').val();
        if (EMP_Status === '1') {
            Probation_Div.show();
            Probation_Div.prop('required', true);
        } else {
            Probation_Div.hide();
            Probation_Div.prop('required', false);
        }

        // Change event handler for EMP_Status
        $('.EMP_Status').change(function() {
            const Status = $(this).val();
            if (Status === '1') {
                Probation_Div.show();
                Probation_Div.prop('required', true);
            } else {
                Probation_Div.hide();
                Probation_Div.prop('required', false);
            }
        });
    });
</script>
