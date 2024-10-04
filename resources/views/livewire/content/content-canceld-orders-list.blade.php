@if (in_array((int) $auth_user->Role_ID, [1, 17, 9, 10, 11]))

    {{-- Admin View --}}
    <div class="card mt-4">
        <div class="card-header border-bottom-0">
            <div class="card-title">Canceled Content Orders List</div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-nowrap border-bottom" id="responsive-datatable">
                    <thead>
                        <tr>
                            <th class="wd-15p border-bottom-0">S.No</th>
                            <th class="wd-15p border-bottom-0">Order ID</th>
                            <th class="wd-15p border-bottom-0">Status</th>
                            <th class="wd-15p border-bottom-0">Client Name</th>
                            <th class="wd-20p border-bottom-0">Created & Assign</th>
                            <th class="wd-10p border-bottom-0">Order From</th>
                            <th class="wd-25p border-bottom-0">Order Info</th>
                            <th class="wd-25p border-bottom-0">Order Price</th>
                            <th class="wd-25p border-bottom-0">Deadline</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($Content_Canceled_Orders as $Order)
                            <tr>
                                <td><strong>{{ $loop->iteration }}</strong></td>
                                <td>
                                    <h6 class="mb-1 fs-16"><a
                                            href="{{ route('Content.Order.Details', ['Order_ID' => $Order->Order_ID]) }}">{{ $Order->Order_ID }}</a>
                                    </h6>
                                </td>
                                <td>
                                    <h6 class="mb-1 fs-16">{!! PortalHelpers::visualizeRecordStatus($Order->content_info->order_status) !!}</h6>
                                </td>
                                <td>{{ $Order->client_info->Client_Name }}</td>
                                <td>
                                    <strong>Created By:</strong> {{ $Order->authorized_user->basic_info->full_name }}
                                    <br>
                                    @forelse($Order->assign as $User)
                                        <strong class="text-success">{{ $User->basic_info->full_name }}</strong> <br>
                                    @empty
                                        <strong class="text-danger"> Not Assign</strong> <br>
                                    @endforelse
                                    <strong>Created At:</strong> {{ $Order->created_at }}
                                </td>
                                <td>
                                    <strong>Website</strong> {{ $Order->content_info->Order_Website }}<br>
                                    <strong>Service</strong> {{ $Order->content_info->Order_Services }}
                                </td>
                                <td>
                                    <strong>Word Count:</strong> {{ $Order->content_info->Word_Count }}
                                </td>
                                <td>
                                    <strong>Amount:</strong> {{ $Order->payment_info->Order_Price }}<br>
                                    <strong>Status:</strong> {!! PortalHelpers::visualizeRecordStatus($Order->payment_info->Payment_Status) !!}
                                </td>
                                <td>
                                    <strong>Deadline: </strong>{{ $Order->submission_info->DeadLine }} <br>
                                    <strong>Time: </strong>{{ $Order->submission_info->DeadLine_Time }}
                                </td>
                            </tr>
                        @empty
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endif
