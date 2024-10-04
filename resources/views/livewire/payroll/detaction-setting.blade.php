<div class="page-header  d-block">
    <div class="page-leftheader">
        <h4 class="page-title">Detaction Setting</h4>
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
                                <th class="border-bottom-0">Detaction name</th>
                                <th class="border-bottom-0">Percentage</th>
                                <th class="border-bottom-0">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($detactions as $detaction)
                                <tr>
                                    <td class="border-bottom-0">{{ $loop->iteration }}</td>
                                    <td class="border-bottom-0">
                                       {{ $detaction->name }}
                                    </td>
                                    <td class="border-bottom-0">
                                       {{ $detaction->detact_amount }}
                                    </td>
                                    <td class="border-bottom-0">
                                    <button type="button" class="btn btn-primary modal-button" data-id="{{ $detaction->id }}" >
                                            <i class="feather feather-edit"></i>
                                    </button>
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
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form action="{{ route('update.detact.ammount') }}" method="POST">
        @csrf
        <input type="hidden" id="detact-id" name="detact_id">
        <div class="mb-3">
            <label for="" class="form-label">Detact Ammount</label>
            <input type="text" class="form-control" id="detact-amount" name="detact_ammount">
        </div>
        <div>
          <button type="submit" class="w-100 btn btn-primary">Update</button>
        </div>
      </form>
      </div>
    </div>
  </div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function () {
    $('.modal-button').click(function(e) {
        e.preventDefault();
        var detactionId = $(this).data('id');
        fetchDetactionSetting(detactionId);
    });

    function fetchDetactionSetting(detactionId) {
        $.ajax({
            type: "GET",
            url: "{{ route('get.detaction.setting') }}",
            data: {
                id: detactionId
            },
            success: function(response) {
                $('#detact-amount').val(response.detact_amount);
                $('#detact-id').val(response.id);
                $('#exampleModal').modal('show');
            },
            error: function(xhr, status, error) {
                console.error("Error:", error);
            }
        });
    }
});
</script>