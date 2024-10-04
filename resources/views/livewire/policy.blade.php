<div>
    <div class="card mt-4">
        <div class="card-header">
            <h3>Company Policy</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('update.company.policy') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-6">
                        <input type="file" name="policy_path" id="" class="form-control" style="padding-right:8px !important;">
                    </div>
                    <div class="col-2">
                        <button type="submit" class="btn btn-primary">Upload policy</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
