<div class="page-header d-xl-flex d-block">
    <div class="page-leftheader">
        <h4 class="page-title">Overall Attendance</h4>
    </div>
</div>
<div class="card">
    <!--<div class="card-body">-->
    <!--    <div class="row mt-5">-->
    <!--        <div class="col-md-6 col-lg-3">-->
    <!--            <div class="form-group">-->
    <!--                <label class="form-label">Employee Name:</label>-->
    <!--                <select class="form-control custom-select select2" data-placeholder="Select Employee">-->
    <!--                    <option label="Select Employee"></option>-->
    <!--                    <option value="1">Faith Harris</option>-->
    <!--                </select>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--        <div class="col-md-6 col-lg-3">-->
    <!--            <div class="form-group">-->
    <!--                <label class="form-label">Month:</label>-->
    <!--                <select class="form-control custom-select select2" data-placeholder="Select Month">-->
    <!--                    <option label="Select Month"></option>-->
    <!--                    <option value="1">January</option>-->
    <!--                    <option value="2">February</option>-->
    <!--                    <option value="3">March</option>-->
    <!--                    <option value="4">April</option>-->
    <!--                    <option value="5">May</option>-->
    <!--                    <option value="6">June</option>-->
    <!--                    <option value="7">July</option>-->
    <!--                    <option value="8">August</option>-->
    <!--                    <option value="9">September</option>-->
    <!--                    <option value="10">October</option>-->
    <!--                    <option value="11">November</option>-->
    <!--                    <option value="12">December</option>-->
    <!--                </select>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--        <div class="col-md-6 col-lg-3">-->
    <!--            <div class="form-group">-->
    <!--                <label class="form-label">Year:</label>-->
    <!--                <select class="form-control custom-select select2" data-placeholder="Select Year">-->
    <!--                    <option label="Select Year"></option>-->
    <!--                    <option value="1">2024</option>-->
    <!--                    <option value="2">2023</option>-->
    <!--                    <option value="3">2022</option>-->
    <!--                    <option value="4">2021</option>-->
    <!--                    <option value="5">2020</option>-->
    <!--                    <option value="6">2019</option>-->
    <!--                    <option value="7">2018</option>-->
    <!--                    <option value="8">2017</option>-->
    <!--                    <option value="9">2016</option>-->
    <!--                    <option value="10">2015</option>-->
    <!--                    <option value="11">2014</option>-->
    <!--                    <option value="12">2013</option>-->
    <!--                    <option value="13">2012</option>-->
    <!--                    <option value="14">2011</option>-->
    <!--                    <option value="15">2019</option>-->
    <!--                    <option value="16">2010</option>-->
    <!--                </select>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--        <div class="col-md-6 col-lg-3">-->
    <!--            <div class="form-group mt-5">-->
    <!--                <a href="#" class="btn btn-primary btn-block">Search</a>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</div>-->
    <div class="card-body">
        <div class="d-flex mb-6 mt-5">
            <div class="me-3">
                <label class="form-label">Note:</label>
            </div>
            <div>
                <span class="badge badge-success-light me-2"><i class="feather feather-check-circle text-success"></i> ---> Present</span>
                <span class="badge badge-danger-light me-2"><i class="feather feather-x-circle text-danger"></i> ---> Absent</span>
                <span class="badge badge-warning-light me-2"><i class="fa fa-star text-warning"></i> ---> Sunday</span>
                <span class="badge badge-orange-light me-2"><i
                        class="fa fa-adjust text-orange"></i> ---> Half Day</span>
            </div>
        </div>
        <div class="table-responsive hr-attlist">
            @php
    $currentMonth = date('m');
    $currentYear = date('Y');
    $firstDayOfMonth = \Carbon\Carbon::create($currentYear, $currentMonth, 1);
    $numberOfDays = $firstDayOfMonth->daysInMonth;
    $present = 0;
@endphp

<table class="table table-vcenter text-nowrap table-bordered border-bottom" id="hr-attendance">
    <thead>
        <tr>
            <th class="border-bottom-0">Employee Name</th>
            @for($day = 1; $day <= $numberOfDays; $day++)
                <th class="border-bottom-0 w-5">{{ $day }}</th>
            @endfor
            <th class="border-bottom-0">Total</th>
        </tr>
    </thead>
    <tbody>
        @foreach($User_Attendance as $User)
            <tr>
                <td>
                    <div class="d-flex">
                        <span class="avatar avatar brround me-3"
                              style="background-image: url({{ !empty($User->basic_info->profile_photo_path) ? asset($User->basic_info->profile_photo_path) : asset('assets/images/users/16.jpg') }})"></span>
                        <div class="me-3 mt-0 mt-sm-2 d-block">
                            <h6 class="mb-1 fs-14">
                                <a href="{{ route('My.Attendance', ['User_ID' => $User->id]) }}">
                                    {{ $User->basic_info->full_name }}
                                </a>
                            </h6>
                        </div>
                    </div>
                </td>
          @for ($day = 1; $day <= $numberOfDays; $day++)
    @php
        $dateString = "{$currentYear}-{$currentMonth}-{$day}";
        $date = \Carbon\Carbon::parse($dateString);
        $attendanceFound = false;
    @endphp

    <td>
        @foreach ($User->attendance as $attend)
            @php
                $attendDate = \Carbon\Carbon::parse($attend['created_at'])->format('d');
            @endphp
            @if ((int)$attendDate === $day)
                @if ($attend['status'] === 'Present')
                    <div class="hr-listd">
                        <a href="#" class="hr-listmodal Present-Modal"
                           data-url="{{ route('Get.Attend.Info', ['Attend_ID' => $attend->id]) }}"></a>
                        <span class="feather feather-check-circle text-success"></span>
                    </div>
                    @php $present++; @endphp
                @elseif ($attend['status'] === 'Late')
                    <div class="hr-listd">
                        <a href="#" class="hr-listmodal Present-Modal"
                           data-url="{{ route('Get.Attend.Info', ['Attend_ID' => $attend->id]) }}"></a>
                        <span class="feather feather-check-circle text-danger"></span>
                    </div>
                @elseif ($attend['status'] === 'Absent')
                    <span class="feather feather-x-circle text-danger"></span>
                    @php $attendanceFound = true; break; @endphp
                @elseif ($attend['status'] === 'Half-Day')
                    <div class="hr-listd">
                        <a href="javascript:void(0);"
                           data-url="{{ route('Get.Attend.Info', ['Attend_ID' => $attend->id]) }}"
                           class="hr-listmodal Present-Modal"></a>
                        <span class="fa fa-adjust text-orange"></span>
                    </div>
                @endif
                @php $attendanceFound = true; @endphp
            @endif
        @endforeach

        @if (!$attendanceFound)
            @if ($date->isoWeekday() === 7) {{-- Sunday --}}
                <span class="fa fa-star text-warning" data-bs-toggle="tooltip" data-bs-placement="top" title="Sunday"></span>
            @elseif($date->isPast())
                <span class="feather feather-x-circle text-danger"></span>
            @else
                --
            @endif
        @endif
    </td>
@endfor

                <td>
                    <h6 class="mb-0">
                        <span class="text-primary">{{ $present }}</span>
                        <span class="my-auto fs-8 font-weight-normal text-muted">/</span>
                        <span>{{ $numberOfDays }}</span>
                    </h6>
                </td>
            </tr>
            @php $present = 0; @endphp
        @endforeach
    </tbody>
</table>

           
        </div>
    </div>
</div>

<!-- End Edit Modal  -->
<!--Present Modal -->
<div class="modal fade" id="presentmodal">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Attendance Details</h5>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row mb-5 mt-4">
                    <div class="col-md-4">
                        <div class="pt-5 text-center">
                            <h6 class="mb-1 fs-16 font-weight-semibold" id="Present_Check_In">09:30 AM</h6>
                            <small class="text-muted fs-14">Check In</small>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="chart-circle chart-circle-md" data-value="100" data-thickness="6"
                             data-color="#0dcd94">
                            <div class="chart-circle-value text-muted" id="Present_Total_hrs">09:00 hrs</div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="pt-5 text-center">
                            <h6 class="mb-1 fs-16 font-weight-semibold" id="Present_Check_Out"> 06:30 PM</h6>
                            <small class="text-muted fs-14">Check Out</small>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">IP Address</label>
                    <input type="text" class="form-control" id="Present_IP" placeholder="225.192.145.1" disabled>
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
            <div class="modal-footer">
                <button type="button" class="btn btn-primary w-100" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- End Present Modal  -->

<!--Edit Modal -->
<div class="modal fade" id="editmodal">
    <div class="modal-dialog" role="document">
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
                                <input type="text" class="form-control timepicker" value="9:30 AM">
                                <div class="input-group-text">
                                    <i class="fa fa-clock-o"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="custom-switch mt-md-6">
                            <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input orange">
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
                                <input type="text" class="form-control timepicker" value="06: 30 PM">
                                <div class="input-group-text">
                                    <i class="fa fa-clock-o"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="custom-switch mt-md-6">
                            <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input  orange">
                            <span class="custom-switch-indicator"></span>
                            <span class="custom-switch-description text-dark">half Day</span>
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">IP Address</label>
                    <input type="text" class="form-control" placeholder="225.192.145.1" disabled>
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
                <div>
                    <a href="#" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#presentmodal"
                       data-bs-dismiss="modal"><i class="feather feather-arrow-left me-1"></i>Back</a>
                </div>
                <div class="ms-auto">
                    <a href="#" class="btn btn-outline-primary" data-bs-dismiss="modal">close</a>
                    <a href="#" class="btn btn-primary">Save</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Edit Modal  -->
<script>
    $(document).ready(function () {
        $('.Present-Modal').click(function () {
            var userURL = $(this).data('url');
            $.get(userURL, function (data) {
                $('#presentmodal').modal('show');
                $('#Present_Check_In').html(data.check_in);
                $('#Present_Check_Out').text(data.check_out);
                $('#Present_Total_hrs').text(data.total_time);
                $('#Present_IP').val(data.ip_address);
            })
        });
    });
</script>
