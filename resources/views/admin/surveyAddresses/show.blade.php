@extends('layouts/layoutMaster')

@section('title', 'Detail Addresses - Page')

@section('vendor-script')
    <script src="{{asset('assets/vendor/libs/jquery-repeater/jquery-repeater.js')}}"></script>

    @can('actor_surveyor_admin_access')
        <link rel="stylesheet" href="{{asset('assets/vendor/libs/select2/select2.css')}}"/>
    @endcan
@endsection

@section('page-script')
    @can('actor_surveyor_admin_access')
        <script src="{{asset('assets/vendor/libs/select2/select2.js')}}"></script>
    @endcan

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
                        <input id="credit_type" type="hidden" value="{{ $requestCredit->credit_type }}">

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
                            <th class="w-25 fw-bold" colspan="6">
                                Detail Address
                            </th>
                        </tr>

                        @if($surveyAddresses->count() > 0)
                            <tr>
                                <th>
                                    {{ trans('cruds.surveyAddress.fields.request_credit') }}
                                </th>
                                <th>
                                    {{ trans('cruds.surveyAddress.fields.address_type') }}
                                </th>
                                <th>
                                    {{ trans('cruds.surveyAddress.fields.addresses') }}
                                </th>
                                <th>
                                    {{ trans('cruds.surveyAddress.fields.surveyor') }}
                                </th>
                                <th>
                                    Remarks
                                </th>
                                <th class="w-px-14">
                                    Assign Surveyor
                                </th>
                            </tr>

                            @foreach($surveyAddresses as $address)
                                <tr>
                                    <td>
                                        {{ $address->request_credit->batch_number }}
                                    </td>
                                    <td>
                                        {{ $address->address_type }}
                                    </td>
                                    <td>
                                        {{ $address->addresses }}
                                    </td>
                                    <td>
                                        {{ $address->surveyor ? $address->surveyor->name : '' }}
                                    </td>
                                    <td>
                                        {{ $address->remarks }}
                                    </td>
                                    <td>
                                        @can('actor_surveyor_admin_access')
                                            <button href="javascript:void(0);"
                                                    class="btn {{ $address->surveyor ? 'btn-success' : 'btn-warning' }} btn-assign"
                                                    data-request-credit-id="{{ $address->request_credit_id }}"
                                                    data-survey-addresses-id="{{ $address->id }}"
                                                    data-bs-toggle="modal" data-bs-target="#assignModal"
                                                > {{ $address->surveyor ? 'Re Assign' : 'Assign' }}</button>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <th colspan="2">
                                    No content
                                </th>
                            </tr>
                        @endif
                        </tbody>
                    </table>

                    <div class="row">
                        <div class="col-12">
                            <form method="POST" action="{{ route('admin.survey-addresses.store') }}"
                                  enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="request_credit_id" value="{{ $requestCredit->id }}">
                                <div class="survey_address-repeater form-repeater-container mb-3">
                                    @can('actor_auto_planner_access')
                                        @if ($workflowRequestCredit->process_status->process_status !== 'survey_assign')
                                            <div data-repeater-list="survey_address">
                                                <div data-repeater-item>
                                                    <div class="row">
                                                        <div class="mb-3 col-10 mb-0">
                                                            <label class="required"
                                                                   for="address_type">{{ trans('cruds.surveyAddress.fields.address_type') }}</label>
                                                            <select
                                                                class="form-control {{ $errors->has('address_type') ? 'is-invalid' : '' }}"
                                                                name="address_type" id="address_type" required>
                                                                @foreach($surveyAddressesSelect as $id => $label)
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
                                        @endif
                                    @endcan

                                    <div class="mb-0">
                                        @can('actor_auto_planner_access')
                                            @if ($workflowRequestCredit->process_status->process_status !== 'survey_assign')
                                                <a class="btn btn-primary waves-effect text-white" data-repeater-create>
                                                    <i class="ti ti-plus me-1"></i>
                                                    <span class="align-middle">Add</span>
                                                </a>

                                                <button type="submit"
                                                        class="btn btn-outline-primary waves-effect text-primary me-sm-3 me-1 ">
                                                    {{ trans('global.save') }}
                                                </button>
                                            @endif
                                        @endcan

                                        <div class="mb-0 float-end">
                                            <a class="btn btn-primary"
                                               href="{{ route('admin.survey-addresses.index') }}">
                                                Back
                                            </a>

                                            @can('actor_surveyor_admin_access')
                                                @if ($workflowRequestCredit->process_status->process_status == 'survey_assign')
                                                    <a href="javascript:void(0);"
                                                       onclick="document.getElementById('form-process-survey').submit();"
                                                       class="btn btn-outline-danger waves-effect text-danger">
                                                        Process Survey
                                                    </a>
                                                @endif
                                            @endcan
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <form id="form-process-survey"
                                  action="{{ route('admin.survey-addresses.processSurvey', ['requestCredit'  =>  $requestCredit->id]) }}"
                                  method="post"
                                  onsubmit="return confirm('Are you sure you want to process survey?')">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('admin.surveyAddresses._partials.assign')
@endsection
