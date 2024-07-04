@extends('base.base')
@section('content')
<!-- Main Content -->
<div class="container-fluid">

    <!-- Diagram Garis Perbandingan -->
    <div class="row">
        <!-- Line Chart Card -->
        <div class="col-12">
            <div class="card shadow mb-4 custom-height-card">
                <!-- Custom class custom-height-card for height control -->
                <div class="card-header bg-gray-200 py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Energy Usage Comparison</h6>
                    <div class="btn-group btn-group-sm" role="group">
                        <button type="button" class="btn btn-outline-primary hour active">Hour</button>
                        <button type="button" class="btn btn-outline-primary day">Days</button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="lineChart" style="height: 300px;"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Manajemen Kontrol -->
    <div class="d-flex justify-content-center flex-wrap mb-6">
        <div class="row">
            <!-- Diagram Donat Gedung 1 -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card shadow-lg">
                    <div class="card-header py-3 d-flex justify-content-between align-items-center bg-primary text-white">
                        <h6 class="m-0 font-weight-bold">Energy Usage - Building 1</h6>
                        <i class="fas fa-bolt"></i>
                    </div>
                    <div class="card-body">
                        <div class="chart-container position-relative" style="height:200px;">
                            <canvas id="donutChart1"></canvas>
                            <div class="chart-inner-text text-center position-absolute w-100" style="top:50%; left:50%; transform:translate(-50%, -50%);">
                                <h5 class="mb-0 font-weight-bold">{{ number_format($doughnutData["Building 1"]['used'], 2) }} kWh</h5>
                                <p class="text-muted small">Total</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Diagram Donat Gedung 2 -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card shadow-lg">
                    <div class="card-header py-3 d-flex justify-content-between align-items-center bg-success text-white">
                        <h6 class="m-0 font-weight-bold">Energy Usage - Building 2</h6>
                        <i class="fas fa-bolt"></i>
                    </div>
                    <div class="card-body">
                        <div class="chart-container position-relative" style="height:200px;">
                            <canvas id="donutChart2"></canvas>
                            <div class="chart-inner-text text-center position-absolute w-100" style="top:50%; left:50%; transform:translate(-50%, -50%);">
                                <h5 class="mb-0 font-weight-bold">{{ number_format($doughnutData["Building 2"]['used'], 2) }} kWh</h5>
                                <p class="text-muted small">Total</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Diagram Donat Gedung 3 -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card shadow-lg">
                    <div class="card-header py-3 d-flex justify-content-between align-items-center bg-warning text-white">
                        <h6 class="m-0 font-weight-bold">Energy Usage - Building 3</h6>
                        <i class="fas fa-bolt"></i>
                    </div>
                    <div class="card-body">
                        <div class="chart-container position-relative" style="height:200px;">
                            <canvas id="donutChart3"></canvas>
                            <div class="chart-inner-text text-center position-absolute w-100" style="top:50%; left:50%; transform:translate(-50%, -50%);">
                                <h5 class="mb-0 font-weight-bold">{{ number_format($doughnutData["Building 3"]['used'], 2) }} kWh</h5>
                                <p class="text-muted small">Total</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- End Row -->
</div>
<!-- End of Container Fluid -->

<!-- End of Main Content -->

<!-- Bootstrap core JavaScript-->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

<!-- Charts scripts -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var doughnutData = <?php echo json_encode($doughnutData); ?>;
    var lineChartDataHour = <?php echo json_encode($lineChartDataHour); ?>;
    var lineChartDataDay = <?php echo json_encode($lineChartDataDay); ?>;

    document.addEventListener('DOMContentLoaded', function() {
        // Inisialisasi Line Chart - Comparison
        var lineChart = new Chart(document.getElementById('lineChart').getContext('2d'), {
            type: 'line',
            data: {
                labels: lineChartDataDay['Building 1']['labels'], // Asumsikan semua gedung memiliki label yang sama
                datasets: [{
                    label: 'Building 1',
                    data: lineChartDataDay['Building 1']['values'],
                    borderColor: '#4F46E5',
                    borderWidth: 2,
                    pointRadius: 4,
                    fill: false
                }, {
                    label: 'Building 2',
                    data: lineChartDataDay['Building 2']['values'],
                    borderColor: '#28A745',
                    borderWidth: 2,
                    pointRadius: 4,
                    fill: false
                }, {
                    label: 'Building 3',
                    data: lineChartDataDay['Building 3']['values'],
                    borderColor: '#FFC107',
                    borderWidth: 2,
                    pointRadius: 4,
                    fill: false
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'kWh',
                            font: {
                                weight: 'bold'
                            }
                        },
                        ticks: {
                            stepSize: 100,
                            font: {
                                weight: 'bold'
                            }
                        },
                        grid: {
                            color: '#eee',
                            borderColor: '#ddd',
                            borderWidth: 1
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Tanggal', // Default to 'Tanggal'
                            font: {
                                weight: 'bold'
                            }
                        },
                        ticks: {
                            font: {
                                weight: 'bold'
                            }
                        },
                        grid: {
                            display: false
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: true,
                        labels: {
                            font: {
                                weight: 'bold'
                            }
                        }
                    }
                }
            }
        });

        // Fungsi untuk memperbarui data Line Chart
        function updateLineChartData(data, xTitle) {
            lineChart.data.labels = data['Building 1']['labels'];
            lineChart.data.datasets[0].data = data['Building 1']['values'];
            lineChart.data.datasets[1].data = data['Building 2']['values'];
            lineChart.data.datasets[2].data = data['Building 3']['values'];
            lineChart.options.scales.x.title.text = xTitle; // Perbarui judul sumbu-x
            lineChart.update();
        }

        // Menambahkan event listener klik ke tombol
        const hourBtn = document.querySelector('.hour');
        const dayBtn = document.querySelector('.day');

        hourBtn.addEventListener('click', function() {
            hourBtn.classList.add('active');
            dayBtn.classList.remove('active');
            updateLineChartData(lineChartDataHour, 'Jam'); // Perbarui dengan data jam dan judul sumbu-x 'Jam'
        });

        dayBtn.addEventListener('click', function() {
            dayBtn.classList.add('active');
            hourBtn.classList.remove('active');
            updateLineChartData(lineChartDataDay, 'Tanggal'); // Perbarui dengan data hari dan judul sumbu-x 'Tanggal'
        });

        // Inisialisasi Doughnut Chart - Gedung 1
        var donutChart1 = new Chart(document.getElementById('donutChart1').getContext('2d'), {
            type: 'doughnut',
            data: {
                labels: ['Electricity', 'Remaining'],
                datasets: [{
                    data: [
                        doughnutData["Building 1"]['used'],

                        doughnutData["Building 1"]['totalCapacity'] - doughnutData["Building 1"]['used']
                    ],
                    backgroundColor: ['#4F46E5', '#E5E5E5'],
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '75%',
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        enabled: false
                    }
                }
            }
        });

        // Inisialisasi Doughnut Chart - Gedung 2
        var donutChart2 = new Chart(document.getElementById('donutChart2').getContext('2d'), {
            type: 'doughnut',
            data: {
                labels: ['Electricity', 'Remaining'],
                datasets: [{
                    data: [
                        doughnutData["Building 2"]['used'],
                        doughnutData["Building 2"]['totalCapacity'] - doughnutData["Building 2"]['used']
                    ],
                    backgroundColor: ['#28A745', '#E5E5E5'],
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '75%',
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        enabled: false
                    }
                }
            }
        });

        // Inisialisasi Doughnut Chart - Gedung 3
        var donutChart3 = new Chart(document.getElementById('donutChart3').getContext('2d'), {
            type: 'doughnut',
            data: {
                labels: ['Electricity', 'Remaining'],
                datasets: [{
                    data: [
                        doughnutData["Building 3"]['used'],
                        doughnutData["Building 3"]['totalCapacity'] - doughnutData["Building 3"]['used']
                    ],
                    backgroundColor: ['#FFC107', '#E5E5E5'],
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '75%',
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        enabled: false
                    }
                }
            }
        });
    });
</script>
@endsection
@section('title', 'Energy Usage Dashboard')