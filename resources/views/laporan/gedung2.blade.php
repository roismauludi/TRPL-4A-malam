@extends('base.base')
@section('content')
<!-- Main Content -->
<div id="content">
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-flex justify-content-between align-items-center">
            <h1 class="h3 mb-4 text-gray-800">Gedung 2</h1>
            <button type="button" class="btn btn-success ml-auto" onclick="downloadEnergyUsagePDF('{{ $gedung }}')">Download PDF</button>

            <script>
                function downloadEnergyUsagePDF(gedung) {
                    window.location.href = "{{ route('energy-usage.downloadPDF', ['gedung' => ':gedung']) }}".replace(':gedung', gedung);
                }
            </script>
        </div>

        <!-- Content Row -->
        <div class="row">
            <!-- First Card - History -->
            <div class="col-lg-6 mb-4">
                <div class="card shadow">
                    <div class="card-header py-3">
                        <h3 class="m-0 font-weight-bold text-primary">History</h3>
                    </div>
                    <div class="card-body">
                        <div class="chart-area">
                            <canvas id="lineChart2"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Second Card - Doughnut Chart for Gedung 1 -->
            <div class="col-lg-6 mb-4">
                <div class="card shadow">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Gedung 2</h6>
                    </div>
                    <div class="card-body">
                        <div class="chart-pie pt-4">
                            <canvas id="donutChart1"></canvas>
                        </div>
                        <div class="donut-chart-label">
                            <p id="donutChartLabel1">Hari Ini: Loading...</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Additional Content Section -->
        <div class="row justify-center">
            <div class="flex items-center">
                <button class="button-style">
                    <a href="{{ route('turn') }}">
                        <span>Ruangan 1</span>
                    </a>
                </button>
            </div>
        </div>

        <!-- New Section for Comparison of Energy Usage -->
        

        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- End of Main Content -->

<!-- Chart Scripts -->
<script>
    var lineChartData2 = <?php echo json_encode($lineChartData); ?>;
    var doughnutData = <?php echo json_encode($doughnutData); ?>;

    // Debugging Output
    console.log(lineChartData2);
    console.log(doughnutData);

    // Chart Data for lineChart2
    var lineChartConfig2 = {
        labels: lineChartData2.labels,
        datasets: [{
            label: "Energy Usage (kWh)",
            lineTension: 0.3,
            backgroundColor: "rgba(78, 115, 223, 0.05)",
            borderColor: "rgba(78, 115, 223, 1)",
            pointRadius: 3,
            pointBackgroundColor: "rgba(78, 115, 223, 1)",
            pointBorderColor: "rgba(78, 115, 223, 1)",
            pointHoverRadius: 3,
            pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
            pointHoverBorderColor: "rgba(78, 115, 223, 1)",
            pointHitRadius: 10,
            pointBorderWidth: 2,
            data: lineChartData2.values, // Data kWh dari controller
        }],
    };

    // Chart Options for lineChart2
    var lineChartOptions2 = {
        maintainAspectRatio: false,
        layout: {
            padding: {
                left: 10,
                right: 25,
                top: 25,
                bottom: 0
            }
        },
        scales: {
            xAxes: [{
                time: {
                    unit: 'date'
                },
                gridLines: {
                    display: false,
                    drawBorder: false
                },
                ticks: {
                    maxTicksLimit: 7
                }
            }],
            yAxes: [{
                ticks: {
                    maxTicksLimit: 5,
                    padding: 10,
                    callback: function(value, index, values) {
                        return value + ' kWh';
                    }
                },
                gridLines: {
                    color: "rgb(234, 236, 244)",
                    zeroLineColor: "rgb(234, 236, 244)",
                    drawBorder: false,
                    borderDash: [2],
                    zeroLineBorderDash: [2]
                }
            }],
        },
        legend: {
            display: false
        },
        tooltips: {
            backgroundColor: "rgb(255,255,255)",
            bodyFontColor: "#858796",
            titleMarginBottom: 10,
            titleFontColor: '#6e707e',
            titleFontSize: 14,
            borderColor: '#dddfeb',
            borderWidth: 1,
            xPadding: 15,
            yPadding: 15,
            displayColors: false,
            intersect: false,
            mode: 'index',
            caretPadding: 10,
            callbacks: {
                label: function(tooltipItem, chart) {
                    var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                    return datasetLabel + ': ' + tooltipItem.yLabel + ' kWh';
                }
            }
        }
    };

    // Create Line Chart for lineChart2
    var ctxLine2 = document.getElementById('lineChart2').getContext('2d');
    var lineChart2 = new Chart(ctxLine2, {
        type: 'line',
        data: lineChartConfig2,
        options: lineChartOptions2
    });

    // Doughnut Chart Data
    var doughnutChartData = {
        labels: ["Used", "Remaining"],
        datasets: [{
            data: [doughnutData.used, doughnutData.remaining],
            backgroundColor: ['#4e73df', '#858796'],
            hoverBackgroundColor: ['#2e59d9', '#6e707e'],
            hoverBorderColor: "rgba(234, 236, 244, 1)",
        }],
    };

    // Doughnut Chart Options
    var doughnutChartOptions = {
        maintainAspectRatio: false,
        responsive: true,
        cutoutPercentage: 80,
        legend: {
            display: false
        },
        tooltips: {
            backgroundColor: "rgb(255,255,255)",
            bodyFontColor: "#858796",
            borderColor: '#dddfeb',
            borderWidth: 1,
            xPadding: 15,
            yPadding: 15,
            displayColors: false,
            caretPadding: 10,
        },
    };

    // Create Doughnut Chart
    var ctxDoughnut = document.getElementById('donutChart1').getContext('2d');
    var donutChart1 = new Chart(ctxDoughnut, {
        type: 'doughnut',
        data: doughnutChartData,
        options: doughnutChartOptions
    });

    // Update Doughnut Chart Label
    document.getElementById('donutChartLabel1').innerHTML = "Used: " + doughnutData.used + " kWh, Remaining: " + doughnutData.remaining + " kWh";
</script>

<style>
    .btn-toggle {
        border: 1px solid #74C0FC;
        border-radius: 5px;
        padding: 5px 10px;
        cursor: pointer;
        transition: background-color 0.3s, color 0.3s;
    }
</style>

@endsection
@section('title', 'Report Energy Usage')