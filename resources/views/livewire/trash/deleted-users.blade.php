<!--Page header-->
<div class="page-header d-xl-flex d-block">
    <div class="page-leftheader">
        <h4 class="page-title">All Deleted<span class="font-weight-normal text-muted ms-2">Employee</span></h4>
    </div>
</div>
<!--End Page header-->
<div class="card">
    <div class="card-body pb-2">
        @if($All_Users->isNotEmpty())
            <div class="row">
                <div class="col mb-4">
                    <a href="{{ route('Restore.All.Employee') }}" class="btn btn-primary">
                        <i class="fe fe-plus"></i> Restore All</a>
                </div>
                <div class="col col-auto mb-4">
                    <div class="form-group w-100">
                        <div class="input-icon">
                        <span class="input-icon-addon">
							<i class="fe fe-search"></i>
						</span>
                            <input type="text" class="form-control" placeholder="Search User">
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @include('partials.fetch-users', ['Users' => $All_Users])
    </div>
</div>
