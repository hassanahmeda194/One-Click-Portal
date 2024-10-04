<div class="page-header d-xl-flex d-block">
    <div class="page-leftheader">
        <h4 class="page-title">Allowance Setting</h4>
    </div>
    <div class="page-rightheader ms-md-auto">
        <div class="d-flex align-items-end flex-wrap my-auto end-content breadcrumb-end">
            <div class="btn-list">
                <a href="#" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#newtaskmodal"><i
                        class="feather feather-plus fs-15 my-auto me-2"></i>Add Allowance</a>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header  border-0">
                <h4 class="card-title">Allowance Setting</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered text-nowrap border-bottom text-center" id="responsive-datatable">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">S.No</th>
                                <th class="border-bottom-0">Employee name</th>
                                <th class="border-bottom-0">Month</th>
                                <th class="border-bottom-0">Amount</th>
                                <th class="border-bottom-0">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($Allowances as $Allowance)
                                <tr>
                                    <td class="border-bottom-0">{{ $loop->iteration }}</td>
                                    <td class="border-bottom-0">
                                        {{ $Allowance->user->basic_info->F_Name . ' ' . $Allowance->user->basic_info->L_Name }}
                                    </td>
                                    <td class="border-bottom-0">
                                        {{ \Carbon\Carbon::parse($Allowance->month)->format('M, Y') }}</td>
                                    <td class="border-bottom-0">{{ $Allowance->amount }}</td>
                                    <td class="border-bottom-0">
                                        <a href="{{ route('delete.allowance', ['id' => $Allowance->id]) }}"
                                            class="btn btn-danger btn-sm">
                                            <i class="feather feather-trash-2 "></i>
                                        </a>
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

<div class="modal fade" id="newtaskmodal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="{{ route('submit.add.allowance') }}" method="POST" class="needs-validation was-validated">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Add Allowance</h5>
                    <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label class="form-label">Allowance Name</label>
                                <input class="form-control" placeholder="Add Allowance Name" name="allowance_name"
                                    required>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label class="form-label">Amount</label>
                                <input type="number" class="form-control" placeholder="Add Amount" name="amount"
                                    required>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-check pt-1">
                                <input class="form-check-input" type="checkbox" value="1" id="all-employee-check"
                                    name="all_employee">
                                <label class="form-check-label text-black pt-1" for="all-employee-check pt-1">All
                                    Employee</label>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3" id="all-employee">
                            <select class="form-select" id="employee-dropdown" name="user_id">
                                <option selected disabled>Select Employee</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">
                                        {{ $user->basic_info->F_Name . ' ' . $user->basic_info->L_Name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label class="form-label">Month</label>
                                <input type="month" class="form-control" placeholder="Select Month" name="month"
                                    required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-block">Add Allowance</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        $('#all-employee-check').change(function() {
            let value = $(this).prop('checked')
            if (value) {
                $('#all-employee').hide();
                $('#employee-dropdown').prop('disabled', true);
            } else {
                $('#all-employee').show();
                $('#employee-dropdown').prop('disabled', false);
            }
        });
        $('#all-employee-check').change();
    });
</script>
