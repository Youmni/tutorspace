@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Home</h1>
    <div class="flex justify-end mb-4">
        <a href="{{ route('admin.news_items.index') }}" class="underline text-blue-500 hover:text-blue-700 cursor-pointer">Create Announcement</a>
    </div>
    <div class="grid grid-cols-3 gap-4 mb-8">
        <div class="p-4 bg-blue-100 shadow rounded">
            <h2 class="text-xl font-semibold mb-2"><i class="fas fa-users"></i> Users</h2>
            <p class="text-gray-700">Total: <span class="font-bold">{{ $statistics['totalUsers'] }}</span></p>
        </div>
        <div class="p-4 bg-green-100 shadow rounded">
            <h2 class="text-xl font-semibold mb-2"><i class="fas fa-university"></i> Institutions</h2>
            <p class="text-gray-700">Total: <span class="font-bold">{{ $statistics['totalInstitutions'] }}</span></p>
        </div>
        <div class="p-4 bg-yellow-100 shadow rounded">
            <h2 class="text-xl font-semibold mb-2"><i class="fas fa-book"></i> Courses</h2>
            <p class="text-gray-700">Total: <span class="font-bold">{{ $statistics['totalCourses'] }}</span></p>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div class="mt-8">
            <canvas id="userRoleChart" style="max-width: 400px; max-height: 400px;"></canvas>
        </div>
        <div class="mt-8">
            <canvas id="newStatisticsChart" style="max-width: 400px; max-height: 400px;"></canvas>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var ctx = document.getElementById('userRoleChart').getContext('2d');
            var userRoleChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: ['Admins', 'Tutors', 'Clients'],
                    datasets: [{
                        label: 'User Roles',
                        data: @json($userRoleCounts),
                        backgroundColor: [
                            'rgba(46, 145, 198, 0.94)',
                            'rgba(25, 174, 112, 0.74)',
                            'rgba(161, 69, 215, 0.85)',
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(255, 99, 132, 0.2)',
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        tooltip: {
                            callbacks: {
                                label: function (context) {
                                    var label = context.label || '';
                                    if (label) {
                                        label += ': ';
                                    }
                                    if (context.parsed !== null) {
                                        label += context.parsed;
                                    }
                                    return label;
                                }
                            }
                        }
                    }
                }
            });

            var newStatisticsCtx = document.getElementById('newStatisticsChart').getContext('2d');
            var newStatisticsChart = new Chart(newStatisticsCtx, {
                type: 'bar',
                data: {
                    labels: ['New Users', 'New Courses', 'New Institutions'],
                    datasets: [{
                        label: 'Last month',
                        data: @json(array_values($newStatistics)),
                        backgroundColor: [
                            'rgba(42, 217, 162, 0.81)',
                            'rgba(171, 44, 72, 0.77)',
                            'rgba(118, 82, 217, 0.8)',
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(255, 99, 132, 0.2)',
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        tooltip: {
                            callbacks: {
                                label: function (context) {
                                    var label = context.label || '';
                                    if (label) {
                                        label += ': ';
                                    }
                                    if (context.raw !== null) {
                                        label += context.raw;
                                    }
                                    return label;
                                }
                            }
                        }
                    },
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