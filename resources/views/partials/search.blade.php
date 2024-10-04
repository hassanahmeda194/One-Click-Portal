@if(!empty($orderInfo))
    @forelse($orderInfo as $record)
        @php
            $route = (PortalHelpers::getOrderType($record->Order_ID) === 1)? route('Order.Details', ['Order_ID' => $record->Order_ID]) : route('Content.Order.Details', ['Order_ID' => $record->Order_ID]);
        @endphp
        <div class="card custom-card">
            <div class="card-body">
                <div class="mb-2">
                    <a href="{{ $route }}" class="h4 text-dark">Order ID : {{ $record->Order_ID }} &nbsp; Order Status
                        : {{ (!empty($record->basic_info->Order_Status))? $record->basic_info->Order_Status : $record->content_info->Order_Status }}</a>
                </div>
                <a href="{{ $route }}"
                   class="text-primary">Click Here to View Order!</a>

                <div class="table-responsive">
                    <table class="table table-hover card-table table-vcenter text-nowrap mb-0">
                        <tbody>
                        <tr>
                            <td><strong>Client ID:</strong> {{ $record->client_info->Client_Code }}</td>
                            <td><strong>Client Name:</strong> {{ $record->client_info->Client_Name }}</td>
                            <td>
                                <strong>Assign To:</strong>
                                @if(empty($record->assign->basic_info->full_name))
                                    <strong class="text-danger"> Not Assign</strong> <br>
                                @else
                                    <strong class="text-success"> {{ $record->assign->basic_info->full_name }}</strong> <br>
                                @endif
                            </td>
                            <td><strong>Created By:</strong> {{ $record->authorized_user->basic_info->full_name }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>

            </div>

        </div>
    @empty
    @endforelse
@endif
@forelse($userInfo as $record)
    <div class="card custom-card">
        <div class="card-body">
            <div class="mb-2">
                <a href="{{ route('View.Employee', ['EMP_ID' => $record->EMP_ID]) }}" class="h4 text-dark">
                    <div class="table-responsive">
                        <table class="table table-hover card-table table-vcenter text-nowrap mb-0">
                            <tbody>
                            <tr>
                                <td><strong>Emp ID:</strong> {{ $record->EMP_ID }}</td>
                                <td><strong>Full Name:</strong> {{ $record->basic_info->full_name }}</td>
                                <td><strong>Designation:</strong> {{ $record->designation->Designation_Name }}</td>
                                <td>
                                    <a href="{{ route('View.Employee', ['EMP_ID' => $record->EMP_ID]) }}" class="btn btn-success btn-block">
                                        View
                                    </a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </a>
            </div>
        </div>
    </div>
@empty
@endforelse

