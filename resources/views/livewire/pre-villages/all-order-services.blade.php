<!--Page header-->
<div class="page-header d-xl-flex d-block">
    <div class="page-leftheader">
        <h4 class="page-title">Order<span class="font-weight-normal text-muted ms-2">Services</span></h4>
    </div>
    <div class="page-rightheader ms-md-auto">
        <div class="d-flex align-items-end flex-wrap my-auto end-content breadcrumb-end">
            <div class="btn-list">
                <a href="#" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#ResearchServiceModal"><i
                        class="feather feather-plus fs-15 my-auto me-2"></i>Add Research Order Service</a>
                <a href="#" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#ContentServiceModal"><i
                        class="feather feather-plus fs-15 my-auto me-2"></i>Add Content Order Service</a>
            </div>
        </div>
    </div>
</div>
<!--End Page header-->
<!-- Row -->
<div class="row">
    <div class="col-xl-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header  border-0">
                <h4 class="card-title">Research Order Services</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered text-nowrap border-bottom text-center" id="responsive-datatable">
                        <thead>
                        <tr>
                            <th class="border-bottom-0">S.No</th>
                            <th class="border-bottom-0">Services Name</th>
                            <th class="border-bottom-0">Created At</th>
                            <th class="border-bottom-0">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($Order_Services as $Service)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="">{{ $Service->Service_Name }}</td>
                                <td class="">{{ $Service->created_at }}</td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('Delete.Service', ['Service_ID' => $Service->id]) }}" class="action-btns1 mx-2" data-bs-toggle="tooltip"
                                           data-bs-placement="top" title="Delete Service"><i
                                                class="feather feather-trash-2 btn btn-danger"></i>
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

<div class="row">
    <div class="col-xl-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header  border-0">
                <h4 class="card-title">Content Order Services</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered text-nowrap border-bottom text-center" id="responsive-datatable-1">
                        <thead>
                        <tr>
                            <th class="border-bottom-0">S.No</th>
                            <th class="border-bottom-0">Services Name</th>
                            <th class="border-bottom-0">Created At</th>
                            <th class="border-bottom-0">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($Writer_Skills as $Skill)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="">{{ $Skill->Skill_Name }}</td>
                                <td class="">{{ $Skill->created_at }}</td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('Delete.Skill', ['Skill_ID' => $Skill->id]) }}" class="action-btns1 mx-2" data-bs-toggle="tooltip"
                                           data-bs-placement="top" title="Delete Service"><i
                                                class="feather feather-trash-2 btn btn-danger"></i>
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

<div class="modal fade" id="ResearchServiceModal">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <form action="{{ route('Post.Service') }}" method="POST" class="needs-validation was-validated">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Add Content Order Services</h5>
                    <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Add New Service</label>
                                <input class="form-control" placeholder="Enter a Service Name" name="Service_Name" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-block">Add Service</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="ContentServiceModal">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <form action="{{ route('Post.Skill') }}" method="POST" class="needs-validation was-validated">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Add Content Order Services</h5>
                    <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Add New Service</label>
                                <input class="form-control" placeholder="Enter a Service Name" name="Skill_Name" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-block">Add Service</button>
                </div>
            </form>
        </div>
    </div>
</div>

