@extends('admin.layouts.master')

@section('content')
<section class="section">
    <!-- Section Header -->
    <div class="section-header">
        <h1>Admin Dashboard</h1>
    </div>

    <!-- Stats Row -->
    <div class="row">
        <!-- Total Users -->
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                    <i class="far fa-user"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Users</h4>
                    </div>
                    <div class="card-body">
                        {{ $totalUsers ?? 0 }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Students -->
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-info">
                    <i class="fas fa-book"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Students</h4>
                    </div>
                    <div class="card-body">
                        {{ $totalStudents ?? 0 }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Today’s Exams -->
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                    <i class="fas fa-calendar-alt"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Exams Today</h4>
                    </div>
                    <div class="card-body">
                        {{ $todayExams ?? 0 }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Upcoming Exams -->
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Upcoming Exams</h4>
                    </div>
                    <div class="card-body">
                        {{ $upcomingExams ?? 0 }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Students by Program - Bar Chart -->
    <div class="card mt-4">
        <div class="card-header">
            <h4>Students by Program</h4>
        </div>
        <div class="card-body">
            <canvas id="programChart" height="100"></canvas>
        </div>
    </div>

    <!-- Program Distribution - Donut Chart -->
    <div class="card mt-4">
        <div class="card-header">
            <h4>Program Distribution (Percentage)</h4>
        </div>
        <div class="card-body d-flex justify-content-center">
            <canvas id="programPieChart" style="max-width: 300px; max-height: 300px;"></canvas>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Chart Data
    const programLabels = {!! json_encode($programStats->keys()) !!};
    const programValues = {!! json_encode($programStats->values()) !!};
    const programPercentages = {!! json_encode($programPercentages->values()) !!};

    // Bar Chart - Students by Program
    new Chart(document.getElementById('programChart').getContext('2d'), {
        type: 'bar',
        data: {
            labels: programLabels,
            datasets: [{
                label: 'Number of Students',
                data: programValues,
                backgroundColor: [
                    '#4e73df', '#1cc88a', '#36b9cc',
                    '#f6c23e', '#e74a3b', '#858796'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { stepSize: 1 }
                }
            }
        }
    });

    // Donut Chart - Program Distribution %
    new Chart(document.getElementById('programPieChart').getContext('2d'), {
        type: 'doughnut',
        data: {
            labels: programLabels,
            datasets: [{
                label: 'Students %',
                data: programPercentages,
                backgroundColor: [
                    '#4e73df', '#1cc88a', '#36b9cc',
                    '#f6c23e', '#e74a3b', '#858796'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'bottom' },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return `${context.label}: ${context.raw}%`;
                        }
                    }
                }
            }
        }
    });
</script>
@endpush
