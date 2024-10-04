<!--Page header-->
<div class="page-header d-xl-flex d-block">
    <div class="page-leftheader">
        <h4 class="page-title">Mark Attendance</h4>
    </div>

</div>
<!--End Page header-->
<!-- Row -->
<div class="row">
    <div class="col-xl-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-body">
                <form method="get" action="">
                    <div class="row">
                        <div class="col-md-12 col-lg-3">
                            <div class="form-group">
                                <label class="form-label">Select Date:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                    </div><input class="form-control" type="date" name="date"
                                        value="{{ request('date') }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-3 mt-5">
                            <button class="btn btn-primary" type="submit">Submit</button>
                        </div>

                    </div>
                </form>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="hr-checkall">

                        </div>
                    </div>
                </div>
                <div class="table-responsive" id="Marked-Attandence-Table">
                    <table class="table table-vcenter text-nowrap table-bordered border-bottom"
                        id="responsive-datatable">
                        <thead>
                            <tr>
                                <th class="border-bottom-0 w-5">#Emp ID</th>
                                <th class="border-bottom-0">Emp Name</th>
                                <th class="border-bottom-0">Status</th>
                                <th class="border-bottom-0">Clock In</th>
                                <th class="border-bottom-0">Clock Out</th>
                                <th class="border-bottom-0">IP Address</th>
                                <th class="border-bottom-0">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($UserInfo as $Info)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <div class="d-flex">
                                            <span class="avatar avatar-md brround me-3"
                                                style="background-image: url(../../assets/images/users/1.jpg)"></span>
                                            <div class="me-3 mt-0 mt-sm-1 d-block">
                                                <h6 class="mb-1 fs-14">{{ $Info->basic_info->full_name }}</h6>
                                            </div>
                                        </div>
                                    </td>

                                    @if ($Info->attendance->isEmpty())
                                        <td>
                                            <span>Not Marked</span>
                                        </td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                    @else
                                   
                                        @foreach ($Info->attendance as $attendance)
                                            <td>
                                                <span>
                                            {{ $attendance->status }}
                                                </span>

                                            </td>
                                            <td>{{ $attendance->check_in ?? '-' }}</td>
                                            <td>{{ $attendance->check_out ?? '-' }}</td>
                                            <td>{{ $attendance->ip_address ?? '-' }}</td>
                                        @endforeach
                                    @endif


                                    <td>
                                        <div class="d-flex">
                                            <label class="custom-control custom-checkbox-md">
                                                <input type="checkbox" data-id="{{ $Info->id }}"
                                                    class="custom-control-input-success" name="Mark-Attandence"
                                                    value="option1" id="Mark-Attandence">

                                                <span class="custom-control-label-md success"></span>
                                            </label>

                                        </div>
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
<!-- End Row-->

<!--Present Modal1 -->
<div class="modal fade" id="presentmodal1">
    <div class="modal-dialog" role="document">
        <form action="{{ route('Update.Attendance') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Mark Attendance</h5>
                    <button class="btn-close" data-bs-dismiss="modal" aria-label="Close" type="button">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="form-group">
                                <label class="form-label">Shift Start Time</label>
                                <input type="time" id="Shift-Start" name="Shift_Start" class="form-control">
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="form-group">
                                <label class="form-label">Shift End Time</label>
                                <input type="time" id="Shift-End" name="Shift_End" class="form-control">
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="form-group">
                                <input type="hidden" id="User_ID" name="User_ID">
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="form-group">
                                <input type="hidden" id="date" name="date" value="{{ request('date') }}">
                            </div>
                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-outline-primary" data-bs-dismiss="modal">close</a>

                    <button type="submit" class="btn btn-info" name="half-day">Mark HalfDay</button>

                    <button type="submit" class="btn btn-primary" name="mark_new">Mark Attendance</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- End Present1 Modal  -->
<script src="{{ asset('assets/js/hr/hr-attmark.js') }}"></script>
<script>
    $(document).on('change', 'input[name="Mark-Attandence"]', function() {
        if ($(this).is(':checked')) {
            var EMP_ID = $(this).data('id');
            GetEmployeeAttandence();
        }

        function GetEmployeeAttandence() {
            $.ajax({
                url: "{{ route('Get.Employee.Attendance') }}",
                method: 'GET',
                data: {
                    EMP_Id: EMP_ID
                },
                success: function(response) {
                    $('#Shift-Start').val(response['shift_start'])
                    $('#Shift-End').val(response['shift_end'])
                    $('#User_ID').val(response['user_id'])
                    $('#presentmodal1').modal('show');
                },
                error: function(xhr, status, error) {
                    console.log(error);
                }
            });
        }
    });

    $(document).on('change', '#Mark-Attandance-Date', function() {
        var selectedDate = $(this).val();
        var formattedDate = moment(selectedDate, 'DD-MM-YYYY').format('YYYY-MM-DD');

        $.ajax({
            url: "{{ route('Get.Mark.Attendance') }}",
            method: 'GET',
            data: {
                date: formattedDate
            },
            success: function(response) {
                $('#Marked-Attandence-Table').html(response);
                $('#date').val(formattedDate)
            },
            error: function(xhr, status, error) {
                console.log(error);
            }
        });
    });
</script>
