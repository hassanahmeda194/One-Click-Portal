@foreach ($data as $row)
<div class="card">
    <div class="border border-1 border-secondry mb-3 p-2">
        <h5 class="mb-2">Description</h5>
        <hr>
        {!! $row->Task_Revision !!}
    </div>
    <div class="border border-1 border-secondry mb-3 p-2">
        <h5 class="mb-2">Deadline: {{ $row->task->DeadLine }}</h5>

    </div>
    @if ($row->attachments->count() > 0)
    <h5>Revision Attachments</h5>
    <div class="table-responsive">
        <table class="table table-bordered text-nowrap border-bottom">
            <thead>
                <tr>
                    <td>File Name</td>
                    <td>Download file</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($row->attachments as $attach)
                <tr>
                    <td>{{ $attach->File_Name }}<br>{{ $row->created_at }}</td>
                    <td><a href="{{ asset($attach->file_path) }}" download class="btn btn-sm "><i class="fa fa-download" aria-hidden="true"></i></a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
     <div class="table-responsive">````````````````````````````````````````````````````````````````````````
         <table class="table table-bordered text-nowrap border-bottom">
             <thead>
                 <tr>
                     <td>File Name</td>
                     <td>Download file</td>
                 </tr>
             </thead>
             <tbody>
                 @foreach ($row->attachments as $attach)
                 <tr>
                     <td colspan="2">No Data Found</td>
                 </tr>
                 @endforeach
             </tbody>
         </table>
     </div>
    @endif
</div>
@endforeach
