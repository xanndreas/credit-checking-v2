@extends('layouts/layoutMaster')

@section('title', 'Credit Check List - Pages')

@section('vendor-style')
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/select2/select2.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/formvalidation/dist/css/formValidation.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/select2/select2.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/flatpickr/flatpickr.css')}}" />
@endsection

@section('vendor-script')
    <script src="{{asset('assets/vendor/libs/moment/moment.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/select2/select2.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/cleavejs/cleave.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/cleavejs/cleave-phone.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/select2/select2.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/flatpickr/flatpickr.js')}}"></script
@endsection

@section('page-script')
    <script src="{{asset('assets/js/admin/request-credit.js')}}"></script>
    <script src="{{asset('assets/js/forms-selects.js')}}"></script>
@endsection


@section('content')

    <!-- requestCredits List Table -->
    <div class="card">
        <div class="card-header border-bottom">
            <h5 class="card-title mb-3">Filter</h5>
            <div class="d-flex justify-content-between align-items-center row pb-2 gap-3 gap-md-0">
                <div class="col-md-10">
                    <input type="text" class="form-control created-range" placeholder="Select here to Filter Date"/>
                </div>
                <div class="col-md-2">
                    <form action="{{ route('admin.request-credits.download') }}" method="post">
                        @csrf
                        <input type="hidden" name="minDate" class="min-date" value="">
                        <input type="hidden" name="maxDate" class="max-date" value="">

                        <button type="submit" class="btn btn-primary w-100">Export</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="card-header border-bottom">
            <h5 class="card-title mb-3">Credit Checks</h5>
        </div>
        <div class="card-datatable table-responsive">
            <table class="table border-top table-hover datatable-requestCredit">
                <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.requestCredit.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.requestCredit.fields.dealer_name') }}
                    </th>
                    <th>
                        {{ trans('cruds.requestCredit.fields.request_debtor') }}
                    </th>
                    <th>
                        {{ trans('cruds.requestCredit.fields.sales_name') }}
                    </th>
                    <th>
                        {{ trans('cruds.requestCredit.fields.product_name') }}
                    </th>
                    <th>
                        {{ trans('cruds.requestCredit.fields.workflow_process') }}
                    </th>
                    <th>
                        {{ trans('cruds.requestCredit.fields.remarks') }}
                    </th>
                    <th class="w-px-28">
                        Approval
                    </th>
                    <th class="w-px-18">
                        {{ trans('global.actions') }}
                    </th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
    @include('admin.requestCredits._partials.reason')
    @include('admin.requestCredits._partials.reasonApprove')
@endsection

