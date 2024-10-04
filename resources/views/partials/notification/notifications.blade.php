@forelse($notifications as $notification)
    @php
        $Order_ID = $notification['Order_ID'];
        $Emp_ID = $notification['Emp_ID'];
        $isRead = (empty($notification['read_at']))? 'style="background: #d7e3fc !important;"' : '';
    @endphp
    @if(!empty($Order_ID))
        <div class="list-group-item align-items-center border-bottom parent-container" {!! $isRead !!}>
            <div class="d-flex">
                <div class="mt-1">
                    <a href="{!! $notification['route'] !!}"
                       class="font-weight-semibold fs-16 MarkRead" data-notification-id="{{ $notification['id'] }}">
                        {{ $notification['Sender'] }}
                        <span class="clearfix"></span>
                        <span class="text-muted font-weight-normal">{!! $notification['Message'] !!}</span>
                    </a>
                    <span class="clearfix"></span>
                    <span class="text-muted fs-13 ms-auto">
                <i class="mdi mdi-clock text-muted me-1"></i>
                {{ $notification['created_at'] }}
            </span>
{{--                    <span class="text-muted fs-13 ms-auto">--}}
{{--                <i class="mdi mdi-eye text-muted me-1"></i>--}}
{{--                <a href="{{ route('Mark.Read.Notification', ['Notify_ID' => $notification['id']]) }}">--}}
{{--                View--}}
{{--            </a>--}}
{{--            </span>--}}
                </div>
                <div class="ms-auto">
                    <a href="" class="me-0 option-dots" data-bs-toggle="dropdown" role="button"
                       aria-haspopup="true" aria-expanded="false">
                        <span class="feather feather-more-horizontal"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" role="menu">
                        <li class="">
                            <a href="javascript:void(0);" class="MarkRead"
                               data-notification-id="{{ $notification['id'] }}">
                                <i class="feather feather-eye me-2"></i> Mark Read
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    @endif
    @if(!empty($Emp_ID))
        <div class="list-group-item align-items-center border-bottom">
            <div class="d-flex">
                <div class="mt-1">
                    <a href="{{ route('View.Employee', ['EMP_ID' => $Emp_ID]) }}"
                       class="font-weight-semibold fs-16">{{ $notification['Sender'] }}
                        <span class="clearfix"></span>
                        <span class="text-muted font-weight-normal">{!! $notification['Message'] !!}</span></a>
                    <span class="clearfix"></span>
                    <span class="text-muted fs-13 ms-auto"><i class="mdi mdi-clock text-muted me-1"></i>{{ $notification['created_at'] }}</span>
                </div>
                <div class="ms-auto">
                    <a href="" class="me-0 option-dots" data-bs-toggle="dropdown" role="button"
                       aria-haspopup="true" aria-expanded="false">
                        <span class="feather feather-more-horizontal"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" role="menu">
                        <li class="parent-container">
                            <a href="JavaScript:void(0);" class="MarkRead">
                                <i class="feather feather-eye me-2"></i>
                                Mark Read
                                <input type="hidden" value="{{ $notification['id'] }}">
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    @endif
@empty
@endforelse

<script>
    $(document).ready(function() {
        var oldCount = parseInt($('.NotificationCount').html());
        var newCount = parseInt('{{ $notificationsCount }}');
        $('.NotificationCount').html(newCount);
        if (newCount > oldCount) {
            var audio = new Audio('{{ asset("notification.mp3") }}');
            audio.play();
        }
    });
</script>
