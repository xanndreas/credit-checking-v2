@extends('layouts/layoutMaster')

@section('title', 'Team Detail')


@section('vendor-style')
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css')}}">
@endsection

@section('vendor-script')
    <script src="{{asset('assets/vendor/libs/moment/moment.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js')}}"></script>
@endsection

@section('page-style')
    <link rel="stylesheet" href="{{asset('assets/css/tree-table.css')}}">
@endsection

@section('page-script')
    <script src="{{asset('assets/js/admin/user-trees.js')}}"></script>
    <script src="{{asset('assets/js/admin/tree-tables.js')}}"></script>
@endsection

@section('content')
    <div class="card">
        <div class="card-header border-bottom">
            <h5 class="card-title mb-1">Tenants</h5>
        </div>
        <div class="card-datatable table-responsive">
            <table class="table border-top table-hover datatable-UserTree">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Email Verified At</th>
                    <th>Status</th>
                    <th>Roles</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
    <!-- Row grouping -->
@endsection
