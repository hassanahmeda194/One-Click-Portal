<!--Page header-->
<div class="page-header d-xl-flex d-block">
    <div class="page-leftheader">
        <h4 class="page-title">Assigned<span class="font-weight-normal text-muted ms-2"> Benchmark</span></h4>
    </div>
</div>
<!--End Page header-->

<div class="card">
    <div class="card-header border-0">
        <h4 class="card-title">Assign Benchmark</h4>
    </div>
    <form action="{{ route('Assigned.Target') }}" method="POST">
        @csrf
        <div class="card-body">
            <div class="leave-types">
                <div class="row">
                    <input type="hidden" name="Emp_ID" id="Emp_ID" value="">
                    <div class="col-xl-3">
                        <div class="form-group">
                            <label class="form-label">Employee Name</label>
                            <input type="text" name="Employee_Name" class="form-control Get-Employee typeahead" id="Employee_Name" placeholder="Enter Employee Name">
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="form-group">
                            <label class="form-label">Designation</label>
                            <input type="text" name="Employee_Name" class="form-control" placeholder="Designation" id="Designation" readonly>
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="form-group">
                            <label class="form-label">Department</label>
                            <input type="text" name="Employee_Name" class="form-control" placeholder="Department" id="Department" readonly>
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="form-group">
                            <label class="form-label">Targets</label>
                            <input type="text" name="Benchmark" class="form-control" placeholder="Enter Benchmark">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary w-100">Assigned Benchmark</button>
        </div>
    </form>
</div>

<div class="card">
    <div class="card-header  border-0">
        <h4 class="card-title">Assigned Benchmark Users List</h4>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered text-nowrap border-bottom text-center" id="responsive-datatable">
                <thead>
                <tr>
                    <th class="border-bottom-0">S.No</th>
                    <th class="border-bottom-0">Employee Name</th>
                    <th class="border-bottom-0">Domain</th>
                    <th class="border-bottom-0">Assigned Target</th>
                    <th class="border-bottom-0">Created At</th>
                    <th class="border-bottom-0">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($Benchmark_List as $Benchmark)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td class="">{{ $Benchmark->user->basic_info->full_name }}</td>
                        <td class="">{{ $Benchmark->user->basic_info->department->Department_Name }}</td>
                        <td class="">{{ $Benchmark->Bench_Mark }}</td>
                        <td class="">{{ $Benchmark->created_at }}</td>
                        <td>
                            <div class="d-flex">
                                <a href="{{ route('Delete.Target', ['Bench_ID' => $Benchmark->id]) }}" class="btn btn-danger ">Delete Benchmark</a>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {

        const searchEmployee = '{{ route('Get.Employee') }}';
        $('.typeahead').autocomplete({
            source: function (request, response) {
                $.get(searchEmployee, {query: request.term}, function (data) {
                    response(data);
                });
            },
            select: function (event, ui) {
                getClientInfo(ui.item.value)
            }
        });

        function getClientInfo(value) {
            $.ajax({
                url: '{{ route('Get.Emp.Info') }}',
                type: 'GET',
                data: {
                    'query': value
                },
                success: function (data) {
                    $('#Emp_ID').val(data.Emp_ID);
                    $('#Employee_Name').val(data.Full_Name);
                    $('#Department').val(data.Department);
                    $('#Designation').val(data.Designation);
                }
            });
        }

        $('#Employee_Name').keyup(function () {
            var Emp_Name = $(this).val();
            if (Emp_Name === '') {
                $('#Emp_ID').val('');
                $('#Employee_Name').val('');
                $('#Department').val('');
                $('#Designation').val('');
            }
        });
    });
</script>
