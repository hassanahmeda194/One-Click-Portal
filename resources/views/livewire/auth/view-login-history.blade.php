@if (Auth::guard('Authorized')->user()->id == 1)
    <div class="card mt-5">
        <div class="card-header border-bottom-0">
            <div class="card-title">Login History</div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-nowrap border-bottom" id="responsive-datatable">
                    <thead>
                        <tr>
                            <th class="border-bottom-0">S.No</th>
                            <th class="border-bottom-0">User Name</th>
                            <th class="wd-15p border-bottom-0">Date</th>
                            <th class="wd-15p border-bottom-0">Time</th>
                            <th class="wd-15p border-bottom-0">IP Address</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($loginHistory as $History)

                            <tr>
                                <td>
                                    <b>{{ $loop->iteration }}</b>
                                </td>
                                <td>{{ $History->users->basic_info->Full_Name ?? ''}}</td>
                                <td>{{ date('F d, Y', strtotime($History->created_at)) }}</td>
                                <td>{{ date('H:i:s A', strtotime($History->created_at)) }}</td>
                                <td>{{ $History->ip_address }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@else
    <div class="card mt-5">
        <div class="card-header border-bottom-0">
            <div class="card-title">Login History</div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-nowrap border-bottom" id="responsive-datatable">
                    <thead>
                        <tr>
                            <th class="border-bottom-0">S.No</th>
                            <th class="wd-15p border-bottom-0">Date</th>
                            <th class="wd-15p border-bottom-0">Time</th>
                            <th class="wd-15p border-bottom-0">IP Address</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($loginHistory as $History)
                            <tr>
                                <td>
                                    <b>{{ $loop->iteration }}</b>
                                </td>
                                <td>{{ date('F d, Y', strtotime($History->created_at)) }}</td>
                                <td>{{ date('H:i:s A', strtotime($History->created_at)) }}</td>
                                <td>{{ $History->ip_address }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endif
