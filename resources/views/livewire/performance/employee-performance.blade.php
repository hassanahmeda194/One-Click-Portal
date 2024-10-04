<div class="page-header d-xl-flex d-block">
    <div class="page-leftheader">
        <h4 class="page-title">Users <span class="font-weight-normal text-muted ms-2">Performances</span></h4>
    </div>
</div>
<div class="card">
    <div class="panel-body tabs-menu-body hremp-tabs1 p-0">
        <div class="tab-content">
            <div class="tab-pane active">
                <div class="card-body">
                    <div class="my-4">
                        <div class="row mb-0 pb-0">
                            <div class="col-md-6 col-xl-3 text-center py-5">
                                <span
                                    class="avatar avatar-md bradius fs-20 bg-primary-transparent text-black w-auto px-2">{{ number_format($totalBenchMarks) }}</span>
                                <h5 class="mb-0 mt-3">Total Employee Bench mark</h5>
                            </div>
                            <div class="col-md-6 col-xl-3 text-center py-5 ">
                                <span
                                    class="avatar avatar-md bradius fs-20 bg-success-transparent text-black  w-auto px-2">{{ number_format($totalAchievedWordCount) }}</span>
                                <h5 class="mb-0 mt-3">Achive word</h5>
                            </div>
                            <div class="col-md-6 col-xl-3 text-center py-5">
                                <span
                                    class="avatar avatar-md bradius fs-20 bg-danger-transparent text-black w-auto px-2">{{ number_format($totalCancelWordCount) }}</span>
                                <h5 class="mb-0 mt-3">Cancel words</h5>
                            </div>
                            <div class="col-md-6 col-xl-3 text-center py-5">
                                <span
                                    class="avatar avatar-md bradius fs-20 bg-warning-transparent text-black  w-auto px-2">{{ number_format($PerformancePercentage, 2) }}%</span>
                                <h5 class="mb-0 mt-3">Performance percentage</h5>
                            </div>
                        </div>
                    </div>
                    <hr>
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

                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <ul class="nav nav-tabs mb-4 ms-2" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active text-black" id="tab1-tab" data-bs-toggle="tab" href="#tab1" role="tab"
                    aria-controls="tab1" aria-selected="true">Content Writer</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-black" id="tab2-tab" data-bs-toggle="tab" href="#tab2" role="tab"
                    aria-controls="tab2" aria-selected="false">Research Writer</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1-tab">
                <div class="table-responsive">
                    <table class="table table-vcenter text-nowrap table-bordered border-bottom"
                        id="responsive-datatable">
                        <thead>
                            <tr>
                                <th class="border-bottom-0 text-center">No</th>
                                <th class="border-bottom-0">Name</th>
                                <th class="border-bottom-0">Target word</th>
                                <th class="border-bottom-0">Achieve Word</th>
                                <th class="border-bottom-0">Cancel word</th>
                                <th class="border-bottom-0">Cancel Percentage</th>
                                <th class="border-bottom-0">Total Achieved Word</th>
                                <th class="border-bottom-0">Performance Percentage</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($User_Performance as $performance)
                                @if (in_array($performance->Role_ID, [5, 7]))
                                    @continue
                                @endif
                                <tr>
                                    <td class="border-bottom-0 text-center">{{ $loop->iteration }}</td>
                                    <td class="border-bottom-0">
                                        <a href="#" data-id="{{ $performance->id }}" class="getEmployeeID"
                                            data-start-date="{{ request('start_date') ? request('start_date') : null }}"
                                            data-end-date="{{ request('end_date') ? request('end_date') : null }}">
                                            {{ $performance->basic_info->getFullNameAttribute() }}
                                        </a>
                                    </td>
                                    <td class="border-bottom-0">
                                        {{ $performance->bench_mark->first()['Bench_Mark'] ?? 0 }}
                                    </td>
                                    @php
                                        $achievedWordSum = $performance->performance->sum('achieved_word');
                                        $cancelWordSum = $performance->performance->sum('cancel_word');
                                    @endphp
                                    <td class="border-bottom-0">{{ $achievedWordSum ?? 0 }}</td>
                                    <td class="border-bottom-0">{{ $cancelWordSum ?? 0 }}</td>
                                    @php
                                        $cancelPercentage =
                                            $achievedWordSum != 0 ? ($cancelWordSum / $achievedWordSum) * 100 : 0;
                                    @endphp
                                    <td class="border-bottom-0">{{ $cancelPercentage }}%</td>
                                    @php
                                        $benchMark = $performance->bench_mark->first()['Bench_Mark'] ?? 0;
                                        $totalArchivedWord = $achievedWordSum - $cancelWordSum;
                                        $performancePercentage =
                                            $benchMark != 0 ? ($totalArchivedWord / $benchMark) * 100 : 0;
                                    @endphp
                                    <td class="border-bottom-0">{{ $totalArchivedWord }}</td>
                                    <td class="border-bottom-0">{{ number_format($performancePercentage, 2) }}%
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="tab2-tab">
                <div class="table-responsive">
                    <table class="table table-vcenter text-nowrap table-bordered border-bottom"
                        id="responsive-datatable1">
                        <thead>
                            <tr>
                                <th class="border-bottom-0 text-center">No</th>
                                <th class="border-bottom-0">Name</th>
                                <th class="border-bottom-0">Target word</th>
                                <th class="border-bottom-0">Achieve Word</th>
                                <th class="border-bottom-0">Cancel word</th>
                                <th class="border-bottom-0">Cancel Percentage</th>
                                <th class="border-bottom-0">Total Achieved Word</th>
                                <th class="border-bottom-0">Performance Percentage</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($User_Performance as $performance)
                                @if (in_array($performance->Role_ID, [8, 12]))
                                    @continue
                                @endif
                                <tr>
                                    <td class="border-bottom-0 text-center">{{ $loop->iteration }}</td>
                                    <td class="border-bottom-0">
                                        <a href="#" data-id="{{ $performance->id }}" class="getEmployeeID"
                                            data-start-date="{{ request('start_date') ? request('start_date') : null }}"
                                            data-end-date="{{ request('end_date') ? request('end_date') : null }}">
                                            {{ $performance->basic_info->getFullNameAttribute() }}
                                        </a>
                                    </td>
                                    <td class="border-bottom-0">
                                        {{ $performance->bench_mark->first()['Bench_Mark'] ?? 0 }}
                                    </td>
                                    @php
                                        $achievedWordSum = $performance->performance->sum('achieved_word');
                                        $cancelWordSum = $performance->performance->sum('cancel_word');
                                    @endphp
                                    <td class="border-bottom-0">{{ $achievedWordSum ?? 0 }}</td>
                                    <td class="border-bottom-0">{{ $cancelWordSum ?? 0 }}</td>
                                    @php
                                        $cancelPercentage =
                                            $achievedWordSum != 0 ? ($cancelWordSum / $achievedWordSum) * 100 : 0;
                                    @endphp
                                    <td class="border-bottom-0">{{ $cancelPercentage }}%</td>
                                    @php
                                        $benchMark = $performance->bench_mark->first()['Bench_Mark'] ?? 0;
                                        $totalArchivedWord = $achievedWordSum - $cancelWordSum;
                                        $performancePercentage =
                                            $benchMark != 0 ? ($totalArchivedWord / $benchMark) * 100 : 0;
                                    @endphp
                                    <td class="border-bottom-0">{{ $totalArchivedWord }}</td>
                                    <td class="border-bottom-0">{{ number_format($performancePercentage, 2) }}%
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{-- @include('performance_table') --}}
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('.getEmployeeID').click(function(e) {
                e.preventDefault();
                var employee_id = $(this).data('id');
                var start_date = $(this).data('data-start-date');
                var end_date = $(this).data('end-start-date');
                var url = "{{ route('get.user.performance.details') }}";
                $.ajax({
                    type: "GET",
                    url: url,
                    data: {
                        id: employee_id,
                        start_date: start_date,
                        end_date: end_date
                    },
                    success: function(response) {
                        console.log(response);
                        $('#User-Data').html(response);
                        $('#PerfomaceDetail').modal('show');
                    }
                });
            });
        });

        $(document).ready(function() {
            $('#responsive-datatable1').DataTable();
        });
    </script>
    <div class="modal fade" id="PerfomaceDetail">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Performance Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                @include('partials.performance.modal')
            </div>
        </div>
    </div>
</div>
