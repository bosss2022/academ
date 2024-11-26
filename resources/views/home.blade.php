@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Welcome Section -->
    <div class="row justify-content-center mb-4">
        <div class="col-md-10">
            <div>
                <div class=" text-black text-center mb-6">
                    <h3 class="mb-0">Welcome to Acadx, {{ Auth::user()->name }}!</h3>
                </div>
            </div>
        </div>
    </div>
<!-- dashboard cards -->
<div class="row g-4 ml-2">
    <!-- Total Users -->
    <div class="col-md-3">
        <div class="card shadow-lg bg-primary text-white hover-card card-users">
        <div class="icon-container">
            <i class="fas fa-users"></i>
        </div>
            <div class="card-body text-center">
                <h2 class="display-4">{{ $totalUsers }}</h2>
                <h4 class="lead">Users</h4>
            </div>
            <div class="border-top">
                <a href="{{ route('students.index') }}" class="text-decoration-none text-white p-3 d-block text-center">
                    Manage Users <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Total Students -->
    <div class="col-md-3">
        <div class="card shadow-lg bg-success text-white hover-card card-students">
        <div class="icon-container">
            <i class="fas fa-user-graduate"></i>
        </div>
            <div class="card-body text-center">
                <h2 class="display-4">{{ $totalStudents }}</h2>
                <h4 class="lead">Students</h4>
            </div>
            <div class="border-top">
                <a href="{{ route('students.index') }}" class="text-decoration-none text-white p-3 d-block text-center">
                    View Students <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Total Departments -->
    <div class="col-md-3">
        <div class="card shadow-lg bg-warning text-white hover-card card-departments">
        <div class="icon-container">
            <i class="fas fa-laptop-house"></i>
        </div>
            <div class="card-body text-center">
                <h2 class="display-4">{{ $totalDepartments }}</h2>
                <h4 class="lead">Departments</h4>
            </div>
            <div class="border-top">
                <a href="{{ route('departments.index') }}" class="text-decoration-none text-white p-3 d-block text-center">
                    View Departments <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Total Employees -->
    <div class="col-md-3">
        <div class="card shadow-lg bg-info text-white hover-card card-employees">
        <div class="icon-container">
            <i class="fas fa-chalkboard-teacher"></i>
        </div>
            <div class="card-body text-center">
                <h2 class="display-4">{{ $totalEmployees }}</h2>
                <h4 class="lead">Employees</h4>
            </div>
            <div class="border-top">
                <a href="{{ route('employees.index') }}" class="text-decoration-none text-white p-3 d-block text-center">
                    View Employees <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
</div>


    <!-- Dashboard Charts -->
    <div class="row g-3 mt-4">
        <!-- Total Employees by Department -->
        <div class="col-md-4">
            <div class="card shadow-lg">
                <div class="card-header bg-danger text-white text-center">
                    <h4>Total Employees by Department</h4>
                </div>
                <div class="card-body">
                    <canvas id="employeesByDepartmentChart" width="400" height="390"></canvas>
                </div>
            </div>
        </div>

        <!-- Paid vs Unpaid -->
        <div class="col-md-4">
            <div class="card shadow-lg">
                <div class="card-header bg-warning text-dark text-center">
                    <h4>Paid vs Unpaid</h4>
                </div>
                <div class="card-body">
                    <canvas id="financesChart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>

        <!-- Lecturers vs Students -->
        <div class="col-md-4">
            <div class="card shadow-lg">
                <div class="card-header bg-danger text-white text-center">
                    <h4>Lecturers vs Students</h4>
                </div>
                <div class="card-body">
                    <canvas id="lecturersVsStudentsChart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js Scripts -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Paid vs Unpaid Chart
    new Chart(document.getElementById('financesChart').getContext('2d'), {
        type: 'pie',
        data: {
            labels: ['Paid', 'Unpaid'],
            datasets: [{
                data: [{{ $totalPaid }}, {{ $totalBalance }}],
                backgroundColor: ['#36a2eb', '#ff6384'],
                borderColor: ['#36a2eb', '#ff6384'],
                borderWidth: 1
            }]
        },
        options: { responsive: true, plugins: { legend: { position: 'top' } } }
    });

    // Lecturers vs Students Chart
    new Chart(document.getElementById('lecturersVsStudentsChart').getContext('2d'), {
        type: 'pie',
        data: {
            labels: ['Lecturers', 'Students'],
            datasets: [{
                data: [{{ $totalLecturers }}, {{ $totalStudents }}],
                backgroundColor: ['#36a2eb', '#ff6384'],
                borderColor: ['#36a2eb', '#ff6384'],
                borderWidth: 1
            }]
        },
        options: { responsive: true, plugins: { legend: { position: 'top' } } }
    });

    // Employees by Department Chart
    const ctx = document.getElementById('employeesByDepartmentChart').getContext('2d');
    const employeesByDepartmentChart = new Chart(ctx, {
        type: 'bar', // Bar chart type
        data: {
            labels: {!! json_encode($departments) !!}, // Department names from the controller
            datasets: [{
                label: 'Total Employees',
                data: {!! json_encode($totals) !!}, // Employee counts from the controller
                backgroundColor: [
                    'rgba(54, 162, 235, 0.6)',
                    'rgba(75, 192, 192, 0.6)',
                    'rgba(255, 206, 86, 0.6)',
                    'rgba(153, 102, 255, 0.6)',
                    'rgba(255, 99, 132, 0.6)'
                ],
                borderColor: [
                    'rgba(54, 162, 235, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 99, 132, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: true,
                    position: 'top',
                },
                tooltip: {
                    enabled: true,
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Total Employees'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Departments'
                    }
                }
            }
        }
    });

</script>

<style>

.list-group-item {
    border: none;
    border-bottom: 1px solid #ddd;
    padding: 10px;
}

.card {
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease-in-out;
    position: relative; /* For the background image */
    overflow: hidden; /* Clip background images */
}

.hover-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
}

.card-body {
    padding: 1rem;
    background-color: rgba(0, 0, 0, 0.05);
}

.display-4 {
    font-size: 3rem;
    font-weight: bold;
    letter-spacing: 2px;
    font-family: Verdana;
}

.card .border-top a {
    background-color: rgba(0, 0, 0, 0.1);
    transition: background-color 0.3s ease;
}

.card .border-top a:hover {
    background-color: rgba(0, 0, 0, 0.2);
}
.icon-container {
    position: absolute;
    top: 2px;
    right: 2px;
    font-size: 5rem;
    color: rgba(0, 0, 0, 0.1); /* Blended effect */
    opacity: 10;
}

/* Card Content Foreground */
.card-body {
    z-index: 2; /* Ensure card content is above the background */
}

.lead {
    font-size: 1.25rem;
    font-weight: bold;
    font-family: Verdana;
}

.bg-primary {
    background: linear-gradient(135deg, #0061ff, #4e94ff); /* Gradient blue */
}

.bg-success {
    background: linear-gradient(135deg, #28a745, #6dbf78); /* Gradient green */
}

.bg-warning {
    background: linear-gradient(135deg, #ffca28, #ff8f00); /* Gradient yellow */
}

.bg-info {
    background: linear-gradient(135deg, #17a2b8, #3ab7bb); /* Gradient cyan */
}

.text-white {
    color: white !important;
}


</style>
@endsection