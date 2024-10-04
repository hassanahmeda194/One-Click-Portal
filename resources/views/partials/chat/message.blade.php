@php

    if (in_array($message->authorized_user->Role_ID, [9, 10, 11,16])) {
        $class = 'justify-content-start';
    } else {
        $class = 'justify-content-end';
    }

@endphp

<div class="d-flex {{ $class }} my-5 ">
    <div class="msg_cotainer d-flex justify-content-between">
    <div>
        <h6 class="mb-1 fs-6 d-flex justify-content-between">
            @if ($message->authorized_user->designation)
                @if ((int) Auth::guard('Authorized')->user()->Role_ID !== 1)
                    {{ !empty(PortalHelpers::chatSenderName((int) $message->authorized_user->Role_ID)) ? PortalHelpers::chatSenderName((int) $message->authorized_user->Role_ID) : $message->authorized_user->designation->Designation_Name }}
                @else
                    {{ $message->authorized_user->basic_info->full_name }}
                @endif
            @endif
        </h6>
        <p class="fs-6">{{ $message->User_Message }}</p>
        <span class="msg_time fs-8">{{ $messageDate->format('H:i:s A') }}</span>
    </div>
        
    @if(Auth::guard('Authorized')->user()->Role_ID == 9 ||   Auth::guard('Authorized')->user()->Role_ID == 1)
        <div class="btn-group ms-3 mb-0">
            <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                
            </button>
            <div class="dropdown-menu dropdown-menu-start">
                <a class="dropdown-item" href="{{ route('delete.chat' , ['id' => $message->id]) }}"><i class="fe fe-trash me-2"></i>Delete</a>
            </div>
        </div>


    @endif
    </div>
</div>
@if (in_array((int) $message->authorized_user->Role_ID, [9, 10, 11], true))
    @if (in_array((int) Auth::guard('Authorized')->user()->Role_ID, [4, 5], true))
        <h6 class="m-3 fs-14">
            <a href="JavaScript:void(0);" class="ForwardTag" data-bs-container="body"
                data-bs-content="{!! $executiveList !!}" data-bs-placement="right" data-bs-html="true"
                data-bs-popover-color="default" data-bs-toggle="popover" title="Executive List">
                Forward To Executive
            </a>
        </h6>
    @endif
@endif

