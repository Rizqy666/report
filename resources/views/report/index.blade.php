@extends('layouts.master')
@section('title', 'DAILY PLANT PARAMETER TRENDING')

@section('breadcrumb')
    <li class="breadcrumb-item active">DAILY PLANT PARAMETER TRENDING</li>
@endsection
@push('css')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush
@section('content')
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: "{!! session('success') !!}"
            });
        </script>
    @endif
    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "{!! session('error') !!}"
            });
        </script>
    @endif

    <div class="row">
        <div class="col-6">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Report Input Form</h3>
                </div>
                <form action="{{ route('reports.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <!-- Tampilkan Tanggal Hari Ini -->
                        <div class="form-group">
                            <h4 class="form-text">{{ \Carbon\Carbon::now()->format('d-m-Y') }}</h4>
                            <input type="hidden" name="report_date" value="{{ \Carbon\Carbon::now()->toDateString() }}">
                        </div>

                        @foreach ($wells as $well)
                            <div class="well-section mb-4">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h4 class="mb-0">DESCRIPTION: {{ $well->name }}</h4>

                                </div>

                                @foreach ($well->readings as $reading)
                                    <div class="form-group row">
                                        <!-- Kolom untuk Description -->
                                        <div class="col-md-3">
                                            <span class="form-text">{{ $reading->description }}</span>
                                        </div>
                                        <!-- Kolom untuk Tag -->
                                        <div class="col-md-2">
                                            <label for="value_{{ $reading->id }}"
                                                class="col-form-label">{{ $reading->tag }}</label>
                                        </div>
                                        <!-- Kolom untuk Unit -->
                                        <div class="col-md-2">
                                            <label for="value_{{ $reading->id }}" class="col-form-label">Satuan:
                                                {{ $reading->unit }}</label>
                                        </div>
                                        <!-- Kolom untuk Input Value -->
                                        <div class="col-md-5">
                                            <input type="hidden"
                                                name="data[{{ $well->id }}][{{ $reading->id }}][well_id]"
                                                value="{{ $well->id }}">
                                            <input type="hidden"
                                                name="data[{{ $well->id }}][{{ $reading->id }}][well_reading_id]"
                                                value="{{ $reading->id }}">
                                            <input type="number"
                                                name="data[{{ $well->id }}][{{ $reading->id }}][value]"
                                                id="value_{{ $reading->id }}" class="form-control" required step="0.01"
                                                placeholder="Enter value for {{ $reading->description }}">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">Submit</button>
                    </div>
                </form>



            </div>
        </div>
        <div class="col-6">
            <div class="card">
                <div class="card-header border-0">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title">DAILY PLANT PARAMETER TRENDING</h3>
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
@endsection
@push('javascript')
    <script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>

    <script>
        const ctx = document.getElementById('visitors-chart').getContext('2d');
        const visitorsChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($chartLabels),
                datasets: [{
                    label: 'Daily Report Value',
                    data: @json($chartValues),
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
    </script>
@endpush
