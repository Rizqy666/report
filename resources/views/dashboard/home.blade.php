@extends('layouts.master')
@section('title', 'Home')

@section('breadcrumb')
    <li class="breadcrumb-item active">Pace</li>
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">@yield('title')</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            You can Change Pace Styles, Checkout the <a href="https://adminlte.io/docs/3.1/" target="_blank"
                rel="noopener noreferrer">AdminLTE Official Docs</a> in Online.
            <br>
            Start creating your amazing application!
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            Footer
        </div>
        <!-- /.card-footer-->
    </div>
@endsection
