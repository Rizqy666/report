@extends('layouts.master')
@section('title', 'Home')

@section('breadcrumb')
    {{-- <li class="breadcrumb-item active">Home</li> --}}
@endsection
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="card-header border-0">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title">DAILY PLANT PARAMETER TRENDING</h3>
                        <div>
                            <form method="GET" id="filterForm">
                                <select class="form-control" id="filter-well" name="well_reading"
                                    onchange="document.getElementById('filterForm').submit()">
                                    <option value="">Semua Data</option>
                                    @foreach ($wellReadings as $well)
                                        @foreach ($well->wellReadings as $reading)
                                            <option value="{{ $reading->id }}"
                                                {{ $selectedWellReading == $reading->id ? 'selected' : '' }}>
                                                {{ $well->name }} - {{ $reading->description }}
                                            </option>
                                        @endforeach
                                    @endforeach
                                </select>
                            </form>

                        </div>
                    </div>
                </div>


                <div class="card-body">
                    <div class="position-relative mb-4">
                        <canvas id="visitors-chart" height="200"></canvas>
                    </div>

                    <div class="d-flex flex-row justify-content-end">
                        <span class="mr-2">
                            <i class="fas fa-square text-primary"></i> This Month
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('filter-input').addEventListener('input', function() {
            const filterValue = this.value.toLowerCase();
            document.querySelectorAll('.report-item').forEach(function(item) {
                const text = item.textContent.toLowerCase();
                item.style.display = text.includes(filterValue) ? '' : 'none';
            });
        });
    </script>
@endsection
@push('javascript')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('visitors-chart').getContext('2d');
        const visitorsChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($chartLabels), // Pastikan ini sudah benar
                datasets: [{
                    label: 'Daily Report Value',
                    data: @json($chartValues), // Pastikan ini sudah benar
                    borderColor: 'rgba(60,141,188,0.8)',
                    backgroundColor: 'rgba(60,141,188,0.4)',
                    fill: true,
                }]
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        type: 'category',
                        title: {
                            display: true,
                            text: 'Tanggal'
                        },
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Total Nilai'
                        },
                        beginAtZero: true,
                    }
                }
            }
        });


        function filterByWell(value) {
            window.location.href = `{{ route('home') }}?well=${value}`
        }
    </script>
@endpush
