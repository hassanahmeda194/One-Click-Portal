<div class="card mt-4">
    <div class="card-header border-bottom-0">
        <div class="card-title">Development Orders List</div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered text-nowrap border-bottom" id="responsive-datatable">
                <thead>
                    <tr>
                        <th class="wd-15p border-bottom-0">S.No</th>
                        <th class="wd-15p border-bottom-0">Order ID</th>
                        <th class="wd-15p border-bottom-0">Status</th>
                       @if ((int) $auth_user->Role_ID != 3)
                            <th class="wd-15p border-bottom-0">Client Name</th>
                        @endif
                        @if($auth_user->Role_ID != 3)
                        <th class="wd-20p border-bottom-0">Created & Assign</th>
                        @endif
                        <th class="wd-10p border-bottom-0">Order From</th>
                       @if ((int) $auth_user->Role_ID != 3)
                            <th class="wd-25p border-bottom-0">Order Price</th>
                        @endif
                        <th class="wd-25p border-bottom-0">Deadline</th>
                    </tr>
                </thead>
                <tbody>

                    @forelse($developmentOrders as $Order)
                        <tr>
                            <td><strong>{{ $loop->iteration }}</strong></td>
                            <td>
                                <h6 class="mb-1 fs-16"><a
                                        href="{{ route('Development.Order.View', ['Order_ID' => $Order->Order_ID]) }}">{{ $Order->Order_ID }}</a>
                                </h6>
                            </td>
                            <td>
                                @php
                                    $status = '';
                                    if ($Order->development_info->order_status == 0) {
                                        $status = 'Working';
                                        $class = 'success';
                                    } elseif ($Order->development_info->order_status == 1) {
                                        $status = 'Canceled';
                                        $class = 'danger';
                                    } elseif ($Order->development_info->order_status == 2) {
                                        $status = 'Completed';
                                        $class = 'success';
                                    } elseif ($Order->development_info->order_status == 3) {
                                        $status = 'Revision';
                                        $class = 'danger';
                                    }
                                @endphp
                                <strong class="badge badge-{{ $class }} mt-2">
                                    {{ $status }}</strong> <br>
                            </td>
                           @if ((int) $auth_user->Role_ID != 3)
                                <td>{{ $Order->client_info->Client_Name }}</td>
                            @endif
                            @if($auth_user->Role_ID != 3)
                            <td>
                                <strong>Created By:</strong>
                                {{ isset($Order->authorized_user) && $Order->authorized_user->basic_info ? $Order->authorized_user->basic_info->full_name : '' }}
                               
                                <br>
                                @if($auth_user->Role_ID == 20 || $auth_user->Role_ID == 1)
                                @forelse($Order->assign as $User)
                                    <strong class="text-success">{{ $User->basic_info->full_name }}</strong>
                                    <br>
                                @empty
                                    <strong class="text-danger"> Not Assign</strong> <br>
                                @endforelse
                            @endif
                           
                                <strong>Created At:</strong> {{ $Order->created_at }}
                            </td>
                            @endif
                            <td>
                                <strong>Service:</strong>
                                @if ($Order->development_info)
                                    {{ $Order->development_info->project_service == 1 ? 'Wordpress' : 'Custom' }}
                                @endif
                                <br>

                            </td>
                            
                           @if ((int) $auth_user->Role_ID != 3)
                                <td>
                                    <strong>Status:</strong> {!! PortalHelpers::visualizeRecordStatus($Order->payment_info->Payment_Status) !!}
                                </td>
                            @endif
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
