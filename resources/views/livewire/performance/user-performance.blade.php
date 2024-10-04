{{-- @if (!is_null($User_Performance->performance) && is_array($User_Performance->performance)) --}}
<div class="page-header d-xl-flex d-block">
    <div class="page-leftheader">
        <h4 class="page-title">My <span class="font-weight-normal text-muted ms-2">Performance</span></h4>
    </div>
</div>
<div class="card custom-card">
    <div class="card-header border-0">
        <h5 class="card-title">Performance Overview This Month</h5>
    </div>
    <div class="card-body pt-0 pb-3">
        <div class="row mb-0 pb-0">
            <div class="col-md-6 col-lg-1 text-center py-3"> <span
                    class="avatar avatar-md rounded-5 fs-20 bg-primary-transparent text-nowrap w-auto  px-2 text-dark">{{ $User_Performance->performance->count() }}</span>
                <h5 class="mb-0 mt-3">Total Project</h5>
            </div>
            <div class="col-md-6 col-lg-3 text-center py-3"> <span
                    class="avatar avatar-md rounded-5 fs-20 bg-primary-transparent text-nowrap w-auto  px-2 text-dark">{{ $User_Performance->bench_mark->first()->Bench_Mark }}</span>
                <h5 class="mb-0 mt-3">Banchmark</h5>
            </div>
            <div class="col-md-6 col-lg-2 text-center py-3 "> <span
                    class="avatar avatar-md rounded-5 fs-20 bg-success-transparent w-auto  px-2 text-dark">
                    @php
                        $totalAchivedWord = 0;
                        foreach ($User_Performance->performance as $performance) {
                            $totalAchivedWord += $performance->achieved_word;
                        }
                    @endphp
                    {{ $totalAchivedWord }}
                </span>
                <h5 class="mb-0 mt-3">All Achived Words</h5>
            </div>
            <div class="col-md-6 col-lg-2 text-center py-3"> <span
                    class="avatar avatar-md rounded-5 fs-20 bg-danger-transparent w-auto  px-2 text-dark">
                    @php
                        $totalCanclledWord = 0;
                        foreach ($User_Performance->performance as $performance) {
                            $totalCanclledWord += $performance->cancel_word;
                        }
                    @endphp
                    {{ $totalCanclledWord }}</span>
                <h5 class="mb-0 mt-3">All Canclled Word</h5>
            </div>
            <div class="col-md-6 col-lg-2 text-center py-3"> <span
                    class="avatar avatar-md rounded-5 fs-20 bg-warning-transparent w-auto  px-2 text-dark">
                    {{ $totalAchivedWord - $totalCanclledWord }}
                </span>
                <h5 class="mb-0 mt-3">Total words</h5>
            </div>
            <div class="col-md-6 col-lg-2 text-center py-3"> <span
                    class="avatar avatar-md rounded-5 fs-20 bg-warning-transparent w-auto px-2 text-dark">
                    @php
                        $totalWord = $User_Performance->bench_mark->first()->Bench_Mark;
                        $achivedWord = $totalAchivedWord - $totalCanclledWord;
                        $percentage = $totalWord >= 0 ? ($achivedWord / $totalWord) * 100 : 0;
                    @endphp
                    {{ number_format($percentage, 2) }}%
                </span>
                <h5 class="mb-0 mt-3">Peformance percentage</h5>
            </div>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <div class="py-5 mb-5">
                <form action="{{ route('Research.Users.Performance') }}" method="GET">
                    @csrf
                    <div class="row">
                        <div class="col-4">
                            <label for="" class="form-label">start date</label>
                            <input type="date" class="form-control" name="start_date">
                        </div>
                        <div class="col-4">
                            <label for="" class="form-label">end date</label>
                            <input type="date" class="form-control" name="end_date">
                        </div>
                        <div class="col-4 mt-5">
                            <button class="btn btn-primary w-100" type="submit">Search</button>
                        </div>
                    </div>
                </form>
            </div>
            <br>
            <table class="table table-vcenter text-nowrap table-bordered border-bottom" id="responsive-datatable">
                <thead>
                    <tr>
                        <th class="border-bottom-0 text-center">id</th>
                        <th class="border-bottom-0">Order ID</th>
                        <th class="border-bottom-0">Order Status</th>
                        <th class="border-bottom-0">Achieved word</th>
                        <th class="border-bottom-0">Cancel Word</th>
                        <th class="border-bottom-0">performance Percentage</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($User_Performance->performance as $performance)
                        <tr>
                            <td class="border-bottom-0 text-center">{{ $loop->iteration }}</td>
                            @php
                                $performance_ID = PortalHelpers::getOrderNumber($performance->order_id);
                            @endphp
                            <td class="border-bottom-0">
                                {{ $performance_ID['Order_Number'] }}
                            </td>
                            <td class="border-bottom-0">
                                {!! PortalHelpers::visualizeRecordStatus($performance_ID['Order_Status']) !!}</td>
                            </td>
                            <td class="border-bottom-0">{{ $performance->achieved_word }}</td>
                            <td class="border-bottom-0">{{ $performance->cancel_word }}</td>
                            <td class="border-bottom-0">
                                {{ PortalHelpers::getPerformacePercentage($performance->achieved_word, $performance->cancel_word) }}%
                            </td>

                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>
</div>
{{-- @else

@endif --}}
