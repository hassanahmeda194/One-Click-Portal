<div class="table-responsive">
    <table class="table table-vcenter text-nowrap border-top dead-line-orders mb-0">
        <thead>
        <tr>
            <th class="wd-10p border-bottom-0">S.No</th>
            <th class="wd-10p border-bottom-0">Order Code</th>
            @if((int) $auth_user->Role_ID === 1 ||(int) $auth_user->Role_ID === 9 || (int) $auth_user->Role_ID === 10 || (int) $auth_user->Role_ID === 11)
                <th class="wd-15p border-bottom-0">Client Name</th>
            @endif
            <th class="w-15p border-bottom-0">Words Count</th>
            <th class="wd-20p border-bottom-0">Deadline</th>
            <th class="wd-25p border-bottom-0">Status</th>
        </tr>
        </thead>
        <tbody>
        @forelse($Orders as $Order)
            @php
                $Order_ID = (!empty($Order->Order_ID)) ? $Order->Order_ID : $Order->order_info->Order_ID;

                $WordCount = !empty($Order->basic_info->Word_Count)
                    ? $Order->basic_info->Word_Count
                    : (!empty($Order->content_info->Word_Count) ? $Order->content_info->Word_Count : $Order->Assign_Words);

                $deadlineInfo = $Order->submission_info->F_DeadLine ?? $Order->submission_info->S_DeadLine ?? $Order->submission_info->T_DeadLine ?? null;
                $deadlineTime = !empty($Order->submission_info->DeadLine_Time)
                    ? $Order->submission_info->DeadLine_Time
                    : (!empty($Order->submission_info->DeadLine) ? $Order->submission_info->DeadLine_Time : $Order->DeadLine_Time);
                $DeadLine_DateAndTime = $deadlineInfo ? $deadlineInfo . $deadlineTime : $Order->DeadLine . $deadlineTime;

                $Order_Status = $Order->basic_info->Order_Status ?? $Order->content_info->Order_Status ?? $Order->Task_Status;
            @endphp

            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>
                    <div class="d-flex">
                        <div class="me-3 mt-0 mt-sm-2 d-block">
                            <h6 class="mb-1 fs-16"><a
                                    href="{!! (PortalHelpers::getOrderType($Order_ID) === 1)? route('Order.Details', ['Order_ID' => $Order_ID]) : route('Content.Order.Details', ['Order_ID' => $Order_ID]) !!}">{{ $Order_ID }}</a>
                            </h6>
                        </div>
                    </div>
                </td>
                @if((int) $auth_user->Role_ID === 1 ||(int) $auth_user->Role_ID === 9 || (int) $auth_user->Role_ID === 10 || (int) $auth_user->Role_ID === 11)
                    <td>
                        <div class="d-flex">
                            <div class="me-3 mt-0 mt-sm-2 d-block">
                                <h6 class="mb-1 fs-16">{{ $Order->client_info->Client_Name }}</h6>
                            </div>
                        </div>
                    </td>
                @endif
                <td>{{ $WordCount }}</td>
                <td>
                    @if(\Carbon\Carbon::parse($DeadLine_DateAndTime)->isPast())
                        <span class="text-danger">
                            {{ \Carbon\Carbon::parse($DeadLine_DateAndTime)->format('F d, Y h:i:s A') }}
                        </span>
                    @else
                        <span class="text-muted">
                            {{ \Carbon\Carbon::parse($DeadLine_DateAndTime)->format('F d, Y h:i:s A') }}
                        </span>
                    @endif
                </td>
                <td>
                    <div class="d-flex">
                        <div class="me-3 mt-0 mt-sm-2 d-block">
                            <h6 class="mb-1 fs-16">{{ $Order_Status }}</h6>
                        </div>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5">
                    <div class="d-flex justify-content-center">
                        <div class="me-3 mt-0 mt-sm-2 d-block">
                            <h6 class="mb-1 fs-16">Orders are Not Found!</h6>
                        </div>
                    </div>
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>
