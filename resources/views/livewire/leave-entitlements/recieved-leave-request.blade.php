<!--Page header-->
<div class="page-header d-xl-flex d-block">
    <div class="page-leftheader">
        <h4 class="page-title">Leave Applications</h4>
    </div>
</div>
<!--End Page header-->
<!-- Row -->
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header border-bottom-0">
                <h4 class="card-title">Recent Earned Leave Applications</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    @forelse($Leave_Request as $Leave)
                        @if ($Leave->Leave_Status !== 'Pending')
                            @continue
                        @endif
                        @php

                            $RemainingLeave = $Leave->user->leave_quota->Sick_Leaves + $Leave->user->leave_quota->Annual_Leaves + $Leave->user->leave_quota->Casual_Leaves;
                            $Leave_Type = $Leave->leave->Leave_Type;
                            $Remainingleavetypewise = 0;
                            if ($Leave_Type == 'Annual Leave') {
                                $Remainingleavetypewise = $Leave->user->leave_quota->Annual_Leaves;
                            } elseif ($Leave_Type == 'Casual Leave') {
                                $Remainingleavetypewise = $Leave->user->leave_quota->Annual_Leaves;
                            }
                            if ($Leave_Type == 'Sick Leave') {
                                $Remainingleavetypewise = $Leave->user->leave_quota->Annual_Leaves;
                            }
                            $progressPercentage = ($RemainingLeave / $Total_Leaves) * 100;
                            $F_Date = date('F d, Y H:i:s A', strtotime($Leave->F_Date));
                            $L_Date = !empty($Leave->L_Date) ? date('F d, Y H:i:s A', strtotime($Leave->L_Date)) : null;
                        @endphp
                        <div class="col-xl-3 col-lg-6 col-md-12">
                            <div class="card border p-0 shadow-none">
                                <div class="card-header border-0">
                                    <h3 class="card-title">Earned Leave Request</h3>
                                    <div class="ms-auto">
                                        <span
                                            class="badge badge-md badge-warning-light">{{ PortalHelpers::getRemainingTime($F_Date) }}
                                            left</span>
                                    </div>
                                </div>
                                <div class="d-flex p-4">
                                    <div>
                                        <div class="avatar avatar-lg brround d-block cover-image"
                                            data-image-src="{{ !empty($Leave->user->basic_info->profile_photo_path) ? asset($Leave->user->basic_info->profile_photo_path) : asset('assets/images/users/16.jpg') }}">
                                        </div>
                                    </div>
                                    <div class="ps-3">
                                        <h5 class="mb-0 mt-2 text-dark fs-18">{{ $Leave->user->basic_info->full_name }}
                                        </h5>
                                        <p class="text-muted fs-12 mt-1 mb-0">
                                            {{ $Leave->user->designation->Designation_Name }}</p>
                                    </div>
                                </div>
                                <div class="card-body pt-2 bg-light">
                                    <div class="mt-3 mb-3">
                                        <div class="h5 mb-1">
                                            <span class="feather feather-calendar"></span>
                                            : {{ date('M d, Y', strtotime($Leave->F_Date)) }}
                                            @if (empty($Leave->L_Date))
                                                <span class="badge badge-md badge-primary-light ms-1">1 day</span>
                                            @endif
                                            @if (!empty($Leave->L_Date))
                                                <span class="text-muted leave-to">To</span>
                                                {{ date('M d, Y', strtotime($Leave->L_Date)) }}
                                                <span
                                                    class="badge badge-md badge-primary-light ms-1">{{ PortalHelpers::getRemainingTime($F_Date, $L_Date) }}</span>
                                            @endif

                                        </div>
                                        <small class="text-muted fs-11">
                                            Applied On: <b>{{ $Leave->created_at }}</b>
                                            On<span class="font-weight-semibold">
                                                {{ PortalHelpers::getRemainingTime($Leave->created_at) }} ago</span>
                                        </small>
                                    </div>
                                    <div class="progress progress-sm mb-2">
                                        <div class="progress-bar bg-success"
                                            style="min-width: {{ (int) $progressPercentage }}%;"></div>
                                    </div>
                                    <div class="d-flex align-items-end justify-content-between mb-0">
                                        <h6 class="fs-12 mb-0">Remaining Leaves</h6>
                                        <h6 class="font-weight-bold fs-12 mb-0">{{ $RemainingLeave }}</h6>
                                    </div>
                                    <div class="d-flex align-items-end justify-content-between mb-0 mt-4">
                                        <h6 class="fs-12 mb-0">Leave Type</h6>
                                        <h6 class="font-weight-bold fs-12 mb-0">{{ $Leave->leave->Leave_Type }}</h6>
                                    </div>
                                    @if ($Leave->leave->Leave_Type !== 'Un-Paid')
                                        <div class="d-flex align-items-end justify-content-between mb-0 mt-4">
                                            <h6 class="fs-12 mb-0">Remaining {{ $Leave->leave->Leave_Type }}</h6>
                                            <h6 class="font-weight-bold fs-12 mb-0">{{ $Remainingleavetypewise }}</h6>
                                        </div>
                                    @else
                                        <div class="d-flex align-items-end justify-content-between mb-0 mt-4">
                                            <h6 class="fs-12 mb-0 text-muted">Un-Paid Leave</h6>
                                            <h6 class="font-weight-bold fs-12 mb-0">N/A</h6>
                                        </div>
                                    @endif

                                </div>
                                <div class="p-4">
                                    <label class="form-label">Reason:</label>
                                    <p class="text-muted leave-text">{{ $Leave->Leave_Reason }}</p>
                                </div>
                                @if ($Leave->Leave_Status === 'Pending')
                                    <div class="card-footer p-0 border-top-0">
                                        <div class="btn-group w-100 leaves-btns">
                                            <form action="{{ route('Accept.Request') }}" method="POST" class="w-100">
                                                @csrf
                                                <input type="hidden" name="Leave_ID" value="{{ $Leave->id }}" />
                                                <input type="hidden" name="User_ID" value="{{ $Leave->user_id }}" />
                                                <input type="hidden" name="Approved_ID"
                                                    value="{{ Auth::guard('Authorized')->user()->id }}" />
                                                <button type="submit"
                                                    class="btn btn-lg btn-outline-light w-100 text-success">Accept
                                                </button>
                                            </form>
                                            <form action="{{ route('Reject.Request') }}" method="POST" class="w-100">
                                                @csrf
                                                <input type="hidden" name="Leave_ID" value="{{ $Leave->id }}" />
                                                <input type="hidden" name="User_ID" value="{{ $Leave->user_id }}" />
                                                <input type="hidden" name="Approved_ID"
                                                    value="{{ Auth::guard('Authorized')->user()->id }}" />
                                                <button type="submit"
                                                    class="btn btn-lg btn-outline-light w-100 text-danger">Reject
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                @endif
                                @if ($Leave->Leave_Status === 'Accepted')
                                    <div class="card-footer p-0 border-top-0">
                                        <div class="btn-group w-100 leaves-btns">
                                            <a href="JavaScript:void(0);"
                                                class="btn btn-lg btn-outline-light w-100 text-success">Accepted</a>
                                        </div>
                                    </div>
                                @endif
                                @if ($Leave->Leave_Status === 'Rejected')
                                    <div class="card-footer p-0 border-top-0">
                                        <div class="btn-group w-100 leaves-btns">
                                            <a href="JavaScript:void(0);"
                                                class="btn btn-lg btn-outline-light w-100 text-danger">Rejected</a>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @empty
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Row -->
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header  border-0">
                <h4 class="card-title">Leaves Summary</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-vcenter text-nowrap table-bordered border-bottom" id="hr-leaves">
                        <thead>
                            <tr>
                                <th class="border-bottom-0 w-5">#Emp ID</th>
                                <th class="border-bottom-0 w-5">Emp Name</th>
                                <th class="border-bottom-0">Leave Type</th>
                                <th class="border-bottom-0">From</th>
                                <th class="border-bottom-0">To</th>
                                <th class="border-bottom-0">Days</th>
                                <th class="border-bottom-0">Reason</th>
                                <th class="border-bottom-0">Applied on</th>
                                <th class="border-bottom-0">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($Leave_Request as $Leave)
                                @if ($Leave->Leave_Status === 'Pending')
                                    @continue
                                @endif
                                @php
                                    $RemainingLeave = $Leave->user->leaves->Sick_Leaves + $Leave->user->leaves->Annual_Leaves + $Leave->user->leaves->Casual_Leaves;
                                    $progressPercentage = ($RemainingLeave / $Total_Leaves) * 100;
                                    $F_Date = date('F d, Y H:i:s A', strtotime($Leave->F_Date));
                                    $L_Date = !empty($Leave->L_Date) ? date('F d, Y H:i:s A', strtotime($Leave->L_Date)) : null;
                                @endphp
                                <tr>
                                    <td>{{ $Leave->user->EMP_ID }}</td>
                                    <td>
                                        <div class="d-flex">
                                            <span class="avatar avatar brround me-3"
                                                style="background-image: url({{ !empty($Leave->user->basic_info->profile_photo_path) ? asset($Leave->user->basic_info->profile_photo_path) : asset('assets/images/users/16.jpg') }})"></span>
                                            <div class="me-3 mt-0 mt-sm-2 d-block">
                                                <h6 class="mb-1 fs-14">{{ $Leave->user->basic_info->full_name }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $Leave->leave->Leave_Type }}</td>
                                    <td>{{ date('M d, Y', strtotime($Leave->F_Date)) }}</td>
                                    <td>{{ $Leave->L_Date ? date('M d, Y', strtotime($Leave->L_Date)) : '-' }}</td>
                                    <td class="font-weight-semibold">
                                        @if (empty($Leave->L_Date))
                                            1 Day
                                        @endif
                                        @if (!empty($Leave->L_Date))
                                            {{ PortalHelpers::getRemainingTime($F_Date, $L_Date) }}
                                        @endif
                                    </td>
                                    <td>{{ $Leave->Leave_Reason }}</td>
                                    <td>{{ $Leave->created_at }}</td>
                                    <td>
                                        <strong>{{ $Leave->Leave_Status }}</strong>
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
