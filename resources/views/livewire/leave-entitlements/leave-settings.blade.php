<div class="page-header d-xl-flex d-block">
    <div class="page-leftheader">
        <h4 class="page-title">Leave Settings</h4>
    </div>
    <div class="page-rightheader ms-md-auto">
        <div class="d-flex align-items-end flex-wrap my-auto end-content breadcrumb-end">
            <div class="btn-list">
                <a href="#" class="btn btn-primary me-3" data-bs-toggle="modal" data-bs-target="#addleavemodal">Add
                    Leave Type</a>
            </div>
        </div>
    </div>
</div>
<!--End Page header-->

<!-- Row -->
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header  border-0">
                <h4 class="card-title">Leaves Types</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table  table-vcenter text-nowrap table-bordered border-bottom" id="hr-leavestypes">
                        <thead>
                        <tr>
                            <th class="border-bottom-0">Leaves Type</th>
                            <th class="border-bottom-0 text-center">No.of Leaves</th>
                            <th class="border-bottom-0">Actions</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach ($Leave_Info as $Leave)
                            <tr>
                                <td>{{ $Leave->Leave_Type }}</td>

                                <td class="text-center font-weight-semibold">{{ $Leave->Leave_Numbers }}</td>

                                <td>
                                    <div class="d-flex">
                                        <a data-id="{{ $Leave->id }}" class="action-btns1" id="Edit_Leave_Modal"
                                           data-bs-toggle="modal" data-bs-target="#editleavemodal"><i
                                                class="feather feather-eye primary text-primary"></i></a>
                                        <a href="{{ route('Delete.Leave.Setting', ['Leave_ID' => $Leave->id]) }}"
                                           class="action-btns1" data-bs-toggle="tooltip" data-bs-placement="top"
                                           title="Delete">

                                            <i class="feather feather-trash-2 text-danger"></i>
                                        </a>

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

<!-- Add leave Modal -->
<div class="modal fade" id="addleavemodal">
    <div class="modal-dialog" role="document">
        <form action="{{ route('Submit.Leave.Setting') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Leaves</h5>
                    <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="form-label">Type Of Leaves</label>
                        <input class="form-control" name="Leave_Type" placeholder="Text">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Number Of Days</label>
                        <input class="form-control" name="Leave_Numbers" placeholder="Numbers">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary w-100" type="submit">Save</button>
                </div>

            </div>
        </form>
    </div>
</div>
<!-- Add leave Modal -->
<div class="modal fade" id="editleavemodal">
    <div class="modal-dialog" role="document">
        <form action="{{ route('Update.Leave.Setting') }}" method="POST" id="edit-leave-form">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Leaves</h5>
                    <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input id="leave_setting_id" type="hidden" name="Leave_ID" class="form-control"
                               placeholder="Text">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Type Of Leaves</label>
                        <input id="leave_type" name="Leave_Type" class="form-control" placeholder="Text">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Number Of Days</label>
                        <input id="leave_number" name="Leave_Numbers" class="form-control" placeholder="Numbers">


                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary w-100" type="submit">Update</button>

                </div>
            </div>
        </form>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#Edit_Leave_Modal').click(function (e) {
            e.preventDefault();
            var Leave_ID = $(this).data('id');

            $.ajax({
                url: "{{ route('Get.Leave.Info') }}",
                method: 'GET',
                data: {
                    Leave_ID: Leave_ID
                },
                success: function (response) {
                    $('#leave_type').val(response.Leave_Type);
                    $('#leave_number').val(response.Leave_numbers);
                    $('#leave_setting_id').val(response.id);
                    $('#editleavemodal').modal('show');
                },
                error: function (xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        });
    });

</script>
