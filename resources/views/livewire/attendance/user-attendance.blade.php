<!--Page header-->
<div class="page-header d-xl-flex d-block">
    <div class="page-leftheader">
        <h4 class="page-title">My Attendance</h4>
    </div>
</div>
<!--End Page header-->
@php
    $currentMonth = date('m');
    $currentYear = date('Y');
    $numberOfDays = cal_days_in_month(CAL_GREGORIAN, $currentMonth, $currentYear);
    $attendanceData = [];

    // Initialize the attendance data array
    for ($day = 1; $day <= $numberOfDays; $day++) {
        $dateString = date('F d, Y', strtotime("$currentYear-$currentMonth-$day"));
        $attendanceData[$dateString] = [
            'date' => $dateString,
            'status' => '',
            'check_in' => '',
            'check_out' => '',
            'completed_hours' => '',
            'attend_id' => '',
        ];
    }
    // Populate the attendance data
    foreach ($User_Attendance as $attendance) {
        $dateString = date('F d, Y', strtotime($attendance['created_at']));
        $attendanceData[$dateString]['status'] = $attendance['status'];
        $attendanceData[$dateString]['check_in'] = $attendance['check_in'];
        $attendanceData[$dateString]['check_out'] = $attendance['check_out'];
        $attendanceData[$dateString]['completed_hours'] = $attendance['total_time'];
        $attendanceData[$dateString]['attend_id'] = $attendance['attend_id'];
    }
@endphp
@php

    $Month = \Carbon\Carbon::parse('1 ' . request('Month'))->format('m');
    // $currentMonth = date('m');
    $currentYear = date('Y');
    $numberOfDays = cal_days_in_month(CAL_GREGORIAN, $Month, $currentYear);
    $FilterattendanceData = [];

    // Initialize the attendance data array
    for ($day = 1; $day <= $numberOfDays; $day++) {
        $dateString = date('F d, Y', strtotime("$currentYear-$Month-$day"));
        // dd($dateString);
        $FilterattendanceData[$dateString] = [
            'date' => $dateString,
            'status' => '',
            'check_in' => '',
            'check_out' => '',
            'completed_hours' => '',
            'attend_id' => '',
        ];
    }
    // Populate the attendance data
    foreach ($Filter_User_Attendance as $attendance) {
        $dateString = date('F d, Y', strtotime($attendance['created_at']));
        $FilterattendanceData[$dateString]['status'] = $attendance['status'];
        $FilterattendanceData[$dateString]['check_in'] = $attendance['check_in'];
        $FilterattendanceData[$dateString]['check_out'] = $attendance['check_out'];
        $FilterattendanceData[$dateString]['completed_hours'] = $attendance['total_time'];
        $FilterattendanceData[$dateString]['attend_id'] = $attendance['attend_id'];
    }
  
@endphp
<!-- Row -->
<div class="row">
    <div class="col-xl-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header  border-0">
                <h4 class="card-title">Days Overview This Month</h4>
            </div>
            <div class="card-body pt-0 pb-3">

                @if (request()->has('Month'))
                    <div class="row mb-0 pb-0">
                        <div class="col-md-6 col-xl-2 text-center py-5">
                            <span
                                class="avatar avatar-md bradius fs-20 bg-primary-transparent">{{ $numberOfDays }}</span>
                            <h5 class="mb-0 mt-3">Total Working Days</h5>
                        </div>
                        <div class="col-md-6 col-xl-2 text-center py-5 ">
                            <span
                                class="avatar avatar-md bradius fs-20 bg-success-transparent">{{ $Filter_User_Attendance_Counter['Present_Count'] }}</span>
                            <h5 class="mb-0 mt-3">Present Days</h5>
                        </div>
                        <div class="col-md-6 col-xl-2 text-center py-5">
                            <span
                                class="avatar avatar-md bradius fs-20 bg-danger-transparent">{{ $Filter_User_Attendance_Counter['Absent_Count'] }}</span>
                            <h5 class="mb-0 mt-3">Absent Days</h5>
                        </div>
                        <div class="col-md-6 col-xl-2 text-center py-5">
                            <span
                                class="avatar avatar-md bradius fs-20 bg-warning-transparent">{{ $Filter_User_Attendance_Counter['Half_Day_Count'] }}</span>
                            <h5 class="mb-0 mt-3">Half Days</h5>
                        </div>
                        <div class="col-md-6 col-xl-2 text-center py-5 ">
                            <span
                                class="avatar avatar-md bradius fs-20 bg-orange-transparent">{{ $Filter_User_Attendance_Counter['Late_Count'] }}</span>
                            <h5 class="mb-0 mt-3">Late Days</h5>
                        </div>
                    </div>
                @else
                    <div class="row mb-0 pb-0">
                        <div class="col-md-6 col-xl-2 text-center py-5">
                            <span
                                class="avatar avatar-md bradius fs-20 bg-primary-transparent">{{ $numberOfDays }}</span>
                            <h5 class="mb-0 mt-3">Total Working Days</h5>
                        </div>
                        <div class="col-md-6 col-xl-2 text-center py-5 ">
                            <span
                                class="avatar avatar-md bradius fs-20 bg-success-transparent">{{ $User_Attendance_Counter['Present_Count'] }}</span>
                            <h5 class="mb-0 mt-3">Present Days</h5>
                        </div>
                        <div class="col-md-6 col-xl-2 text-center py-5">
                            <span
                                class="avatar avatar-md bradius fs-20 bg-danger-transparent">{{ $User_Attendance_Counter['Absent_Count'] }}</span>
                            <h5 class="mb-0 mt-3">Absent Days</h5>
                        </div>
                        <div class="col-md-6 col-xl-2 text-center py-5">
                            <span
                                class="avatar avatar-md bradius fs-20 bg-warning-transparent">{{ $User_Attendance_Counter['Half_Day_Count'] }}</span>
                            <h5 class="mb-0 mt-3">Half Days</h5>
                        </div>
                        <div class="col-md-6 col-xl-2 text-center py-5 ">
                            <span
                                class="avatar avatar-md bradius fs-20 bg-orange-transparent">{{ $User_Attendance_Counter['Late_Count'] }}</span>
                            <h5 class="mb-0 mt-3">Late Days</h5>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
<!-- End Row-->
<!-- Row -->
<div class="row">
    <div class="col-xl-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header border-bottom-0 d-flex justify-content-between">
                <div class="card-title">Attendance Overview</div>
                <div class="btn-group mt-2 mb-2">
                    <button class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        Filters <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        {{-- <li><a href="{{ route('My.Attendance', ['User_ID' => Auth::guard('Authorized')->user()->id]) }}">All</a></li> --}}
                        @for ($i = 1; $i <= 12; $i++)
                            @php
                                $monthName = \Carbon\Carbon::create(null, $i, 1)->format('F');
                            @endphp
                            <li><a
                                    href="{{ route('My.Attendance', ['User_ID' => Auth::guard('Authorized')->user()->id, 'Month' => $monthName]) }}">{{ $monthName }}</a>
                            </li>
                        @endfor
                    </ul>


                </div>

            </div>

            <div class="card-body">
                <div class="table-responsive">

                    @if (request()->has('Month'))

                        <table class="table table-vcenter text-nowrap table-bordered border-bottom" id="hr-attendance">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0 w-8">S.No.</th>
                                    <th class="border-bottom-0">Date</th>
                                    <th class="border-bottom-0">Status</th>
                                    <th class="border-bottom-0">Check-In</th>
                                    <th class="border-bottom-0">Check-Out</th>
                                    <th class="border-bottom-0">Completed Hours</th>
                                    {{-- <th class="border-bottom-0">Actions</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($FilterattendanceData as $attendance)
                                    @php
                                        $checkIn = $attendance['check_in'] ? Carbon\Carbon::parse($attendance['check_in'])->format('h:i A') : '-';
                                        $checkOut = $attendance['check_out'] ? Carbon\Carbon::parse($attendance['check_out'])->format('h:i A') : '-';
                                        $totalTime = !empty($attendance['completed_hours']) ? date('H:i:s', strtotime($attendance['completed_hours'])) : '-';
                                        $date = isset($attendance['date']) ? $attendance['date'] : null;
                                    @endphp
                                    <tr>
                                        <td><strong>{{ $loop->iteration }}</strong></td>
                                        <td>{{ $date }}</td>
                                        <td>
                                              <span>
                                                  {{ $attendance['status'] }}
                                                </span>
                                            
                                        </td>
                                        <td>{{ $checkIn }}</td>
                                        <td>{{ $checkOut }}</td>
                                        <td>{{ $totalTime }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <table class="table table-vcenter text-nowrap table-bordered border-bottom" id="hr-attendance">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0 w-8">S.No.</th>
                                    <th class="border-bottom-0">Date</th>
                                    <th class="border-bottom-0">Status</th>
                                    <th class="border-bottom-0">Check-In</th>
                                    <th class="border-bottom-0">Check-Out</th>
                                    <th class="border-bottom-0">Completed Hours</th>
                                    {{--<th class="border-bottom-0">Actions</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($attendanceData as $attendance)
                                    
                                    @php

                                        $checkIn = $attendance['check_in'] ? Carbon\Carbon::parse($attendance['check_in'])->format('h:i A') : '-';
                                        $checkOut = $attendance['check_out'] ? Carbon\Carbon::parse($attendance['check_out'])->format('h:i A') : '-';
                                        $totalTime = !empty($attendance['completed_hours']) ? date('H:i:s', strtotime($attendance['completed_hours'])) : '-';
                                        $date = isset($attendance['date']) ? $attendance['date'] : null;
                                    @endphp
                                    <tr>
                                        <td><strong>{{ $loop->iteration }}</strong></td>
                                        <td>{{ $date }}</td>
                                        
                                        <td>
                                            
                                            <span>
                                                {{ $attendance['status']}}
                                            </span>
                                        </td>
                                        <td>{{ $checkIn }}</td>
                                        <td>{{ $checkOut }}</td>
                                        <td>{{ $totalTime }}</td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif

                </div>

            </div>
        </div>
    </div>
</div>
<!--Edit Modal -->
<div class="modal fade" id="editmodal">
    <div class="modal-dialog" role="document">
        <form action="" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Attendance Details</h5>
                    <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label class="form-label">Clock In</label>
                                <div class="input-group">
                                    <input type="text" class="form-control timepicker" id="Present_Check_In"
                                        value="9:30 AM">
                                    <div class="input-group-text">
                                        <i class="fa fa-clock-o"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="custom-switch mt-md-6">
                                <input type="checkbox" name="custom-switch-checkbox"
                                    class="custom-switch-input orange">
                                <span class="custom-switch-indicator "></span>
                                <span class="custom-switch-description text-dark">Late</span>
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label class="form-label">Clock Out</label>
                                <div class="input-group">
                                    <input type="text" class="form-control timepicker" id="Present_Check_Out"
                                        value="06: 30 PM">
                                    <div class="input-group-text">
                                        <i class="fa fa-clock-o"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="custom-switch mt-md-6">
                                <input type="checkbox" name="custom-switch-checkbox"
                                    class="custom-switch-input  orange">
                                <span class="custom-switch-indicator"></span>
                                <span class="custom-switch-description text-dark">half Day</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">IP Address</label>
                        <input type="text" class="form-control" id="Present_IP" placeholder="225.192.145.1"
                            disabled>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Working Form</label>
                        <select name="projects" class="form-control custom-select select2" disabled
                            data-placeholder="Select">
                            <option label="Select"></option>
                            <option value="1" selected>Office</option>
                            <option value="2">Home</option>
                            <option value="3">Others</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer d-flex">
                    <div class="ms-auto">
                        <a href="#" class="btn btn-primary">Save</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- End Edit Modal  -->
<script src="{{ asset('assets/js/employee/emp-attendance.js') }}"></script>
<script>
    $(document).ready(function() {

        /* When click on Present */
        $('.Present-Modal').click(function() {
            var userURL = $(this).data('url');
            $.get(userURL, function(data) {
                $('#editmodal').modal('show');
                $('#Present_Check_In').html(data.check_in);
                $('#Present_Check_Out').text(data.check_out);
                $('#Present_Total_hrs').text(data.total_time);
                $('#Present_IP').val(data.ip_address);
            })
        });

    });
</script>
