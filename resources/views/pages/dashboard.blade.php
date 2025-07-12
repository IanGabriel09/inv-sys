@extends('_layouts.app')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Dashboard</h1>
</div>

{{-- Summary Cards --}}
<div class="row mb-4">
    @foreach (['Total Users' => 0, 'Total Items' => 0, 'Assigned' => 0, 'Unassigned' => 0] as $label => $count)
    <div class="col-md-3 mb-1">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <h6 class="card-title text-muted">{{ $label }}</h6>
                <h3 class="card-text">{{ $count }}</h3>
            </div>
        </div>
    </div>
    @endforeach
</div>

{{-- Recent assignments and Pie-chart --}}
<div class="row">
    {{-- Inventory Assignment Status Pie Chart --}}
    <div class="col-lg-4 col-md-12">
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header">
                <h5 class="mb-0">Inventory Assignment Status</h5>
            </div>
            <div class="card-body">
                <div id="assignmentStatusChart" style="width: 100%; height: 0; padding-bottom: 75%; position: relative;">
                    <div id="assignmentStatusChartInner" style="position: absolute; top: 0; left: 0; right: 0; bottom: 0;"></div>
                </div>
            </div>

        </div>
    </div>

    {{-- Recent Assignments --}}
    <div class="col-lg-8 col-md-12">
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header">
                <h5 class="mb-0">Recent Assignments</h5>
            </div>
            <div class="card-body p-0">
                <table class="table mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>User</th>
                            <th>Item</th>
                            <th>Assigned By</th>
                            <th>Assigned At</th>
                            <th>Returned At</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>John Doe</td>
                            <td>HP Laptop</td>
                            <td>Admin A</td>
                            <td>2025-07-01</td>
                            <td>—</td>
                        </tr>
                        <tr>
                            <td>Jane Smith</td>
                            <td>Dell Monitor</td>
                            <td>Admin B</td>
                            <td>2025-06-30</td>
                            <td>2025-07-03</td>
                        </tr>
                        <tr>
                            <td colspan="5" class="text-center text-muted">... more rows ...</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="row">
    {{-- Top Active Users --}}
    <div class="col-lg-6 col-md-12">
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header">
                <h5 class="mb-0">Top Active Users</h5>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Maria Gonzales</span>
                        <span class="badge bg-primary">5 items</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Kevin Tan</span>
                        <span class="badge bg-primary">4 items</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Luis Reyes</span>
                        <span class="badge bg-primary">4 items</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    {{-- Recently Added Items --}}
    <div class="col-lg-6 col-md-12">
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header">
                <h5 class="mb-0">Recently Added Items</h5>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Acer Monitor - Added on 2025-07-09</li>
                    <li class="list-group-item">Logitech Keyboard - Added on 2025-07-08</li>
                    <li class="list-group-item">HP ProBook - Added on 2025-07-07</li>
                </ul>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<!-- Load Google Charts -->
<script src="https://www.gstatic.com/charts/loader.js"></script>
<script>
    google.charts.load('current', {
        packages: ['corechart']
    });

    let chart, data, options;

    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        data = google.visualization.arrayToDataTable([
            ['Status', 'Count'],
            ['Assigned', 75],
            ['Unassigned', 25]
        ]);

        options = {
            pieHole: 0.4,
            colors: ['#198754', '#dc3545'],
            chartArea: { width: '100%', height: '100%' },
            legend: { position: 'bottom' }
        };

        chart = new google.visualization.PieChart(document.getElementById('assignmentStatusChartInner'));
        chart.draw(data, options);
    }

    // Make chart responsive
    window.addEventListener('resize', () => {
        if (chart && data && options) {
            chart.draw(data, options);
        }
    });
</script>
@endsection

