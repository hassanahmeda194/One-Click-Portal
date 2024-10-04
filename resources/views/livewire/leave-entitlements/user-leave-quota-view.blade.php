<!--Page header-->
<div class="page-header d-xl-flex d-block">
    <div class="page-leftheader">
        <h4 class="page-title">Users Leave Quota</h4>
    </div>

</div>
<!--End Page header-->
<!-- Row -->
<div class="row">
    <div class="col-xl-12 col-md-12 col-lg-12">
        <div class="card">

            <div class="card-body">
                <div class="table-responsive" id="Marked-Attandence-Table">
                    <table class="table  table-vcenter text-nowrap table-bordered border-bottom"
                        id="responsive-datatable">
                        <thead>
                            <tr>
                                <th class="border-bottom-0 w-5">#Emp ID</th>
                                <th class="border-bottom-0">Emp Name</th>
                                <th class="border-bottom-0">Sick_Leaves</th>
                                <th class="border-bottom-0">Annual_Leaves</th>
                                <th class="border-bottom-0">Casual_Leaves</th>
                                <th class="border-bottom-0">Un_Paid</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users_leaves as $users_leave)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <div class="d-flex">
                                            <span class="avatar avatar-md brround me-3"
                                                style="background-image: url(../../assets/images/users/1.jpg)"></span>
                                            <div class="me-3 mt-0 mt-sm-1 d-block">
                                                <h6 class="mb-1 fs-14">
                                                    {{ $users_leave->basic_info->full_name }}</h6>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <span
                                            class="avatar avatar-md bradius fs-20 bg-primary-transparent">{{ $users_leave->leave_quota->Sick_Leaves }}</span>
                                    </td>
                                    <td><span
                                            class="avatar avatar-md bradius fs-20 bg-primary-transparent">{{ $users_leave->leave_quota->Annual_Leaves }}</span>
                                    </td>
                                    <td><span
                                            class="avatar avatar-md bradius fs-20 bg-primary-transparent">{{ $users_leave->leave_quota->Casual_Leaves }}</span>
                                    </td>
                                    <td><span
                                            class="avatar avatar-md bradius fs-20 bg-primary-transparent">{{ $users_leave->leave_quota->Un_Paid }}</span>
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
<script src="{{ asset('assets/js/hr/hr-attmark.js') }}"></script>
<script>
    function validateLeaveInput(inputElement) {
        let inputValue = parseInt(inputElement.value, 10);
        if (inputValue <= 0 || isNaN(inputValue)) {
            inputElement.value = null;
        }
    }
</script>
