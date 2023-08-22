@extends('layouts/layoutMaster')

@section('title', 'Detail Addresses - Page')


@section('vendor-style')
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/select2/select2.css')}}"/>
@endsection

@section('vendor-script')
    <script src="{{asset('assets/vendor/libs/jquery-repeater/jquery-repeater.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/select2/select2.js')}}"></script>
@endsection

@section('page-script')
    <script src="{{asset('assets/js/forms-selects.js')}}"></script>
    <script src="{{asset('assets/js/admin/survey-addresses-detail.js')}}"></script>
@endsection


@section('content')
    <div class="row">
        <div class="col-12 mb-md-0 mb-4">
            <div class="card">
                <div class="card-header">
                    <h5> {{ trans('cruds.surveyAddress.title') }}</h5>
                </div>

                <div class="card-body">
                    <table class="table table-responsive table-striped mb-3">
                        <tbody>
                        <tr class="table-primary">
                            <th class="w-25 fw-bold" colspan="2">
                                Auto Planner Information
                            </th>
                        </tr>

                        <tr>
                            <th class="w-25">
                                {{ trans('cruds.requestCredit.fields.auto_planner') }}
                            </th>
                            <td>
                                {{ $requestCredit->auto_planner->name ?? '' }}
                            </td>
                        <tr>
                            <th class="w-25">
                                Request Credit Detail
                            </th>
                            <td>
                                <a href="{{ route('admin.request-credits.show', ['request_credit' => $requestCredit->id]) }}">
                                    {{ route('admin.request-credits.show', ['request_credit' => $requestCredit->id]) }}
                                </a>
                            </td>
                        </tr>


                        </tbody>
                    </table>
                    <table class="table table-responsive table-striped mb-3">
                        <tbody>
                        <tr class="table-primary">
                            <th class="w-25 fw-bold" colspan="2">
                                Debtor Information
                            </th>
                        </tr>

                        @foreach($requestCredit->request_debtors as $debtors)
                            <tr>
                                <th class="w-25">
                                    {{ \App\Models\RequestCreditDebtor::PERSONEL_TYPE_SELECT[$debtors->personel_type] }}
                                    {{ trans('cruds.requestCreditDebtor.fields.name') }}
                                </th>
                                <td>
                                    {{ $debtors->name }}
                                </td>
                            </tr>
                            <tr>
                                <th class="w-25">
                                    {{ \App\Models\RequestCreditDebtor::PERSONEL_TYPE_SELECT[$debtors->personel_type] }}
                                    {{ trans('cruds.requestCreditDebtor.fields.identity_type') }}
                                </th>
                                <td>
                                    {{ $debtors->identity_type }}
                                </td>
                            </tr>
                            <tr>
                                <th class="w-25">
                                    {{ \App\Models\RequestCreditDebtor::PERSONEL_TYPE_SELECT[$debtors->personel_type] }}
                                    {{ trans('cruds.requestCreditDebtor.fields.identity_type') }}
                                </th>
                                <td>
                                    {{ $debtors->identity_type }}
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>

                    <table class="table table-responsive table-striped mb-3">
                        <tbody>
                        <tr class="table-primary">
                            <th class="w-25 fw-bold" colspan="2">
                                Detail Address
                            </th>
                        </tr>
                        </tbody>
                    </table>

                    <div class="row">
                        <div class="col-12">

                            <form method="POST" action="" enctype="multipart/form-data">
                                @method('put')
                                @csrf

                                <div class="survey_address-repeater form-repeater-container mb-3">
                                    <div data-repeater-list="survey_address">
                                        <div data-repeater-item>
                                            <div class="row">
                                                <div class="mb-3 col-10 mb-0">
                                                    <label class="required"
                                                           for="address_type">{{ trans('cruds.surveyAddress.fields.address_type') }}</label>
                                                    <select
                                                        class="form-control select2 {{ $errors->has('address_type') ? 'is-invalid' : '' }}"
                                                        name="address_type" id="address_type" required>
                                                        @foreach(\App\Models\SurveyAddress::ADDRESS_TYPE_SELECT as $id => $label)
                                                            <option
                                                                value="{{ $id }}" {{ $id == old('address_type', '') ? 'selected' : '' }}>{{ $label }}</option>
                                                        @endforeach
                                                    </select>
                                                    @if($errors->has('address_type'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('address_type') }}
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="mb-3 col-2 d-flex align-items-center mb-0">
                                                    <a class="w-100 btn btn-label-danger text-danger mt-4"
                                                       data-repeater-delete>
                                                        <i class="ti ti-x ti-xs me-1"></i>
                                                        <span class="align-middle">Delete</span>
                                                    </a>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="mb-3 col-12 mb-0">
                                                    <label class="required"
                                                           for="addresses">{{ trans('cruds.surveyAddress.fields.addresses') }}</label>
                                                    <textarea
                                                        class="form-control {{ $errors->has('addresses') ? 'is-invalid' : '' }}"
                                                        type="text" name="addresses" id="addresses"
                                                        required>{{ old('addresses', '') }}</textarea>
                                                    @if($errors->has('addresses'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('addresses') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>

                                        </div>
                                    </div>


                                    <div class="mb-0">
                                        <a class="btn btn-primary waves-effect text-white" data-repeater-create>
                                            <i class="ti ti-plus me-1"></i>
                                            <span class="align-middle">Add</span>
                                        </a>

                                        <button type="submit" class="btn btn-outline-primary waves-effect text-primary me-sm-3 me-1 ">
                                            {{ trans('global.save') }}
                                        </button>

                                        <a class="btn btn-primary float-end" href="{{ route('admin.survey-addresses.index') }}">
                                            Back
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
