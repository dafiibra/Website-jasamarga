@extends('layouts.dashboard_app')

@section('title', 'Visual AI Pothole Detection Dashboard')

@section('content')
    <div class=" mt-3 ">
        <!-- Cards -->
        <div class="metrics-card bg-light row p-4 pb-0 rounded mb-4 ms-0 me-0">
            <div class="col-md-4 mb-3">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Total Temuan Model</h5>
                        <p class="card-text">{{ array_sum($data['totalTemuan']) }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card text-white bg-success mb-3">
                    <div class="card-body">
                        <h5 class="card-title">True Pothole</h5>
                        <p class="card-text">{{ array_sum($data['verified']) }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card text-white bg-info mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Akurasi Model</h5>
                        <p class="card-text">{{ $data['accuracy'] }}%</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts -->
        <div class="metrics-card bg-light row p-4 pb-0 rounded mb-4 ms-0 me-0">
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Jumlah Temuan Model</h5>
                        <canvas id="temuanChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Evaluation Metrics</h5>
                        <canvas id="metricsChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart.js Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const temuanData = {
                labels: @json($data['months']),
                datasets: [{
                    label: 'Total Temuan',
                    data: @json($data['totalTemuan']),
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }, {
                    label: 'Verified',
                    data: @json($data['verified']),
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            };

            const metricsData = {
                labels: @json($data['months']),
                datasets: [{
                    label: 'Accuracy',
                    data: Array(6).fill(@json($data['accuracy'])),
                    borderColor: 'rgb(255, 99, 132)',
                    fill: false
                }, {
                    label: 'Precision',
                    data: Array(6).fill(@json($data['precision'])),
                    borderColor: 'rgb(54, 162, 235)',
                    fill: false
                }, {
                    label: 'Recall',
                    data: Array(6).fill(@json($data['recall'])),
                    borderColor: 'rgb(75, 192, 192)',
                    fill: false
                }]
            };

            const ctxTemuan = document.getElementById('temuanChart').getContext('2d');
            const temuanChart = new Chart(ctxTemuan, {
                type: 'bar',
                data: temuanData,
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            const ctxMetrics = document.getElementById('metricsChart').getContext('2d');
            const metricsChart = new Chart(ctxMetrics, {
                type: 'line',
                data: metricsData,
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
@endsection
