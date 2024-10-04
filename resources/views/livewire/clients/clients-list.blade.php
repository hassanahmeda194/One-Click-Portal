<div class="card mt-4">
    <div class="card-header">
        <div class="card-title">All Registered Clients</div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered text-nowrap border-bottom" id="responsive-datatable">
                <thead>
                <tr>
                    <th class="wd-10p border-bottom-0">S.No</th>
                    <th class="wd-15p border-bottom-0">Client Code</th>
                    <th class="wd-15p border-bottom-0">Client Name</th>
                    <th class="wd-15p border-bottom-0">Email Address</th>
                    <th class="w-15p border-bottom-0">Country</th>
                    <th class="wd-20p border-bottom-0">Phone Number</th>
                    <th class="wd-25p border-bottom-0">Actions</th>
                </tr>
                </thead>
                <tbody>
                @forelse($clients as $client)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $client->Client_Code }}</td>
                        <td>{{ $client->Client_Name }}</td>
                        <td>{{ $client->Client_Email }}</td>
                        <td>{{ $client->Client_Country }}</td>
                        <td>{{ $client->Client_Phone }}</td>
                        <td>
                            <div class="btn-list btn-sm">
                                <div class="dropdown">
                                    <button class="btn btn-info dropdown-toggle px-5"
                                            data-bs-toggle="dropdown">
                                        <i class="fe fe-activity me-2"></i>Actions
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item"
                                           href="{{ route('Research.Create.Order', ['Client_ID' => $client->id]) }}">Place
                                            Research Order</a>
                                        <a class="dropdown-item"
                                           href="{{ route('Content.Create.Order', ['Client_ID' => $client->id]) }}">Place
                                            Content Order</a>
                                        <a class="dropdown-item Client-Edit" data-bs-toggle="modal"
                                           data-bs-target="#ClientEditModal" href="javascript:void(0);">
                                            Edit Client
                                            <input type="hidden" id="Client_ID" value="{{ $client->Client_Name }}"/>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="ClientEditModal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="{{ route('Update.Client.Info') }}" method="POST" class="needs-validation was-validated">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Update Current Client</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label">Client ID</label>
                                <input class="form-control mb-4 Client_Code" name="Client_Code"
                                       placeholder="Client ID" readonly type="text">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label">Client Name</label>
                                <input class="form-control mb-4 is-valid Client_Name" name="Client_Name"
                                       placeholder="Client Name" type="text" required autocomplete="off">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label">Client Country</label>
                                <select name="Client_Country"
                                        class="form-control select2-show-search custom-select select2 Client_Country"
                                        data-placeholder="Select Country" required>
                                    <option label="Select Country"></option>
                                    @foreach($Countries as $Country)
                                        <option value="{{ $Country->name }}">{{ $Country->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label">Client Email</label>
                                <input class="form-control mb-4 is-valid Client_Email" name="Client_Email"
                                       placeholder="Client Email" type="email" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label">Client Phone</label>
                                <input class="form-control mb-4 is-valid Client_Phone" name="Client_Phone"
                                       placeholder="Client Phone" type="text" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-block">Update Client</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $('.table-responsive').on('click', '.Client-Edit', function () {
        const getClient_ID = $(this).find('#Client_ID').val();

        $.ajax({
            url: '{{ route('Get.Client.Info') }}',
            type: 'GET',
            data: {
                'query': getClient_ID
            },
            success: function (data) {
                $('.Client_Code').val(data.Client_Code);
                $('.Client_Name').val(data.Client_Name);
                $('.Client_Phone').val(data.Client_Phone);
                $('.Client_Country').val(data.Client_Country).trigger('change');
                $('.Client_Email').val(data.Client_Email);
            }
        });
    });
</script>

{{--<script>--}}
{{--    $(document).ready(function() {--}}
{{--        $('#responsive-datatable-3').DataTable({--}}
{{--            processing: true,--}}
{{--            serverSide: true,--}}
{{--            ajax: "{{ route('Get.All.Clients.List') }}",--}}
{{--            columns: [--}}
{{--                { data: 'DT_RowIndex', name: 'DT_RowIndex' },--}}
{{--                { data: 'Client_Code', name: 'Client_Code' },--}}
{{--                { data: 'Client_Name', name: 'Client_Name' },--}}
{{--                { data: 'Client_Email', name: 'Client_Email' },--}}
{{--                { data: 'Client_Country', name: 'Client_Country' },--}}
{{--                { data: 'Client_Phone', name: 'Client_Phone' },--}}
{{--                { data: 'actions', name: 'actions' },--}}
{{--            ],--}}
{{--            drawCallback: function() {--}}
{{--                // Rebind the event handler after each table draw--}}
{{--                $('.table-responsive').on('click', '.Client-Edit', function () {--}}
{{--                    const getClient_ID = $(this).find('#Client_ID').val();--}}

{{--                    $.ajax({--}}
{{--                        url: '{{ route('Get.Client.Info') }}',--}}
{{--                        type: 'GET',--}}
{{--                        data: {--}}
{{--                            'query': getClient_ID--}}
{{--                        },--}}
{{--                        success: function (data) {--}}
{{--                            $('.Client_Code').val(data.Client_Code);--}}
{{--                            $('.Client_Name').val(data.Client_Name);--}}
{{--                            $('.Client_Phone').val(data.Client_Phone);--}}
{{--                            $('.Client_Country').val(data.Client_Country).trigger('change');--}}
{{--                            $('.Client_Email').val(data.Client_Email);--}}
{{--                        }--}}
{{--                    });--}}
{{--                });--}}
{{--            }--}}
{{--        });--}}

{{--    });--}}
{{--</script>--}}
