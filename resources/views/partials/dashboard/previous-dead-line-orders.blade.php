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
                $Order_ID = (!empty($Order->Order_ID))? $Order->Order_ID : $Order->order_info->Order_ID;
                if (!empty($Order->basic_info->Word_Count)){
                    $WordCount = $Order->basic_info->Word_Count;
                } elseif (!empty($Order->content_info->Word_Count)){
                    $WordCount = $Order->content_info->Word_Count;
                } elseif (!empty($Order->Assign_Words)){
                    $WordCount = $Order->Assign_Words;
                } else {
                    $WordCount = 0;
                }

                if (!empty($Order->submission_info->F_DeadLine) && (\Carbon\Carbon::parse($Order->submission_info->F_DeadLine)->isPast())){
                    $DeadLine_DateAndTime = $Order->submission_info->F_DeadLine.''.$Order->submission_info->DeadLine_Time;
                    $deadlineType = '1st Draft';
                } elseif (!empty($Order->submission_info->S_DeadLine) && (\Carbon\Carbon::parse($Order->submission_info->S_DeadLine)->isPast())){
                    $DeadLine_DateAndTime = $Order->submission_info->S_DeadLine.''.$Order->submission_info->DeadLine_Time;
                    $deadlineType = '2nd Draft';
                } elseif (!empty($Order->submission_info->T_DeadLine) && (\Carbon\Carbon::parse($Order->submission_info->T_DeadLine)->isPast())){
                    $DeadLine_DateAndTime = $Order->submission_info->T_DeadLine.''.$Order->submission_info->DeadLine_Time;
                    $deadlineType = '3rd Draft';
                }
                else if (!empty($Order->submission_info->DeadLine) && !empty($Order->submission_info->DeadLine_Time) && (\Carbon\Carbon::parse($Order->submission_info->DeadLine)->isToday())){
                        $DeadLine_DateAndTime = $Order->submission_info->DeadLine.''.$Order->submission_info->DeadLine_Time;
                        $deadlineType = 'Final DeadLine';
                    } else {
                        $DeadLine_DateAndTime = $Order->DeadLine.''.$Order->DeadLine_Time;
                        $deadlineType = 'Final DeadLine';
                    }

                $Order_Status = '';
                if (!empty($Order->basic_info->Order_Status)){
                    $Order_Status = $Order->basic_info->Order_Status;
                } elseif (!empty($Order->content_info->Order_Status)){
                    $Order_Status = $Order->content_info->Order_Status;
                } else {
                    $Order_Status = $Order->Task_Status;
                }
            @endphp
            @if(!(\Carbon\Carbon::parse($DeadLine_DateAndTime)->isPast()) || $Order_Status === 'Completed')
                @continue
            @endif
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
                        <span>
                            {{ \Carbon\Carbon::parse($DeadLine_DateAndTime)->format('F d, Y h:i:s A') }} <strong class="text-danger">({{ $deadlineType }})</strong>
                        </span>
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
