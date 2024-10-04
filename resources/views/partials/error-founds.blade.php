<!--Page header-->
<div class="page-header d-lg-flex d-block">
    <div class="page-leftheader">
        <h4 class="page-title">{{ $ErrorCount }} Error Founds!</h4>
    </div>
</div>
<!--End Page header-->

@forelse($ErrorList as $Error)
    <div class="card custom-card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover card-table table-vcenter text-nowrap mb-0">
                    <tbody>
                    <tr>
                        <td><strong>Message:</strong> </td>
                        <td>{{ $Error->message }}</td>
                    </tr>
                    <tr>
                        <td><strong>File:</strong> </td>
                        <td>{{ $Error->file }}</td>
                    </tr>
                    <tr>
                        <td><strong>Line No.:</strong> </td>
                        <td>{{ $Error->line }}</td>
                    </tr>
                    <tr>
                        <td><strong>Trace:</strong> </td>
                        <td>{{ $Error->trace }}</td>
                    </tr>
                    <tr>
                        <td><strong>Created At:</strong> </td>
                        <td>{{ $Error->created_at }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@empty
@endforelse

