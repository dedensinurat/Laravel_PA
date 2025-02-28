@extends('staf_layouts.app')
@section('title', 'Dashboard Staf')

@section('contents')

    <!-- Include necessary scripts for charts (e.g., Chart.js) -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <canvas id="attendanceChart"></canvas>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('attendanceChart').getContext('2d');
            const attendanceData = {
                labels: @json($dates),
                datasets: [{
                    label: 'Hadir',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    data: @json($hadirCounts),
                }, {
                    label: 'Sakit',
                    backgroundColor: 'rgba(255, 206, 86, 0.2)',
                    borderColor: 'rgba(255, 206, 86, 1)',
                    data: @json($sakitCounts),
                }, {
                    label: 'Izin',
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    data: @json($izinCounts),
                }, {
                    label: 'Alpa',
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    data: @json($alpaCounts),
                }]
            };

            const attendanceChart = new Chart(ctx, {
                type: 'line',
                data: attendanceData,
                options: {
                    responsive: true,
                    scales: {
                        x: {
                            display: true,
                            title: {
                                display: true,
                                text: 'Tanggal'
                            }
                        },
                        y: {
                            display: true,
                            title: {
                                display: true,
                                text: 'Jumlah Siswa'
                            }
                        }
                    }
                }
            });
        });
    </script>
@endsection
