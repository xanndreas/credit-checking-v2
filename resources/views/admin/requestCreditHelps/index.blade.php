@extends('layouts/layoutMaster')

@section('title', 'Request Credit Help - Pages')

@section('vendor-style')
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/select2/select2.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/formvalidation/dist/css/formValidation.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/select2/select2.css')}}"/>
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
@endsection

@section('page-script')
    <script src="{{asset('assets/js/admin/request-credit-help.js')}}"></script>
    <script src="{{asset('assets/js/forms-selects.js')}}"></script>
@endsection

@section('content')
    <!-- Request Credit Help List Table -->
    <div class="card">
        <div class="card-header border-bottom">
            <h5 class="card-title mb-3">Request Credit Help</h5>
        </div>
        <div class="card-datatable table-responsive">
            <table class="table border-top table-hover datatable-RequestCreditHelp">
                <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.requestCreditHelp.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.requestCreditHelp.fields.type') }}
                    </th>
                    <th>
                        {{ trans('cruds.requestCreditHelp.fields.attribute') }}
                    </th>
                    <th>
                        {{ trans('cruds.requestCreditHelp.fields.attribute_2') }}
                    </th>
                    <th>
                        {{ trans('cruds.requestCreditHelp.fields.attribute_3') }}
                    </th>
                    <th class="w-px-18">
                        {{ trans('global.actions') }}
                    </th>
                </tr>
                <tr>
                    <td>
                    </td>
                    <td>
                        <select class="search form-control" strict="true">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach(App\Models\RequestCreditHelp::TYPE_SELECT as $key => $item)
                                <option value="{{ $key }}">{{ $item }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input class="search form-control" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search form-control" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search form-control" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                </tr>
                </thead>
            </table>
        </div>
        @include('admin/requestCreditHelps/form')
    </div>
@endsection

