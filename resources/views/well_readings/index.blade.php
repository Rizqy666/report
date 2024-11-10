@extends('layouts.master')
@section('title', 'well_readings')

@section('breadcrumb')
    <li class="breadcrumb-item active">well_readings</li>
@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
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
                    <h3 class="card-title">Wells</h3>
                </div>
                <form action="{{ route('readings.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="well_id">Select Well</label>
                        <select name="well_id" id="well_id" class="form-control" required>
                            <option value="">Select Well</option>
                            @foreach ($wells as $well)
                                <option value="{{ $well->id }}">{{ $well->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="tag">Tag (Parameter)</label>
                        <input type="text" name="tag" id="tag" class="form-control" required>
                    </div>


                    <div class="form-group">
                        <label for="start_date">Start Date</label>
                        <input type="date" name="start_date" id="start_date" class="form-control"
                            value="{{ now()->format('Y-m-d') }}" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Add Well Reading</button>
                </form>

            </div>
        </div>
        <div class="col-6">
            <div class="container-fluid">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Daftar Wells Description</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th>Decription Wills</th>
                                    <th>Tag</th>
                                    <th>Tanggal</th>
                                    <th width="5%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($wellReadings as $index => $well)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $well->well->name }}</td>
                                        <td>{{ $well->tag }}</td>
                                        <td>{{ $well->start_date }}</td>
                                        <td>
                                            <div class="btn-group d-flex gap-2" role="group" aria-label="Action Buttons">
                                                <a href="{{ route('readings.edit', $well->id) }}"
                                                    class="btn btn-warning btn-sm" id="editBtn">Edit</a>
                                                <form action="{{ route('readings.destroy', $well->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="btn btn-danger btn-sm delete-btn">Delete</button>
                                                </form>

                                            </div>


                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Decription Wills</th>
                                    <th>Tag</th>
                                    <th>Tanggal</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
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
        // update form
        $(document).ready(function() {
            // Menangani aksi klik tombol Edit
            $('#editBtn').click(function(e) {
                e.preventDefault(); // Mencegah link default behavior

                var editUrl = $(this).attr('href'); // Ambil URL edit dari atribut href

                Swal.fire({
                    title: 'Are you sure?',
                    text: "Do you want to update this record?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, update it!',
                    cancelButtonText: 'No, cancel!',
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Jika dikonfirmasi, arahkan ke halaman edit
                        window.location.href = editUrl;
                    }
                });
            });
        });
        // delete form
        $('.delete-btn').on('click', function(e) {
            e.preventDefault();

            var form = $(this).closest('form');

            Swal.fire({
                title: 'Are you sure?',
                text: "Do you want to delete this record?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    </script>
@endpush
