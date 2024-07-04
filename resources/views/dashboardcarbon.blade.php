@extends('base.base')

@section('content')
    <div class="container mt-5 d-flex justify-content-center">
        <div class="card" style="width: 50%; border-radius: 15px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
            <div class="card-body">
                <h1 class="text-center">CO2 Detection</h1>
                <canvas id="co2Chart" width="400" height="200"></canvas>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var ctx = document.getElementById('co2Chart').getContext('2d');
            var co2Data = {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: 'CO2 Levels',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    pointBackgroundColor: 'rgba(75, 192, 192, 1)',
                    pointBorderColor: '#fff',
                    pointHoverBackgroundColor: '#fff',
                    pointHoverBorderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 2,
                    data: [12, 19, 3, 5, 2, 3, 10, 15, 13, 9, 12, 20],
                    fill: true,
                }]
            };

            var co2Chart = new Chart(ctx, {
                type: 'line',
                data: co2Data,
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        tooltip: {
                            mode: 'index',
                            intersect: false,
                        }
                    },
                    hover: {
                        mode: 'nearest',
                        intersect: true
                    },
                    scales: {
                        x: {
                            display: true,
                            title: {
                                display: true,
                                text: 'Month',
                                color: '#333',
                                font: {
                                    family: 'Arial',
                                    size: 14,
                                    weight: 'bold'
                                }
                            }
                        },
                        y: {
                            display: true,
                            title: {
                                display: true,
                                text: 'CO2 Levels (ppm)',
                                color: '#333',
                                font: {
                                    family: 'Arial',
                                    size: 14,
                                    weight: 'bold'
                                }
                            },
                            beginAtZero: true,
                        }
                    }
                }
            });
        });
    </script>
@endsection
@section('title', 'CO2 Detection')
