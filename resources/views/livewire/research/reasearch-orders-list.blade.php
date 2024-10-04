@if ((int) $auth_user->Role_ID === 1)
    {{-- Admin View --}}
    <div class="card mt-4">
           <div class="card-header border-bottom-0 d-flex justify-content-between align-items-center">
            <div class="card-title">Research Orders List</div>
            <div class="d-flex align-items-center">
                <form method="GET" action="" class="d-flex align-items-center">
                <div class="btn-group mb-2 me-2 d-flex flex-column">
                    <label for="selectBox" class="form-label">Writters:</label>
                    <select class="form-select" id="selectBox" name="writer">
                        <option value="All">All writers</option>
                      @foreach($Writters as $w)
                        <option value="{{$w->id}}" @selected($w->id == request('writer'))>{{$w->basic_info->FullName}}</option>
                      @endforeach
                    </select>
                </div>
                <div class="btn-group mb-2 me-2 d-flex flex-column">
                        <label for="selectBox" class="form-label">Start Date</label>
                        <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}">
                </div>
                <div class="btn-group mb-2 me-2 d-flex flex-column">
                        <label for="selectBox" class="form-label">End Date</label>
                        <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}">
                </div>
                <div class="btn-group mb-2 me-2 d-flex flex-column pt-2">
                       <button type="submit" class="btn btn-primary">Apply Filters</button>
                </div>
                
                </form>
                <div class="btn-group mt-2 mb-2 me-2">
                    <button class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        Filters <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="{{ route('Research.Orders') }}">All</a></li>
                        <li><a href="{{ route('Research.Orders', ['filter' => 'Not-Assign']) }}">Not Assign Order</a>
                        </li>
                    </ul>
                </div>
                <div>
                    
                    <a href="{{ route('Research.Orders') }}" class="btn btn-primary">Clear all filters</a>
                </div>

            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                @if (request()->has('filter'))
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
                                <th class="wd-25p border-bottom-0">Draft Deadline</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($unAssignedOrder as $Order)
                                <tr>
                                    <td><strong>{{ $loop->iteration }}</strong></td>
                                    <td>
                                        <h6 class="mb-1 fs-16"><a
                                                href="{{ route('Order.Details', ['Order_ID' => $Order->Order_ID]) }}">{{ $Order->Order_ID }}</a>
                                        </h6>
                                    </td>
                                    <td>
                                        @if (isset($Order->basic_info->order_status))
                                            {{ $Order->basic_info->order_status }}<br>
                                        @endif

                                    </td>
                                    <td>{{ $Order->client_info->Client_Name }}</td>
                                    <td>
                                        <strong>Created By:</strong>
                                        {{ isset($Order->authorized_user) && $Order->authorized_user->basic_info ? $Order->authorized_user->basic_info->full_name : '' }}
                                        <br>
                                        @forelse($Order->assign as $User)
                                            <strong class="text-success">{{ $User->basic_info->full_name }}</strong>
                                            <br>
                                        @empty
                                            <strong class="text-danger"> Not Assign</strong> <br>
                                        @endforelse
                                        <strong>Created At:</strong> {{ $Order->created_at }}
                                    </td>
                                    <td>
                                        @if (isset($Order->basic_info->Order_Website))
                                            <strong>Website</strong> {{ $Order->basic_info->Order_Website }}<br>
                                        @endif
                                        @if (isset($Order->basic_info->Order_Services))
                                            <strong>Service</strong> {{ $Order->basic_info->Order_Services }}
                                        @endif
                                    </td>
                                    <td>
                                        @if (isset($Order->basic_info->Word_Count))
                                            <strong>Word Count:</strong> {{ $Order->basic_info->Word_Count }}<br>
                                        @endif
                                        @if (isset($Order->basic_info->Pages_Count))
                                            <strong>Page Count:</strong> {{ $Order->basic_info->Pages_Count }}
                                        @endif
                                    </td>
                                    <td>
                                        <strong>Amount:</strong> {{ $Order->payment_info->Order_Price }}<br>
                                        <strong>Status:</strong> {!! PortalHelpers::visualizeRecordStatus($Order->payment_info->Payment_Status) !!}
                                    </td>
                                    <td>
                                        <strong>Deadline: </strong>{{ $Order->submission_info->DeadLine }} <br>
                                        <strong>Time: </strong>{{ $Order->submission_info->DeadLine_Time }}
                                    </td>
                                    <td>
                                        @if (isset($Order->submission_info->F_DeadLine))
                                            <strong>1st Draft: </strong>{{ $Order->submission_info->F_DeadLine }} <br>
                                        @endif
                                        @if (isset($Order->submission_info->S_DeadLine))
                                            <strong>2nd Draft: </strong>{{ $Order->submission_info->S_DeadLine }} <br>
                                        @endif
                                        @if (isset($Order->submission_info->T_DeadLine))
                                            <strong>3rd Draft: </strong>{{ $Order->submission_info->T_DeadLine }}
                                        @endif
                                    </td>
                                </tr>
                            @empty
                            @endforelse
                        </tbody>
                    </table>
                    
                @elseif (request()->has('start_date'))
                
                <table class="table table-vcenter text-nowrap border-top dead-line-orders mb-0" id="responsive-datatable">
                        <thead>
                            <tr>
                                <th class="wd-10p border-bottom-0">S.No</th>
                                <th class="wd-10p border-bottom-0">Order Code</th>
                                <th class="wd-10p border-bottom-0">Assign</th>
                                <th class="wd-10p border-bottom-0">Client</th>
                                <th class="w-15p border-bottom-0">Words Count</th>
                                <th class="wd-20p border-bottom-0">Deadline</th>
                                <th class="wd-25p border-bottom-0">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                          
                                @php
                                $order_words = 0; 
                                
                                @endphp
                            @forelse($Research_Orders as $Order)
                                @php
                                 $order_words += $Order['Word_Count'];
                                @endphp
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <div class="d-flex">
                                            <div class="me-3 mt-0 mt-sm-2 d-block">
                                                <h6 class="mb-1 fs-16">
                                                    @if ($Order['Order_Type'] == 2)
                                                        <a
                                                            href="{{ route('Content.Order.Details', ['Order_ID' => $Order['Order_ID']]) }}">
                                                        @elseif($Order['Order_Type'] == 3)
                                                            <a
                                                                href="{{ route('Design.Order.View', ['Order_ID' => $Order['Order_ID']]) }}">
                                                            @elseif($Order['Order_Type'] == 1)
                                                                <a
                                                                    href="{{ route('Order.Details', ['Order_ID' => $Order['Order_ID']]) }}">
                                                                @elseif($Order['Order_Type'] == 4)
                                                                    <a
                                                                        href="{{ route('Development.Order.View', ['Order_ID' => $Order['Order_ID']]) }}">
                                                    @endif
                                                    {{ $Order['Order_ID'] }}
                                                    </a>
                                                </h6>
                                            </div>
                                        </div>

                                    </td>
                                     <td>
                                       <p>{{$Order['F_Name'] && $Order['L_Name'] ?  $Order['F_Name'] .' '. $Order['L_Name'] : "Not Assign"}}</p>
                                        </td>
                                    @if (
                                        (int) $auth_user->Role_ID === 1 ||
                                            (int) $auth_user->Role_ID === 9 ||
                                            (int) $auth_user->Role_ID === 10 ||
                                            (int) $auth_user->Role_ID === 11)
                                        <td>{{ $Order['Client_Name'] }}</td>
                                    @endif
                                    @if ((int) $auth_user->Role_ID === 4)
                                        <td>{{ $Order['Order_Type'] == 2 ? 'Content Writing Order' : 'Reseacrh Writing Order' }}
                                        </td>
                                    @endif
                                    
                                    <td>{{ $Order['Word_Count'] ?? 'No word count' }}</td>
                                    <td>
                                        @if (isset($Order['DeadLine']))
                                            {{ $Order['DeadLine'] }} <span class="text-danger">(Deadline)</span>
                                        @elseif(isset($Order['F_DeadLine']))
                                            {{ $Order['F_DeadLine'] }} <span class="text-danger">(First
                                                Draft)</span>
                                        @elseif(isset($Order['S_DeadLine']))
                                            {{ $Order['S_DeadLine'] }} <span class="text-danger">(Second
                                                Draft)</span>
                                        @elseif(isset($Order['T_DeadLine']))
                                            {{ $Order['T_DeadLine'] }} <span class="text-danger">(Third
                                                Draft)</span>
                                        @elseif(isset($Order['Four_DeadLine']))
                                            {{ $Order['Four_DeadLine'] }} <span class="text-danger">(Fourth
                                                Draft)</span>
                                        @elseif(isset($Order['Fifth_DeadLine']))
                                            {{ $Order['Fifth_DeadLine'] }} <span class="text-danger">(Fifth
                                                Draft)</span>
                                        @elseif(isset($Order['Sixth_DeadLine']))
                                            {{ $Order['Sixth_DeadLine'] }} <span class="text-danger">(Sixth
                                                Draft)</span>
                                        @elseif(isset($Order['Seven_DeadLine']))
                                            {{ $Order['Seven_DeadLine'] }} <span class="text-danger">(Seventh
                                                Draft)</span>
                                        @elseif(isset($Order['Eight_DeadLine']))
                                            {{ $Order['Eight_DeadLine'] }} <span class="text-danger">(Eighth
                                                Draft)</span>
                                        @elseif(isset($Order['nine_DeadLine']))
                                            {{ $Order['nine_DeadLine'] }} <span class="text-danger">(Ninth
                                                Draft)</span>
                                        @elseif(isset($Order['ten_DeadLine']))
                                            {{ $Order['ten_DeadLine'] }} <span class="text-danger">(Tenth
                                                Draft)</span>
                                        @elseif(isset($Order['eleven_DeadLine']))
                                            {{ $Order['eleven_DeadLine'] }} <span class="text-danger">(Eleventh
                                                Draft)</span>
                                        @elseif(isset($Order['twelve_DeadLine']))
                                            {{ $Order['twelve_DeadLine'] }} <span class="text-danger">(Twelfth
                                                Draft)</span>
                                        @elseif(isset($Order['thirteen_DeadLine']))
                                            {{ $Order['thirteen_DeadLine'] }} <span class="text-danger">(Thirteenth
                                                Draft)</span>
                                        @elseif(isset($Order['fourteen_DeadLine']))
                                            {{ $Order['fourteen_DeadLine'] }} <span class="text-danger">(Fourteenth
                                                Draft)</span>
                                        @elseif(isset($Order['fifteen_DeadLine']))
                                            {{ $Order['fifteen_DeadLine'] }} <span class="text-danger">(Fifteenth
                                                Draft)</span>
                                        @else
                                            No Deadline
                                        @endif
                                    </td>
                                    @if ($Order['Order_Status'] == 0)
                                        <td>Working</td>
                                    @elseif($Order['Order_Status'] == 1)
                                        <td>Canceled</td>
                                    @elseif($Order['Order_Status'] == 2)
                                        <td>Completed</td>
                                    @elseif($Order['Order_Status'] == 3)
                                        <td>Revision</td>
                                    @endif
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
                            
                             <tr>
                                    <td><b>Total Assign Words</b></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>{{ $order_words }}</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                        </tbody>
    
                    </table>
                
                @else
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
                                <th class="wd-25p border-bottom-0">Draft Deadline</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($Research_Orders as $Order)
                                <tr>
                                    <td><strong>{{ $loop->iteration }}</strong></td>
                                    <td>
                                        <h6 class="mb-1 fs-16"><a
                                                href="{{ route('Order.Details', ['Order_ID' => $Order->Order_ID]) }}">{{ $Order->Order_ID }}</a>
                                        </h6>
                                    </td>
                                    <td>
                                        <h6 class="mb-1 fs-16">{{ $Order->basic_info->order_status }}</h6>
                                    </td>
                                    <td>{{ $Order->client_info->Client_Name }}</td>
                                    <td>
                                        <strong>Created By:</strong>
                                        {{ isset($Order->authorized_user) && $Order->authorized_user->basic_info ? $Order->authorized_user->basic_info->full_name : '' }}
                                        <br>
                                        @forelse($Order->assign as $User)
                                            <strong class="text-success">{{ $User->basic_info->full_name }}</strong>
                                            <br>
                                        @empty
                                            <strong class="text-danger"> Not Assign</strong> <br>
                                        @endforelse
                                        <strong>Created At:</strong> {{ $Order->created_at }}
                                    </td>
                                    <td>
                                        <strong>Website</strong> {{ $Order->basic_info->Order_Website }}<br>
                                        <strong>Service</strong> {{ $Order->basic_info->Order_Services }}
                                    </td>
                                    <td>
                                        <strong>Word Count:</strong> {{ $Order->basic_info->Word_Count }}<br>
                                        <strong>Page Count:</strong> {{ $Order->basic_info->Pages_Count }}
                                    </td>
                                    <td>
                                        <strong>Amount:</strong> {{ $Order->payment_info->Order_Price }}<br>
                                        <strong>Status:</strong> {!! PortalHelpers::visualizeRecordStatus($Order->payment_info->Payment_Status) !!}
                                    </td>
                                    <td>
                                        <strong>Deadline: </strong>{{ $Order->submission_info->DeadLine }} <br>
                                        <strong>Time: </strong>{{ $Order->submission_info->DeadLine_Time }}
                                    </td>
                                    <td>
                                        @if (isset($Order->submission_info->F_DeadLine))
                                            <strong>1st Draft: </strong>{{ $Order->submission_info->F_DeadLine }} <br>
                                        @endif
                                        @if (isset($Order->submission_info->S_DeadLine))
                                            <strong>2nd Draft: </strong>{{ $Order->submission_info->S_DeadLine }} <br>
                                        @endif
                                        @if (isset($Order->submission_info->T_DeadLine))
                                            <strong>3rd Draft: </strong>{{ $Order->submission_info->T_DeadLine }}
                                        @endif
                                    </td>
                                </tr>
                            @empty
                            @endforelse
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
    {{-- Admin End View --}}
@elseif((int) $auth_user->Role_ID === 9 || (int) $auth_user->Role_ID === 10 || (int) $auth_user->Role_ID === 11)
    {{-- Sales View --}}
    <div class="card mt-4">
        <div class="card-header border-bottom-0">
            <div class="card-title">Research Orders List</div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-nowrap border-bottom" id="responsive-datatable">
                    <thead>
                        <tr>
                            <th class="wd-15p border-bottom-0">S.No</th>
                            <th class="wd-15p border-bottom-0">Order ID</th>
                            <th class="wd-15p border-bottom-0">Order Status</th>
                            <th class="wd-15p border-bottom-0">Client Name</th>
                            <th class="wd-20p border-bottom-0">Created & Assign</th>
                            <th class="wd-10p border-bottom-0">Order From</th>
                            <th class="wd-25p border-bottom-0">Order Info</th>
                            <th class="wd-25p border-bottom-0">Order Price</th>
                            <th class="wd-25p border-bottom-0">Deadline</th>
                            <th class="wd-25p border-bottom-0"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($Research_Orders as $Order)
                            <tr>
                                <td><strong>{{ $loop->iteration }}</strong></td>
                                <td>
                                    <h6 class="mb-1 fs-16"><a
                                            href="{{ route('Order.Details', ['Order_ID' => $Order->Order_ID]) }}">{{ $Order->Order_ID }}</a>
                                    </h6>
                                </td>
                                <td>
                                    <h6 class="mb-1 fs-16">{!! PortalHelpers::visualizeRecordStatus($Order->basic_info->order_status) !!}</h6>
                                </td>
                                <td>{{ $Order->client_info->Client_Name }}</td>
                                <td>
                                    <strong>Created By:</strong>
                                    {{ isset($Order->authorized_user) && $Order->authorized_user->basic_info ? $Order->authorized_user->basic_info->full_name : '' }}
                                    <br>
                                    <strong>Created At:</strong> {{ $Order->created_at }}
                                </td>
                                <td>
                                    <strong>Website</strong> {{ $Order->basic_info->Order_Website }}<br>
                                    <strong>Service</strong> {{ $Order->basic_info->Order_Services }}
                                </td>
                                <td>
                                    <strong>Word Count:</strong> {{ $Order->basic_info->Word_Count }}<br>
                                    <strong>Page Count:</strong> {{ $Order->basic_info->Pages_Count }}
                                </td>
                                <td>
                                    <strong>Amount:</strong> {{ $Order->payment_info->Order_Price }}<br>
                                    <strong>Status:</strong> {!! PortalHelpers::visualizeRecordStatus($Order->payment_info->Payment_Status) !!}
                                </td>
                                <td>
                                    <strong>Deadline: </strong>{{ $Order->submission_info->DeadLine }} <br>
                                    <strong>Time: </strong>{{ $Order->submission_info->DeadLine_Time }}
                                </td>
                                <td>
                                    @if (isset($Order->submission_info->F_DeadLine))
                                        <strong>1st Draft: </strong>{{ $Order->submission_info->F_DeadLine }} <br>
                                    @endif
                                    @if (isset($Order->submission_info->S_DeadLine))
                                        <strong>2nd Draft: </strong>{{ $Order->submission_info->S_DeadLine }} <br>
                                    @endif
                                    @if (isset($Order->submission_info->T_DeadLine))
                                        <strong>3rd Draft: </strong>{{ $Order->submission_info->T_DeadLine }}
                                    @endif
                                </td>
                            </tr>
                        @empty
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@elseif((int) $auth_user->Role_ID === 4)
    <div class="card mt-4">
         <div class="card-header border-bottom-0 d-flex justify-content-between align-items-center">
            <div class="card-title">Research Orders List</div>
            <div class="d-flex align-items-center">
                <form method="GET" action="" class="d-flex align-items-center">
                <div class="btn-group mb-2 me-2 d-flex flex-column">
                    <label for="selectBox" class="form-label">Writters:</label>
                    <select class="form-select" id="selectBox" name="writer">
                        <option value="All">All writers</option>
                      @foreach($Writters as $w)
                        <option value="{{$w->id}}" @selected($w->id == request('writer'))>{{$w->basic_info->FullName}}</option>
                      @endforeach
                    </select>
                </div>
                <div class="btn-group mb-2 me-2 d-flex flex-column">
                        <label for="selectBox" class="form-label">Start Date</label>
                        <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}">
                </div>
                <div class="btn-group mb-2 me-2 d-flex flex-column">
                        <label for="selectBox" class="form-label">End Date</label>
                        <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}">
                </div>
                <div class="btn-group mb-2 me-2 d-flex flex-column pt-2">
                       <button type="submit" class="btn btn-primary">Apply Filters</button>
                </div>
                
                </form>
                <div class="btn-group mt-2 mb-2 me-2">
                    <button class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        Filters <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="{{ route('Research.Orders') }}">All</a></li>
                        <li><a href="{{ route('Research.Orders', ['filter' => 'Not-Assign']) }}">Not Assign Order</a>
                        </li>
                    </ul>
                </div>
                <div>
                    
                    <a href="{{ route('Research.Orders') }}" class="btn btn-primary">Clear all filters</a>
                </div>

            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                @if (request()->has('filter'))
                    <table class="table table-bordered text-nowrap border-bottom" id="responsive-datatable">
                        <thead>
                            <tr>
                                <th class="wd-15p border-bottom-0">S.No</th>
                                <th class="wd-15p border-bottom-0">Order ID</th>
                                <th class="wd-15p border-bottom-0">Order Status</th>
                                <th class="wd-20p border-bottom-0">Order Assign</th>
                                <th class="wd-25p border-bottom-0">Services</th>
                                <th class="wd-25p border-bottom-0">Word Count</th>
                                <th class="wd-25p border-bottom-0">Page Count</th>
                                <th class="wd-25p border-bottom-0"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($unAssignedOrder as $Order)
                                <tr>
                                    <td><strong>{{ $loop->iteration }}</strong></td>
                                    <td>
                                        <h6 class="mb-1 fs-16"><a
                                                href="{{ route('Order.Details', ['Order_ID' => $Order->Order_ID]) }}">{{ $Order->Order_ID }}</a>
                                        </h6>
                                    </td>
                                    <td>
                                        @if (isset($Order->basic_info->order_status))
                                            {{ $Order->basic_info->order_status }}
                                        @endif
                                    </td>
                                    <td>
                                        @forelse($Order->assign as $User)
                                            <strong class="text-success">{{ $User->basic_info->full_name }}</strong>
                                            <br>
                                        @empty
                                            @php
                                                $assignment = PortalHelpers::checkIsTaskAssign($Order->id);
                                            @endphp
                                            <p>{!! $assignment !!}</p><br>
                                        @endforelse
                                    </td>
                                    <td>
                                        @if (isset($Order->basic_info->Order_Services))
                                            {{ $Order->basic_info->Order_Services }}
                                        @endif

                                    </td>
                                    <td>
                                        @if (isset($Order->basic_info->Word_Count))
                                            {{ $Order->basic_info->Word_Count }}
                                        @endif
                                    </td>
                                    <td>
                                        @if (isset($Order->basic_info->Pages_Count))
                                            {{ $Order->basic_info->Pages_Count }}
                                        @endif
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
                @elseif(request()->has('start_date'))
                    <table class="table table-vcenter text-nowrap border-top dead-line-orders mb-0" id="responsive-datatable">
                        <thead>
                            <tr>
                                <th class="wd-10p border-bottom-0">S.No</th>
                                <th class="wd-10p border-bottom-0">Order Code</th>
                               
                                <th class="wd-10p border-bottom-0">Assign</th>
                                @if ((int) $auth_user->Role_ID === 4)
                                    <th class="wd-10p border-bottom-0">Order Type</th>
                                @endif
                                <th class="w-15p border-bottom-0">Words Count</th>
                                <th class="wd-20p border-bottom-0">Deadline</th>
                                <th class="wd-25p border-bottom-0">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                          
                            @forelse($Research_Orders as $Order)
                            
                               
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <div class="d-flex">
                                            <div class="me-3 mt-0 mt-sm-2 d-block">
                                                <h6 class="mb-1 fs-16">
                                                    @if ($Order['Order_Type'] == 2)
                                                        <a
                                                            href="{{ route('Content.Order.Details', ['Order_ID' => $Order['Order_ID']]) }}">
                                                        @elseif($Order['Order_Type'] == 3)
                                                            <a
                                                                href="{{ route('Design.Order.View', ['Order_ID' => $Order['Order_ID']]) }}">
                                                            @elseif($Order['Order_Type'] == 1)
                                                                <a
                                                                    href="{{ route('Order.Details', ['Order_ID' => $Order['Order_ID']]) }}">
                                                                @elseif($Order['Order_Type'] == 4)
                                                                    <a
                                                                        href="{{ route('Development.Order.View', ['Order_ID' => $Order['Order_ID']]) }}">
                                                    @endif
                                                    {{ $Order['Order_ID'] }}
                                                    </a>
                                                </h6>
                                            </div>
                                        </div>

                                    </td>
                                     <td>
                                       <p>{{$Order['F_Name'] && $Order['L_Name'] ?  $Order['F_Name'] .' '. $Order['L_Name'] : "Not Assign"}}</p>
                                        </td>
                                    @if (
                                        (int) $auth_user->Role_ID === 1 ||
                                            (int) $auth_user->Role_ID === 9 ||
                                            (int) $auth_user->Role_ID === 10 ||
                                            (int) $auth_user->Role_ID === 11)
                                        <td>{{ $Order['Client_Name'] }}</td>
                                    @endif
                                    @if ((int) $auth_user->Role_ID === 4)
                                        <td>{{ $Order['Order_Type'] == 2 ? 'Content Writing Order' : 'Reseacrh Writing Order' }}
                                        </td>
                                    @endif
                                    
                                    <td>{{ $Order['Word_Count'] ?? 'No word count' }}</td>
                                    <td>
                                        @if (isset($Order['DeadLine']))
                                            {{ $Order['DeadLine'] }} <span class="text-danger">(Deadline)</span>
                                        @elseif(isset($Order['F_DeadLine']))
                                            {{ $Order['F_DeadLine'] }} <span class="text-danger">(First
                                                Draft)</span>
                                        @elseif(isset($Order['S_DeadLine']))
                                            {{ $Order['S_DeadLine'] }} <span class="text-danger">(Second
                                                Draft)</span>
                                        @elseif(isset($Order['T_DeadLine']))
                                            {{ $Order['T_DeadLine'] }} <span class="text-danger">(Third
                                                Draft)</span>
                                        @elseif(isset($Order['Four_DeadLine']))
                                            {{ $Order['Four_DeadLine'] }} <span class="text-danger">(Fourth
                                                Draft)</span>
                                        @elseif(isset($Order['Fifth_DeadLine']))
                                            {{ $Order['Fifth_DeadLine'] }} <span class="text-danger">(Fifth
                                                Draft)</span>
                                        @elseif(isset($Order['Sixth_DeadLine']))
                                            {{ $Order['Sixth_DeadLine'] }} <span class="text-danger">(Sixth
                                                Draft)</span>
                                        @elseif(isset($Order['Seven_DeadLine']))
                                            {{ $Order['Seven_DeadLine'] }} <span class="text-danger">(Seventh
                                                Draft)</span>
                                        @elseif(isset($Order['Eight_DeadLine']))
                                            {{ $Order['Eight_DeadLine'] }} <span class="text-danger">(Eighth
                                                Draft)</span>
                                        @elseif(isset($Order['nine_DeadLine']))
                                            {{ $Order['nine_DeadLine'] }} <span class="text-danger">(Ninth
                                                Draft)</span>
                                        @elseif(isset($Order['ten_DeadLine']))
                                            {{ $Order['ten_DeadLine'] }} <span class="text-danger">(Tenth
                                                Draft)</span>
                                        @elseif(isset($Order['eleven_DeadLine']))
                                            {{ $Order['eleven_DeadLine'] }} <span class="text-danger">(Eleventh
                                                Draft)</span>
                                        @elseif(isset($Order['twelve_DeadLine']))
                                            {{ $Order['twelve_DeadLine'] }} <span class="text-danger">(Twelfth
                                                Draft)</span>
                                        @elseif(isset($Order['thirteen_DeadLine']))
                                            {{ $Order['thirteen_DeadLine'] }} <span class="text-danger">(Thirteenth
                                                Draft)</span>
                                        @elseif(isset($Order['fourteen_DeadLine']))
                                            {{ $Order['fourteen_DeadLine'] }} <span class="text-danger">(Fourteenth
                                                Draft)</span>
                                        @elseif(isset($Order['fifteen_DeadLine']))
                                            {{ $Order['fifteen_DeadLine'] }} <span class="text-danger">(Fifteenth
                                                Draft)</span>
                                        @else
                                            No Deadline
                                        @endif
                                    </td>
                                    @if ($Order['Order_Status'] == 0)
                                        <td>Working</td>
                                    @elseif($Order['Order_Status'] == 1)
                                        <td>Canceled</td>
                                    @elseif($Order['Order_Status'] == 2)
                                        <td>Completed</td>
                                    @elseif($Order['Order_Status'] == 3)
                                        <td>Revision</td>
                                    @endif
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

                        </tbody>
                    </table>
                @else
                    <table class="table table-bordered text-nowrap border-bottom" id="responsive-datatable">
                        <thead>
                            <tr>
                                <th class="wd-15p border-bottom-0">S.No</th>
                                <th class="wd-15p border-bottom-0">Order ID</th>
                                <th class="wd-15p border-bottom-0">Order Status</th>
                                <th class="wd-20p border-bottom-0">Order Assign</th>
                                <th class="wd-25p border-bottom-0">Services</th>
                                <th class="wd-25p border-bottom-0">Word Count</th>
                                <th class="wd-25p border-bottom-0">Page Count</th>
                                <th class="wd-25p border-bottom-0">DeadLine Date</th>
                                <th class="wd-25p border-bottom-0">DeadLine Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($Research_Orders as $Order)
                                <tr>
                                    <td><strong>{{ $loop->iteration }}</strong></td>
                                    <td>
                                        <h6 class="mb-1 fs-16"><a
                                                href="{{ route('Order.Details', ['Order_ID' => $Order->Order_ID]) }}">{{ $Order->Order_ID }}</a>
                                        </h6>
                                    </td>
                                    <td>
                                        <h6 class="mb-1 fs-16">{{ $Order->basic_info->order_status }}</h6>
                                    </td>
                                    <td>
                                        @forelse($Order->assign as $User)
                                            <strong class="text-success">{{ $User->basic_info->full_name }}</strong>
                                            <br>
                                        @empty
                                            @php
                                                $assignment = PortalHelpers::checkIsTaskAssign($Order->id);
                                            @endphp
                                            <p>{!! $assignment !!}</p><br>
                                        @endforelse
                                    </td>
                                    <td>
                                        {{ $Order->basic_info->Order_Services }}
                                    </td>
                                    <td>
                                        {{ $Order->basic_info->Word_Count }}
                                    </td>
                                    <td>
                                        {{ $Order->basic_info->Pages_Count }}
                                    </td>
                                    <td>
                                        {{ $Order->submission_info->DeadLine ?? '' }} <br>
                                    </td>
                                    <td>
                                        {{ $Order->submission_info->DeadLine_Time }}
                                    </td>
                                </tr>
                            @empty
                            @endforelse
                        </tbody>
                    </table>
                @endif

            </div>
        </div>
    </div>
    {{-- Manager End View --}}
@elseif((int) $auth_user->Role_ID === 5)
    {{-- Coordinator View --}}
    <div class="card mt-4">
        <div class="card-header border-bottom-0">
            <div class="card-title">Research Orders List</div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-nowrap border-bottom" id="responsive-datatable">
                    <thead>
                        <tr>
                            <th class="wd-15p border-bottom-0">S.No</th>
                            <th class="wd-15p border-bottom-0">Order ID</th>
                            <th class="wd-15p border-bottom-0">Order Status</th>
                            <th class="wd-25p border-bottom-0">Services</th>
                            <th class="wd-25p border-bottom-0">Word Count</th>
                            <th class="wd-25p border-bottom-0">Page Count</th>
                            <th class="wd-25p border-bottom-0">Deadline</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($Research_Orders as $Order)
                            <tr>
                                <td><strong>{{ $loop->iteration }}</strong></td>
                                <td>
                                    <h6 class="mb-1 fs-16"><a
                                            href="{{ route('Order.Details', ['Order_ID' => $Order->Order_ID]) }}">{{ $Order->Order_ID }}</a>
                                    </h6>
                                </td>
                                <td>
                                    <h6 class="mb-1 fs-16">{!! PortalHelpers::visualizeRecordStatus($Order->basic_info->order_status) !!}</h6>
                                </td>
                                <td>
                                    {{ $Order->basic_info->Order_Services }}
                                </td>
                                <td>
                                    {{ $Order->basic_info->Word_Count }}
                                </td>
                                <td>
                                    {{ $Order->basic_info->Pages_Count }}
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
    {{-- Coordinator End View --}}
@elseif((int) $auth_user->Role_ID === 6)
    {{-- Research Writer View --}}
    <div class="card mt-4">
        <div class="card-header border-bottom-0">
            <div class="card-title">Research Orders List</div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-nowrap border-bottom" id="responsive-datatable">
                    <thead>
                        <tr>
                            <th class="wd-15p border-bottom-0">S.No</th>
                            <th class="wd-15p border-bottom-0">Order ID</th>
                            <th class="wd-15p border-bottom-0">Task Status</th>
                            <th class="wd-25p border-bottom-0">Task Service</th>
                            <th class="wd-25p border-bottom-0">Word Count</th>
                            <th class="wd-25p border-bottom-0">Deadline</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($Research_Orders as $Order)
                            <tr>
                                <td><strong>{{ $loop->iteration }}</strong></td>
                                <td>
                                    <h6 class="mb-1 fs-16"><a
                                            href="{{ route('Order.Details', ['Order_ID' => $Order->order_info->Order_ID]) }}">{{ $Order->order_info->Order_ID }}</a>
                                    </h6>
                                </td>
                                <td>
                                    <h6 class="mb-1 fs-16">{!! PortalHelpers::visualizeRecordStatus($Order->Task_Status) !!}</h6>
                                </td>
                                <td>
                                    {{ $Order->order_info->basic_info->Order_Services }}
                                </td>
                                <td>
                                    {{ $Order->Assign_Words }}
                                </td>
                                <td>
                                    <strong>Deadline: </strong>{{ $Order->DeadLine }} <br>
                                    <strong>Time: </strong>{{ $Order->DeadLine_Time }}
                                </td>
                            </tr>
                        @empty
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{-- Research Writer End View --}}
@elseif((int) $auth_user->Role_ID === 7)
    {{-- Research Indepenent Writer View --}}
    <div class="card mt-4">
        <div class="card-header border-bottom-0">
            <div class="card-title">Research Orders List</div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-nowrap border-bottom" id="responsive-datatable">
                    <thead>
                        <tr>
                            <th class="wd-15p border-bottom-0">S.No</th>
                            <th class="wd-15p border-bottom-0">Order ID</th>
                            <th class="wd-15p border-bottom-0">Order Status</th>
                            <th class="wd-25p border-bottom-0">Task Info</th>
                            <th class="wd-25p border-bottom-0">Deadline</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($IndependentWriterOrder as $Order)
                            <tr>
                                <td><strong>{{ $loop->iteration }}</strong></td>
                                <td>
                                    <h6 class="mb-1 fs-16"><a
                                            href="{{ route('Order.Details', ['Order_ID' => $Order->Order_ID]) }}">{{ $Order->Order_ID }}</a>
                                    </h6>
                                </td>
                                <td>
                                    <h6 class="mb-1 fs-16">{!! PortalHelpers::visualizeRecordStatus($Order->basic_info->order_status) !!}</h6>
                                </td>
                                <td>
                                    <strong>Service:</strong> {{ $Order->basic_info->Order_Services }}<br>
                                    <strong>Word Count:</strong> {{ $Order->basic_info->Word_Count }}
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
    {{-- Research Indepenent Writer End View --}}
@endif
<script>
    $('#DataTable-4').DataTable();
</script>

