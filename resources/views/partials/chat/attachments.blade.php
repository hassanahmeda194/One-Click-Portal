@foreach ($attachments as $attachment)
  @if($attachment->chat->authorized_user->Role_ID == 9 || 
    $attachment->chat->authorized_user->Role_ID == 10 || 
    $attachment->chat->authorized_user->Role_ID == 11)
    @php
        $class = 'justify-content-start';
    @endphp
@else
    @php
        $class = 'justify-content-end';
    @endphp
@endif
<div class="direct-chat-text py-3 ">
    <div class="d-flex {{ $class }}">
        <i class="fe fe-file-text fs-40 op-2 text-muted d-block me-2"></i>
        <div class="d-flex justify-content-between">
            <div>
                <div class="font-weight-bold fs-12">
                    <a href="{{ asset($attachment->file_path) }}" download="">{{ $attachment->File_Name }}</a>
                </div>
                <span class="fs-12">{{ $attachment->created_at }}</span>
                     
            </div>
            @if(Auth::guard('Authorized')->user()->Role_ID == 9 ||   Auth::guard('Authorized')->user()->Role_ID == 1)
            <div>
                <div class="btn-group ms-3 mb-0">
                    <button type="button" class="btn  dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                       
                    </button>
                    <div class="dropdown-menu dropdown-menu-start">
                        <a class="dropdown-item" href="{{ route('delete.chat.attachment' , ['id' => $attachment->id ] ) }}"><i class="fe fe-trash me-2"></i> Delete</a>
                    </div>
                </div>
            </div>
            @endif
            
        </div>
    </div>
</div>
@endforeach