@extends('layouts.master')
@section('title', 'Edit Readings Description')

@section('breadcrumb')
    <li class="breadcrumb-item active">Edit Readings Description</li>
@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endpush
@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif


    <div class="container-fluid">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Readings</h3>
            </div>
            <form action="{{ route('readings.update', $wellReading->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Wells</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Tambahkan description" value="{{ old('name', $well->name) }}" required
                                disabled>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="description" class="col-sm-2 col-form-label">Description</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="description" name="description"
                                placeholder="Tambahkan description"
                                value="{{ old('description', $wellReading->description) }}" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="tag" class="col-sm-2 col-form-label">Tag</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="tag" name="tag"
                                placeholder="Tambahkan tag" value="{{ old('tag', $wellReading->tag) }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="unit" class="col-sm-2 col-form-label">Unit</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="unit" name="unit"
                                placeholder="Tambahkan unit" value="{{ old('unit', $wellReading->unit) }}" required>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-info">Simpan</button>
                    <a href="{{ route('readings.index') }}" class="btn btn-default float-right">Cancel</a>
                </div>
            </form>



        </div>
    </div>
@endsection
@push('javascript')
    <script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "pageLength": 5,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
@endpush
