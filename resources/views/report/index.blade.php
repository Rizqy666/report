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


    <div class="container">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Report Input Form</h3>
            </div>
            <form action="{{ route('reports.store') }}" method="POST">
                @csrf
                <div class="card-body">
                    <!-- Tampilkan Tanggal Hari Ini -->
                    <div class="form-group mb-3">
                        {{-- <h4>Tanggal: {{ \Carbon\Carbon::now()->format('d-m-Y') }}</h4> --}}
                        {{-- <input type="hidden" name="report_date" value="{{ \Carbon\Carbon::now()->toDateString() }}"> --}}
                        <div class="row">
                            <div class="col-4">
                                <label for="report_date" class="form-label">Tanggal Laporan</label>
                                <input type="date" name="report_date" class="form-control" required>


                            </div>
                        </div>
                    </div>

                    <!-- Tabel untuk Input -->
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 8%;">Well Name</th>
                                <th class="text-center" style="width: 22%;">Description</th>
                                <th class="text-center" style="width: 15%;">Tag</th>
                                <th class="text-center" style="width: 10%;">Unit</th>
                                <th class="text-center" style="width: 15%;">Value</th>
                            </tr>
                        </thead>

                        <tbody>
                            @if ($wells->isEmpty())
                                <!-- Jika Tidak Ada Data Wells -->
                                <tr>
                                    <td colspan="5" class="text-center">Belum memiliki data</td>
                                </tr>
                            @else
                                @foreach ($wells as $well)
                                    <!-- Hitung jumlah baris untuk rowspan -->
                                    @php
                                        $rowCount = $well->readings->count();
                                    @endphp

                                    @if ($rowCount === 0)
                                        <!-- Jika Well Tidak Memiliki Readings -->
                                        <tr>
                                            <td colspan="5" class="text-center">"{{ $well->name }}" belum memiliki data
                                                readings</td>
                                        </tr>
                                    @else
                                        @foreach ($well->readings as $index => $reading)
                                            <tr>
                                                <!-- Nama Well -->
                                                @if ($index === 0)
                                                    <td rowspan="{{ $rowCount }}">{{ $well->name }}</td>
                                                @endif

                                                <!-- Description -->
                                                <td>{{ $reading->description ?? '-' }}</td>

                                                <!-- Tag -->
                                                <td>{{ $reading->tag ?? '-' }}</td>

                                                <!-- Unit -->
                                                <td>{{ $reading->unit ?? '-' }}</td>

                                                <!-- Input Value -->
                                                <td>
                                                    <input type="hidden"
                                                        name="data[{{ $well->id }}][{{ $reading->id }}][well_id]"
                                                        value="{{ $well->id }}">
                                                    <input type="hidden"
                                                        name="data[{{ $well->id }}][{{ $reading->id }}][well_reading_id]"
                                                        value="{{ $reading->id }}">
                                                    <input type="number"
                                                        name="data[{{ $well->id }}][{{ $reading->id }}][value]"
                                                        id="value_{{ $reading->id }}" class="form-control" required
                                                        step="0.01" placeholder="Value"
                                                        style="width: 100%; padding-left: 8px;">


                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>


                <div class="card-footer">
                    <button type="submit" class="btn btn-info">Submit</button>
                </div>
            </form>
        </div>
    </div>


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
    </script>
@endpush
