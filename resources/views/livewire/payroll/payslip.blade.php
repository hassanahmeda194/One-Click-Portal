<div class="page-header  d-block">
    <div class="page-leftheader">
        <h4 class="page-title">Payslip</h4>
    </div>
</div>

@if (in_array(Auth::guard('Authorized')->user()->Role_ID , [1,2,14,15]))
<div class="row">
    <div class="col-xl-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header border-0">
                <h4 class="card-title">Generat Payslip</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('submit.generate.slip') }}" method="POST">
                    @csrf
                 <div class="row">
                    <div class="col-4">
                        <label for="" class="form-label">Select User</label>
                        <select name="user_id" class="form-select">
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->basic_info->FullName }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-4">
                        <label for="" class="form-label">Select Month</label>
                        <input type="month" name="month" class="form-control">
                    </div>
                    <div class="col-4 mt-4">
                        <button class="btn btn-primary">Generate payslip</button>
                    </div>
                 </div>
                </form>
            </div>
        </div>
    </div>
</div> 

@else
<div class="row">
    <div class="col-xl-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header border-0">
                <h4 class="card-title">Generat Payslip</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('submit.generate.slip') }}" method="POST">
                    @csrf
                 <div class="row">
                    <div class="col-4">
                        <label for="" class="form-label">Select User</label>
                        <select name="user_id" class="form-select">
                                <option value="{{ Auth::guard('Authorized')->user()->id }}">{{ Auth::guard('Authorized')->user()->basic_info->FullName }}</option>
                        </select>
                    </div>
                    <div class="col-4">
                        <label for="" class="form-label">Select Month</label>
                        <input type="month" name="month" class="form-control" min="{{ $currect_joining_date }}">
                    </div>
                    <div class="col-4 mt-4">
                        <button class="btn btn-primary">Generate payslip</button>
                    </div>
                 </div>
                </form>
            </div>
        </div>
    </div>
</div> 
@endif




