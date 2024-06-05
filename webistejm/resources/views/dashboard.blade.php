@extends('layouts.app_dashboard')
@section('content')
<div class="col-9 col-md-4">
    <div class="card text-black mb-3">
        <div class="card-body text-center">
            <h5 class="mb-2 fw-bold">Total Temuan Model</h5>
            <p class="card-text display-4" id="totalTemuanModel">{{ $data['totalTemuanModel'] }}</p>
        </div>
    </div>
</div>
<div class="col-9 col-md-4">
    <div class="card text-black mb-3">
        <div class="card-body text-center">
            <h5 class="mb-2 fw-bold">True Pothole</h5>
            <p class="card-text display-4" id="truePothole">{{ $data['truePothole'] }}</p>                                    </div>
    </div>
</div>
<div class="col-9 col-md-4">
    <div class="card text-black mb-3">
        <div class="card-body text-center">
            <h5 class="mb-2 fw-bold">Akurasi Model</h5>
            <p class="card-text display-4" id="akurasiModel">{{ number_format($data['akurasiModel'], 2) }}%</p>
        </div>
    </div>
</div>
</div>
<!-- Charts -->
<div class="row">
<div class="col-md-6">
    <div class="card ">
        <div class="card-body">
            <h5 class="card-title fw-bold">Jumlah Temuan Model</h5>
            <canvas id="temuanChart"></canvas>
        </div>
    </div>
</div>
<div class="col-md-6">
    <div class="card ">
        <div class="card-body">
            <h5 class="card-title fw-bold">Evaluation Metrics</h5>
            <canvas id="metricsChart"></canvas>
        </div>
    </div>
</div>
</div>

<!-- Chart.js Scripts -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctxTemuan = document.getElementById('temuanChart').getContext('2d');
    const ctxMetrics = document.getElementById('metricsChart').getContext('2d');

    const temuanChart = new Chart(ctxTemuan, {
        type: 'bar',
        data: {
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
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    const metricsChart = new Chart(ctxMetrics, {
        type: 'line',
        data: {
            labels: @json($data['months']),
            datasets: [{
                label: 'Accuracy',
                data: @json($data['accuracy']),
                borderColor: 'rgb(255, 99, 132)',
                fill: false
            }, {
                label: 'Precision',
                data: @json($data['precision']),
                borderColor: 'rgb(54, 162, 235)',
                fill: false
            }, {
                label: 'Recall',
                data: @json($data['recall']),
                borderColor: 'rgb(75, 192, 192)',
                fill: false
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    document.getElementById('filterButton').addEventListener('click', function() {
        const startDate = document.getElementById('startDate').value;
        const endDate = document.getElementById('endDate').value;
        const area = document.getElementById('area').value;

        if (!startDate || !endDate || area === 'Choose...') {
            alert('Please fill in all filter fields.');
            return;
        }

        axios.get('{{ route('dashboard.filter') }}', {
                params: {
                    start_date: startDate,
                    end_date: endDate,
                    area: area
                }
            })
            .then(response => {
                const data = response.data;
                document.getElementById('totalTemuanModel').innerText = data.totalTemuanModel;
                document.getElementById('truePothole').innerText = data.truePothole;
                document.getElementById('akurasiModel').innerText = data.akurasiModel + '%';

                // Update charts with new data
                temuanChart.data.labels = data.months;
                temuanChart.data.datasets[0].data = data.totalTemuan;
                temuanChart.data.datasets[1].data = data.verified;
                temuanChart.update();

                metricsChart.data.labels = data.months;
                metricsChart.data.datasets[0].data = data.accuracy;
                metricsChart.data.datasets[1].data = data.precision;
                metricsChart.data.datasets[2].data = data.recall;
                metricsChart.update();
            })
            .catch(error => {
                console.error('Error fetching data:', error);
            });
    });
});
</script>
@endsection
