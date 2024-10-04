@isset($options)

<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">Users who selected "{{ $options->option }}"</h5>
        <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
    <div class="modal-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>User Name</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($options->answers as $user)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $user->user->basic_info->F_Name }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endisset
