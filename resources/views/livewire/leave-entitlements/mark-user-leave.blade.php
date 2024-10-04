<!--Page header-->
<div class="page-header d-xl-flex d-block">
    <div class="page-leftheader">
        <h4 class="page-title">Mark Leave</h4>
    </div>
    <div class="btn-list">
        <a href="#" class="btn btn-primary me-3" data-bs-toggle="modal" data-bs-target="#Add_leave">Mark Leave</a>
    </div>
</div>
<!--End Page header-->
<!-- Row -->
<div class="row">
    <div class="col-xl-12 col-md-12 col-lg-12">
        <div class="card">
           
           <div class="card-body">
                <form method="get" action="{{ route('Mark.Users.Leave', ['month' => 'month', 'year' => 'year']) }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-12 col-lg-3">
                          <div class="form-group">
                                <label class="form-label">Select Month:</label>
                             <select name="month" class="form-select">
    @for ($i = 1; $i <= 12; $i++)
        @php
        
            $monthNumber = str_pad($i, 2, '0', STR_PAD_LEFT); // Zero-padding for single digit months
            $monthName = Carbon\Carbon::createFromFormat('!m', $monthNumber)->format('F');
        @endphp
      <option value="{{ $i }}" {{ (empty(request()->query('month')) && $monthNumber == Carbon\Carbon::now()->month) ? 'selected' : (request()->query('month') == $monthNumber ? 'selected' : '') }}>
    {{ $monthName }}
</option>

        
    
        
    @endfor
</select>


                            </div>
                        </div>


                        <div class="col-md-12 col-lg-3">
                            <div class="form-group">
                                <label class="form-label">Select Year:</label>
                              <select name="year" class="form-select">
    @for ($year = date('Y'); $year <= date('Y') + 10; $year++)
        <option value="{{ $year }}" {{ request()->query('year') == $year ? 'selected' : '' }}>
            {{ $year }}
        </option>
    @endfor
</select>

                            </div>
                        </div>
                        <div class="col-3 mt-5">
                            <button class="btn btn-primary" type="submit">Submit</button>
                        </div>

                    </div>
                </form>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-vcenter text-nowrap table-bordered border-bottom"
                        id="responsive-datatable">
                        <thead>
                            <tr>
                                <th class="border-bottom-0 w-5">#Emp ID</th>
                                <th class="border-bottom-0">Emp Name</th>
                                <th class="border-bottom-0">Leave Type</th>
                                <th class="border-bottom-0">Reason</th>
                                <th class="border-bottom-0">Date</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($users as $user)
                            @foreach ($user['attendance'] as $attendance)
                            <tr>
                                @if ($loop->first)
                                <td rowspan="{{ count($user['attendance']) }}">{{ $user['EMP_ID'] }}</td>
                                <td rowspan="{{ count($user['attendance']) }}">
                                    {{ $user['basic_info']['F_Name'] }} {{ $user['basic_info']['L_Name'] }}
                                </td>
                                @endif


                                <td>{{ $attendance['status'] }}</td>

                                <td>{{ $attendance['reason'] ?: '-' }}</td>
                                <td>{{ $attendance['created_at'] }}</td>
                            </tr>
                            @endforeach
                            @endforeach
                        </tbody>
                    </table>



                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="Add_leave" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Mark leave</h5>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="{{ route('Post.Mark.Users.Leave') }}" method="POST" autocomplete="off">
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Select User:</label>
                                <select name="user_id" id="Select-User" class="form-control">
                                    @foreach ($all_user as $user)
                                    <option value="{{ $user->id }}">{{ $user->basic_info->full_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="Start_date" class="form-label">Start Date:</label>
                                <input id="Start_date" class="form-control" name="start_date" required type="date"
                                    oninput="validateLeaveInput(this)">
                            </div>

                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Select Leave Type:</label>
                                <select id="Select-Leave-Type" name="leave_type" class="form-control">
                                    @foreach ($leave_types as $leave_type)
                                    <option value="{{ $leave_type->id }}">{{ $leave_type->Leave_Type }}</option>
                                    @endforeach

                                </select>
                            </div>

                            <div class="form-group">
                                <label for="end_date" class="form-label">End Date:</label>
                                <input id="end_date" class="form-control" name="end_date" required type="date"
                                    oninput="validateLeaveInput(this)">
                            </div>

                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="Enter-Leave" class="form-label">Reason:</label>
                                <textarea name="reason" class="form-control" id="" cols="30" rows="5"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="w-100 btn btn-warning">Mark Leave</button>
                </div>
            </form>

        </div>
    </div>
</div>

<script src="{{ asset('assets/js/hr/hr-attmark.js') }}"></script>
<script>
function validateLeaveInput(inputElement) {
    let inputValue = parseInt(inputElement.value, 10);
    if (inputValue <= 0 || isNaN(inputValue)) {
        inputElement.value = null;
    }
}
</script>
