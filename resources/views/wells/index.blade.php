@extends('layouts.master')
@section('title', 'Wells')

@section('breadcrumb')
    <li class="breadcrumb-item active">Wells</li>
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



    <div class="row">
        <div class="col-6">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Wells</h3>
                </div>
                <form class="form-horizontal" action="{{ route('wells.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label">Wells</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Tambahkan description" required>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">Simpan</button>
                        <button type="submit" class="btn btn-default float-right">Cancel</button>
                    </div>
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
                                    <th>Wells</th>
                                    <th width="5%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($wells as $index => $well)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $well->name }}</td>
                                        <td>
                                            <div class="btn-group d-flex gap-2" role="group" aria-label="Action Buttons">
                                                <a href="{{ route('wells.edit', $well->id) }}"
                                                    class="btn btn-warning btn-sm" id="editBtn">Edit</a>
                                                <form action="{{ route('wells.destroy', $well->id) }}" method="POST">
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
                                    <th>Wells</th>
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
