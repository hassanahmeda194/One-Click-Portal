<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<div class="modal-body" id="User-Data">
    <ul class="nav nav-pills">
        <li class="nav-item p-3">
            <a class="nav-link active" aria-current="page" id="order-details-tab" data-bs-toggle="tab" href="#order-details"
                role="tab" aria-controls="order-details" aria-selected="true">Order
                Details</a>
        </li>
        <li class="nav-item p-3">
            <a class="nav-link" id="current-month-tab" data-bs-toggle="tab" href="#current-month" role="tab"
                aria-controls="current-month" aria-selected="false">Current Month</a>
        </li>
        <li class="nav-item p-3">
            <a class="nav-link" id="last-six-month-tab" data-bs-toggle="tab" href="#last-six-month" role="tab"
                aria-controls="last-six-month" aria-selected="false">Last 6 Month</a>
        </li>
    </ul>
    <div class="tab-content pt-4">
        <div class="tab-pane fade show active" id="order-details" role="tabpanel" aria-labelledby="order-details-tab">
            <!-- Order Details content goes here -->
            @isset($UserData)
                <table class="table table-bordered">
                    <thead class="bg-light">
                        <tr>
                            <th>Order ID</th>
                            <th>Achieved word</th>
                            <th>Cancel word</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $total = 0;
                        @endphp
                        @foreach ($UserData->performance as $data)
                            <tr>
                                <td>{{ $data->order_info->Order_ID }}</td>
                                <td>{{ $data->achieved_word }}</td>
                                <td>{{ $data->cancel_word }}</td>
                            </tr>
                            @php
                                $total += $data->achieved_word;
                            @endphp
                        @endforeach
                        <tr class="bg-light">
                            <td>Total</td>
                            <td class="text-start" colspan="2">{{ $total }}</td>
                        </tr>
                    </tbody>
                </table>
            @else
                <p>No user data available.</p>
            @endisset
        </div>
        <div class="tab-pane fade" id="current-month" role="tabpanel" aria-labelledby="current-month-tab">

            <canvas id="benchMarkPieChart" width="100" height="100"></canvas>
            <!--<p>Total Bench Mark: {{ isset($totalBenchMark) ? $totalBenchMark : '' }}</p>-->

        </div>
        <div class="tab-pane fade" id="last-six-month" role="tabpanel" aria-labelledby="last-six-month-tab">
            <!--<h4>Bar Chart: Performance for Last Six Months</h4>-->
            <canvas id="performanceBarChart" width="400" height="200"></canvas>
        </div>
    </div>
</div>
<script>
    var totalBenchMark = {{ isset($totalBenchMark) ? $totalBenchMark : 0 }};
    var total = {{ isset($total) ? $total : 0 }} // Set default value to 0 if not set
    var ctx = document.getElementById('benchMarkPieChart').getContext('2d');
    var data = {
        labels: ['Bench Mark', 'Achived Word'],
        datasets: [{
            data: [totalBenchMark, total], // Assuming 100 as total
            backgroundColor: [
                'rgba(255, 99, 132, 0.5)', // Red color for bench mark
                'rgba(54, 162, 235, 0.5)' // Blue color for remaining
            ],
            borderWidth: 1
        }]
    };
    var options = {};

    // Create and render the pie chart
    var myPieChart = new Chart(ctx, {
        type: 'pie',
        data: data,
        options: options
    });
</script>
<script>
    var monthlyPerformanceData = {!! isset($monthlyPerformanceSum) ? json_encode($monthlyPerformanceSum) : '0' !!};
    var totalBenchMark = {{ isset($totalBenchMark) ? $totalBenchMark : 0 }};

    var months = Object.keys(monthlyPerformanceData);
    var performanceData = Object.values(monthlyPerformanceData);

    var ctx = document.getElementById('performanceBarChart').getContext('2d');
    var myBarChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: months,
            datasets: [{
                label: 'Performance',
                data: performanceData,
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    max: totalBenchMark
                }
            }
        }
    });
</script>
