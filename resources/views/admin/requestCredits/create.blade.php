@extends('layouts/layoutMaster')

@section('title', 'Credit Check')

@section('vendor-style')
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/bs-stepper/bs-stepper.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/bootstrap-select/bootstrap-select.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/select2/select2.css')}}"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet"/>
@endsection

@section('vendor-script')
    <script src="{{asset('assets/vendor/libs/bs-stepper/bs-stepper.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/bootstrap-select/bootstrap-select.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/select2/select2.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/jquery-repeater/jquery-repeater.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>

@endsection

@section('page-script')
    <script src="{{asset('assets/js/admin/request-credit-create.js')}}"></script>
    <script>
        let uploadedIdPhotosMap = {}
        let uploadedKkPhotosMap = {}
        let uploadedNpwpPhotosMap = {}
        let uploadedOtherPhotosMap = {}

        Dropzone.options.idPhotosDropzone = {
            url: '{{ route('admin.request-credits.storeMedia') }}',
            maxFilesize: 10, // MB
            acceptedFiles: '.jpeg,.jpg,.png,.gif',
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            params: {
                size: 10,
                width: 40960,
                height: 40960
            },
            success: function (file, response) {
                $('form').append('<input type="hidden" name="id_photos[]" value="' + response.name + '">')
                uploadedIdPhotosMap[file.name] = response.name
            },
            removedfile: function (file) {
                console.log(file)
                file.previewElement.remove()
                let name = ''
                if (typeof file.file_name !== 'undefined') {
                    name = file.file_name
                } else {
                    name = uploadedIdPhotosMap[file.name]
                }
                $('form').find('input[name="id_photos[]"][value="' + name + '"]').remove()
            },
            init: function () {
                @if(isset($requestCredit) && $requestCredit->id_photos)
                let files = {!! json_encode($requestCredit->id_photos) !!}

                for(let
                i in files
            )
                {
                    let file = files[i]
                    this.options.addedfile.call(this, file)
                    this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
                    file.previewElement.classList.add('dz-complete')
                    $('form').append('<input type="hidden" name="id_photos[]" value="' + file.file_name + '">')
                }

                @endif
            },
            error: function (file, response) {
                if ($.type(response) === 'string') {
                    let message = response //dropzone sends it's own error messages in string
                } else {
                    let message = response.errors.file
                }
                file.previewElement.classList.add('dz-error')
                _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
                _results = []
                for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                    node = _ref[_i]
                    _results.push(node.textContent = message)
                }

                return _results
            }
        }

        Dropzone.options.kkPhotosDropzone = {
            url: '{{ route('admin.request-credits.storeMedia') }}',
            maxFilesize: 10, // MB
            acceptedFiles: '.jpeg,.jpg,.png,.gif',
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            params: {
                size: 10,
                width: 40960,
                height: 40960
            },
            success: function (file, response) {
                $('form').append('<input type="hidden" name="kk_photos[]" value="' + response.name + '">')
                uploadedIdPhotosMap[file.name] = response.name
            },
            removedfile: function (file) {
                console.log(file)
                file.previewElement.remove()
                let name = ''
                if (typeof file.file_name !== 'undefined') {
                    name = file.file_name
                } else {
                    name = uploadedIdPhotosMap[file.name]
                }
                $('form').find('input[name="kk_photos[]"][value="' + name + '"]').remove()
            },
            init: function () {
                @if(isset($requestCredit) && $requestCredit->kk_photos)
                let files = {!! json_encode($requestCredit->kk_photos) !!}

                for(let
                i in files
            )
                {
                    let file = files[i]
                    this.options.addedfile.call(this, file)
                    this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
                    file.previewElement.classList.add('dz-complete')
                    $('form').append('<input type="hidden" name="kk_photos[]" value="' + file.file_name + '">')
                }

                @endif
            },
            error: function (file, response) {
                if ($.type(response) === 'string') {
                    let message = response //dropzone sends it's own error messages in string
                } else {
                    let message = response.errors.file
                }
                file.previewElement.classList.add('dz-error')
                _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
                _results = []
                for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                    node = _ref[_i]
                    _results.push(node.textContent = message)
                }

                return _results
            }
        }

        Dropzone.options.npwpPhotosDropzone = {
            url: '{{ route('admin.request-credits.storeMedia') }}',
            maxFilesize: 10, // MB
            acceptedFiles: '.jpeg,.jpg,.png,.gif',
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            params: {
                size: 10,
                width: 40960,
                height: 40960
            },
            success: function (file, response) {
                $('form').append('<input type="hidden" name="npwp_photos[]" value="' + response.name + '">')
                uploadedIdPhotosMap[file.name] = response.name
            },
            removedfile: function (file) {
                console.log(file)
                file.previewElement.remove()
                let name = ''
                if (typeof file.file_name !== 'undefined') {
                    name = file.file_name
                } else {
                    name = uploadedIdPhotosMap[file.name]
                }
                $('form').find('input[name="npwp_photos[]"][value="' + name + '"]').remove()
            },
            init: function () {
                @if(isset($requestCredit) && $requestCredit->npwp_photos)
                let files = {!! json_encode($requestCredit->npwp_photos) !!}

                for(let
                i in files
            )
                {
                    let file = files[i]
                    this.options.addedfile.call(this, file)
                    this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
                    file.previewElement.classList.add('dz-complete')
                    $('form').append('<input type="hidden" name="npwp_photos[]" value="' + file.file_name + '">')
                }

                @endif
            },
            error: function (file, response) {
                if ($.type(response) === 'string') {
                    let message = response //dropzone sends it's own error messages in string
                } else {
                    let message = response.errors.file
                }
                file.previewElement.classList.add('dz-error')
                _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
                _results = []
                for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                    node = _ref[_i]
                    _results.push(node.textContent = message)
                }

                return _results
            }
        }

        Dropzone.options.otherPhotosDropzone = {
            url: '{{ route('admin.request-credits.storeMedia') }}',
            maxFilesize: 10, // MB
            acceptedFiles: '.jpeg,.jpg,.png,.gif',
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            params: {
                size: 10,
                width: 40960,
                height: 40960
            },
            success: function (file, response) {
                $('form').append('<input type="hidden" name="other_photos[]" value="' + response.name + '">')
                uploadedIdPhotosMap[file.name] = response.name
            },
            removedfile: function (file) {
                console.log(file)
                file.previewElement.remove()
                let name = ''
                if (typeof file.file_name !== 'undefined') {
                    name = file.file_name
                } else {
                    name = uploadedIdPhotosMap[file.name]
                }
                $('form').find('input[name="other_photos[]"][value="' + name + '"]').remove()
            },
            init: function () {
                @if(isset($requestCredit) && $requestCredit->other_photos)
                let files = {!! json_encode($requestCredit->other_photos) !!}

                for(let
                i in files
            )
                {
                    let file = files[i]
                    this.options.addedfile.call(this, file)
                    this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
                    file.previewElement.classList.add('dz-complete')
                    $('form').append('<input type="hidden" name="other_photos[]" value="' + file.file_name + '">')
                }

                @endif
            },
            error: function (file, response) {
                if ($.type(response) === 'string') {
                    let message = response //dropzone sends it's own error messages in string
                } else {
                    let message = response.errors.file
                }
                file.previewElement.classList.add('dz-error')
                _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
                _results = []
                for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                    node = _ref[_i]
                    _results.push(node.textContent = message)
                }

                return _results
            }
        }
    </script>
@endsection

@section('content')

    <!-- Modern -->
    <div class="row">
        <div class="col-12">
            <h5>Credit Check</h5>
        </div>

        <!-- Modern Icons Wizard -->
        <div class="col-12 mb-4">
            <small class="text-light fw-semibold">Isi Form Dibawah ini</small>
            <div class="bs-stepper wizard-icons wizard-modern wizard-modern-icons mt-2">
                <div class="bs-stepper-header">
                    <div class="step" data-target="#basic-information">
                        <button type="button" class="step-trigger">
                            <span class="bs-stepper-icon">
                                <svg viewBox="0 0 54 54">
                                    <use
                                        xlink:href='{{asset('assets/svg/icons/form-wizard-account.svg#wizardAccount')}}'></use>
                                </svg>
                            </span>
                            <span class="bs-stepper-label">Informasi Dasar</span>
                        </button>
                    </div>
                    <div class="line">
                        <i class="ti ti-chevron-right"></i>
                    </div>
                    <div class="step" data-target="#debtor-candidate-info">
                        <button type="button" class="step-trigger">
                            <span class="bs-stepper-icon">
                                <svg viewBox="0 0 58 54">
                                    <use
                                        xlink:href='{{asset('assets/svg/icons/form-wizard-personal.svg#wizardPersonal')}}'></use>
                                </svg>
                            </span>
                            <span class="bs-stepper-label">Informasi Calon Debitur</span>
                        </button>
                    </div>
                    <div class="line">
                        <i class="ti ti-chevron-right"></i>
                    </div>
                    <div class="step" data-target="#loan-info">
                        <button type="button" class="step-trigger">
                            <span class="bs-stepper-icon">
                                 <svg viewBox="0 0 54 54">
                                    <use
                                        xlink:href='{{asset('assets/svg/icons/form-wizard-address.svg#wizardAddress')}}'></use>
                                 </svg>
                            </span>
                            <span class="bs-stepper-label">Informasi Pinjaman</span>
                        </button>
                    </div>
                </div>

                <div class="bs-stepper-content">
                    <!-- Account Details -->
                    <form enctype="multipart/form-data" id="basic-information-form"
                          action="{{ route('admin.request-credits.store') }}" method="post" novalidate>
                        @csrf
                        <div id="basic-information" class="content">
                            <div class="content-header mb-3">
                                <h6 class="mb-0">Informasi Dasar</h6>
                                <small>Form dengan tanda <span class="text-danger">*</span> Wajib Diisi</small>
                            </div>
                            <div class="row g-3">
                                <div class="col-sm-6">
                                    <label class="required"
                                           for="auto_planner_name_id">{{ trans('cruds.requestCredit.fields.auto_planner') }}</label>

                                    <input type="text" id="auto_planner_names" class="form-control"
                                           value="{{ auth()->user()->name }}" disabled/>

                                    <input type="hidden" id="auto_planner_name_id" name="auto_planner_name_id"
                                           value="{{ auth()->user()->id }}"/>
                                </div>
                                <div class="col-sm-6">
                                    <label class="d-block">{{ trans('cruds.requestCredit.fields.credit_type') }}<span
                                            class="text-danger">*</span></label>
                                    @foreach(App\Models\RequestCredit::CREDIT_TYPE_SELECT as $key => $label)
                                        <div
                                            class="form-check form-check-inline mt-3 {{ $errors->has('credit_type') ? 'is-invalid' : '' }}">
                                            <input class="form-check-input" type="radio" id="type_{{ $key }}"
                                                   name="credit_type"
                                                   value="{{ $key }}" {{ old('credit_type', '') === (string) $key ? 'checked' : '' }} >
                                            <label class="form-check-label" for="type_{{ $key }}">{{ $label }}</label>
                                        </div>
                                    @endforeach
                                    @if($errors->has('credit_type'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('credit_type') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="col-12 d-flex justify-content-between">
                                    <button type="button" class="btn btn-label-secondary btn-prev" disabled><i
                                            class="ti ti-arrow-left me-sm-1"></i>
                                        <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                    </button>
                                    <button type="button" class="btn btn-primary btn-next"><span
                                            class="align-middle d-sm-inline-block d-none me-sm-1">Next</span>
                                        <i
                                            class="ti ti-arrow-right"></i></button>
                                </div>
                            </div>
                        </div>
                        <!-- Personal Info -->
                        <div id="debtor-candidate-info" class="content">
                            <div class="content-header mb-3">
                                <h6 class="mb-0">Informasi Calon Debitur</h6>
                                <small>Form dengan tanda <span class="text-danger">*</span> Wajib diisi</small>
                            </div>
                            <div class="row g-3">
                                <div class="personal-container row">
                                    <div class="col-sm-6"><br>
                                        <label class="required"
                                               for="debtor_name">{{ trans('cruds.requestCreditDebtor.fields.name_debtor') }}
                                            <span class="text-danger">*</span></label>
                                        <input
                                            class="form-control {{ $errors->has('debtor_name') ? 'is-invalid' : '' }}"
                                            type="text" name="debtor_name" id="debtor_name"
                                            value="{{ old('debtor_name', '') }}" required>
                                        @if($errors->has('debtor_name'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('debtor_name') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-sm-3"><br>
                                        <label
                                            class="required">{{ trans('cruds.requestCreditDebtor.fields.identity_type') }}
                                            <span class="text-danger">*</span></label>
                                        <select
                                            class="form-control {{ $errors->has('debtor_identity_type') ? 'is-invalid' : '' }}"
                                            name="debtor_identity_type" id="debtor_identity_type" required>
                                            <option
                                                value="" {{ old('debtor_identity_type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                            @foreach(App\Models\RequestCreditDebtor::IDENTITY_TYPE_SELECT as $key => $label)
                                                <option
                                                    value="{{ $key }}" {{ old('debtor_identity_type', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('debtor_identity_type'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('debtor_identity_type') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-sm-3"><br>
                                        <label class="required"
                                               for="debtor_identity_number">{{ trans('cruds.requestCreditDebtor.fields.identity_number') }}
                                            <span class="text-danger">*</span></label>
                                        <input
                                            class="form-control {{ $errors->has('debtor_identity_number') ? 'is-invalid' : '' }}"
                                            type="text" name="debtor_identity_number" id="debtor_identity_number"
                                            value="{{ old('debtor_identity_number', '') }}"
                                            required>
                                        @if($errors->has('debtor_identity_number'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('debtor_identity_number') }}
                                            </div>
                                        @endif
                                    </div>

                                    <div class="col-sm-6"><br>
                                        <label class="required"
                                               for="partner_name">{{ trans('cruds.requestCreditDebtor.fields.name_partner') }}
                                        </label>
                                        <input
                                            class="form-control {{ $errors->has('partner_name') ? 'is-invalid' : '' }}"
                                            type="text" name="partner_name" id="partner_name"
                                            value="{{ old('partner_name', '') }}" required>
                                        @if($errors->has('partner_name'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('partner_name') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-sm-3"><br>
                                        <label
                                            class="required">{{ trans('cruds.requestCreditDebtor.fields.identity_type') }}
                                        </label>
                                        <select
                                            class="form-control {{ $errors->has('partner_identity_type') ? 'is-invalid' : '' }}"
                                            name="partner_identity_type" id="partner_identity_type" required>
                                            <option
                                                value="" {{ old('partner_identity_type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                            @foreach(App\Models\RequestCreditDebtor::IDENTITY_TYPE_SELECT as $key => $label)
                                                <option
                                                    value="{{ $key }}" {{ old('partner_identity_type', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('partner_identity_type'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('partner_identity_type') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-sm-3"><br>
                                        <label class="required"
                                               for="partner_identity_number">{{ trans('cruds.requestCreditDebtor.fields.identity_number') }}
                                        </label>
                                        <input
                                            class="form-control {{ $errors->has('partner_identity_number') ? 'is-invalid' : '' }}"
                                            type="text" name="partner_identity_number" id="partner_identity_number"
                                            value="{{ old('partner_identity_number', '') }}"
                                            required>
                                        @if($errors->has('partner_identity_number'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('partner_identity_number') }}
                                            </div>
                                        @endif
                                    </div>

                                    <div class="col-sm-6"><br>
                                        <label class="required"
                                               for="guarantor_name">{{ trans('cruds.requestCreditDebtor.fields.name_guarantor') }}
                                        </label>
                                        <input
                                            class="form-control {{ $errors->has('guarantor_name') ? 'is-invalid' : '' }}"
                                            type="text" name="guarantor_name" id="guarantor_name"
                                            value="{{ old('guarantor_name', '') }}" required>
                                        @if($errors->has('guarantor_name'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('guarantor_name') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-sm-3"><br>
                                        <label
                                            class="required">{{ trans('cruds.requestCreditDebtor.fields.identity_type') }}
                                        </label>
                                        <select
                                            class="form-control {{ $errors->has('guarantor_identity_type') ? 'is-invalid' : '' }}"
                                            name="guarantor_identity_type" id="guarantor_identity_type" required>
                                            <option
                                                value="" {{ old('guarantor_identity_type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                            @foreach(App\Models\RequestCreditDebtor::IDENTITY_TYPE_SELECT as $key => $label)
                                                <option
                                                    value="{{ $key }}" {{ old('guarantor_identity_type', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('guarantor_identity_type'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('guarantor_identity_type') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-sm-3"><br>
                                        <label class="required"
                                               for="guarantor_identity_number">{{ trans('cruds.requestCreditDebtor.fields.identity_number') }}
                                        </label>
                                        <input
                                            class="form-control {{ $errors->has('guarantor_identity_number') ? 'is-invalid' : '' }}"
                                            type="text" name="guarantor_identity_number"
                                            id="guarantor_identity_number"
                                            value="{{ old('guarantor_identity_number', '') }}"
                                            required>
                                        @if($errors->has('guarantor_identity_number'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('guarantor_identity_number') }}
                                            </div>
                                        @endif
                                    </div>

                                    <div class="col-sm-6"><br>
                                        <label class="required"
                                               for="guarantor_partner_name">{{ trans('cruds.requestCreditDebtor.fields.name_guarantor_partner') }}
                                        </label>
                                        <input
                                            class="form-control {{ $errors->has('guarantor_partner_name') ? 'is-invalid' : '' }}"
                                            type="text" name="guarantor_partner_name" id="guarantor_partner_name"
                                            value="{{ old('guarantor_partnerv_name', '') }}" required>
                                        @if($errors->has('guarantor_partner_name'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('guarantor_partner_name') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-sm-3"><br>
                                        <label
                                            class="required">{{ trans('cruds.requestCreditDebtor.fields.identity_type') }}
                                        </label>
                                        <select
                                            class="form-control {{ $errors->has('guarantor_partner_identity_type') ? 'is-invalid' : '' }}"
                                            name="guarantor_partner_identity_type" id="guarantor_partner_identity_type"
                                            required>
                                            <option
                                                value="" {{ old('guarantor_partner_identity_type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                            @foreach(App\Models\RequestCreditDebtor::IDENTITY_TYPE_SELECT as $key => $label)
                                                <option
                                                    value="{{ $key }}" {{ old('guarantor_partner_identity_type', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('guarantor_partner_identity_type'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('guarantor_partner_identity_type') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-sm-3"><br>
                                        <label class="required"
                                               for="guarantor_partner_identity_number">{{ trans('cruds.requestCreditDebtor.fields.identity_number') }}
                                        </label>
                                        <input
                                            class="form-control {{ $errors->has('guarantor_partner_identity_number') ? 'is-invalid' : '' }}"
                                            type="text" name="guarantor_partner_identity_number"
                                            id="guarantor_partner_identity_number"
                                            value="{{ old('guarantor_partner_identity_number', '') }}"
                                            required>
                                        @if($errors->has('guarantor_partner_identity_number'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('guarantor_partner_identity_number') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="business-container row">
                                    <div class="col-sm-6"><br>
                                        <label class="required"
                                               for="business_name">{{ trans('cruds.requestCreditDebtor.fields.name_business') }}
                                            <span class="text-danger">*</span></label>
                                        <input
                                            class="form-control {{ $errors->has('business_name') ? 'is-invalid' : '' }}"
                                            type="text" name="business_name" id="business_name"
                                            value="{{ old('business_name', '') }}" required>
                                        @if($errors->has('business_name'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('business_name') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-sm-6"><br>
                                        <label class="required"
                                               for="business_identity_number">{{ trans('cruds.requestCreditDebtor.fields.identity_number') }}
                                            <span class="text-danger">*</span></label>
                                        <input
                                            class="form-control {{ $errors->has('business_identity_number') ? 'is-invalid' : '' }}"
                                            type="text" name="business_identity_number" id="business_identity_number"
                                            value="{{ old('business_identity_number', '') }}"
                                            required>
                                        @if($errors->has('business_identity_number'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('business_identity_number') }}
                                            </div>
                                        @endif
                                    </div>

                                    <div class="col-sm-6"><br>
                                        <label class="required"
                                               for="shareholder_name">{{ trans('cruds.requestCreditDebtor.fields.name_shareholders') }}
                                            <span class="text-danger">*</span></label>
                                        <input
                                            class="form-control {{ $errors->has('shareholder_name') ? 'is-invalid' : '' }}"
                                            type="text" name="shareholder_name" id="shareholder_name"
                                            value="{{ old('shareholder_name', '') }}" required>
                                        @if($errors->has('shareholder_name'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('shareholder_name') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-sm-3"><br>
                                        <label
                                            class="required">{{ trans('cruds.requestCreditDebtor.fields.identity_type') }}
                                            <span class="text-danger">*</span></label>
                                        <select
                                            class="form-control {{ $errors->has('shareholder_identity_type') ? 'is-invalid' : '' }}"
                                            name="shareholder_identity_type" id="shareholder_identity_type" required>
                                            <option
                                                value="" {{ old('shareholder_identity_type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                            @foreach(App\Models\RequestCreditDebtor::IDENTITY_TYPE_SELECT as $key => $label)
                                                <option
                                                    value="{{ $key }}" {{ old('shareholder_identity_type', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('shareholder_identity_type'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('shareholder_identity_type') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-sm-3"><br>
                                        <label class="required"
                                               for="shareholder_identity_number">{{ trans('cruds.requestCreditDebtor.fields.identity_number') }}
                                            <span class="text-danger">*</span></label>
                                        <input
                                            class="form-control {{ $errors->has('shareholder_identity_number') ? 'is-invalid' : '' }}"
                                            type="text" name="shareholder_identity_number"
                                            id="shareholder_identity_number"
                                            value="{{ old('shareholder_identity_number', '') }}"
                                            required>
                                        @if($errors->has('shareholder_identity_number'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('shareholder_identity_number') }}
                                            </div>
                                        @endif
                                    </div>

                                    <div class="shareholder_dyn_name-repeater form-repeater-container mb-3 mt-3">
                                        <div data-repeater-list="shareholder_dyn_name">
                                            <div data-repeater-item>
                                                <div class="row">
                                                    <div class="col-sm-6"><br>
                                                        <label
                                                            for="shareholder_dyn_name-1-1">{{ trans('cruds.requestCreditDebtor.fields.name_shareholders') }}
                                                        </label>
                                                        <input type="text" id="shareholder_dyn_name-1-1"
                                                               name="shareholder_dyn_name-1-1"
                                                               class="form-control"/>
                                                    </div>
                                                    <div class="col-sm-2"><br>
                                                        <label
                                                            class="required">{{ trans('cruds.requestCreditDebtor.fields.identity_type') }}
                                                            </label>
                                                        <select
                                                            class="form-control {{ $errors->has('shareholder_identity_type') ? 'is-invalid' : '' }}"
                                                            name="shareholder_dyn_name-1-2" id="shareholder_dyn_name-1-2" required>
                                                            <option
                                                                value="" {{ old('shareholder_identity_type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                                            @foreach(App\Models\RequestCreditDebtor::IDENTITY_TYPE_SELECT as $key => $label)
                                                                <option
                                                                    value="{{ $key }}" {{ old('shareholder_identity_type', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                                            @endforeach
                                                        </select>
                                                        @if($errors->has('shareholder_identity_type'))
                                                            <div class="invalid-feedback">
                                                                {{ $errors->first('shareholder_identity_type') }}
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="col-sm-2"><br>
                                                        <label class="required"
                                                               for="shareholder_dyn_name-1-3">{{ trans('cruds.requestCreditDebtor.fields.identity_number') }}
                                                            </label>
                                                        <input
                                                            class="form-control {{ $errors->has('shareholder_identity_number') ? 'is-invalid' : '' }}"
                                                            type="text" name="shareholder_dyn_name-1-3"
                                                            id="shareholder_dyn_name-1-3"
                                                            value="{{ old('shareholder_identity_number', '') }}"
                                                            required>
                                                        @if($errors->has('shareholder_identity_number'))
                                                            <div class="invalid-feedback">
                                                                {{ $errors->first('shareholder_identity_number') }}
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="col-2 d-flex">
                                                        <a class="w-75 btn btn-label-danger text-danger mt-4" data-repeater-delete>
                                                            <i class="ti ti-x ti-xs me-1"></i>
                                                            <span class="align-middle">Delete</span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><br>
                                        <div class="mb-0">
                                            <a class="btn btn-xs text-lightest btn-primary" data-repeater-create>
                                                <i class="ti ti-plus me-1"></i>
                                                <span class="align-middle">Add</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 d-flex justify-content-between">
                                    <button type="button" class="btn btn-label-secondary btn-prev"><i
                                            class="ti ti-arrow-left me-sm-1"></i>
                                        <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                    </button>
                                    <button type="button" class="btn btn-primary btn-next"><span
                                            class="align-middle d-sm-inline-block d-none me-sm-1">Next</span> <i
                                            class="ti ti-arrow-right"></i></button>
                                </div>
                            </div>
                        </div>
                        <!-- Address -->
                        <div id="loan-info" class="content">
                            <div class="content-header mb-3">
                                <h6 class="mb-0">Informasi Pinjaman</h6>
                                <small>Form dengan tanda <span class="text-danger">*</span> Wajib diisi</small>
                            </div>
                            <div class="row g-3">
                                <div class="col-sm-12">
                                    <label class="required"
                                           for="attr_dealer_text">{{ trans('cruds.requestCredit.fields.dealer') }}<span
                                            class="text-danger">*</span></label>
                                    <select
                                        class="form-select select2 {{ $errors->has('attr_dealer_text') ? 'is-invalid' : '' }}"
                                        name="attr_dealer_text" id="attr_dealer_text" required>
                                        <option
                                            value="" {{ old('attr_dealer_text', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                        @foreach($dealers as $id => $entry)
                                            <option
                                                value="{{ $id }}" {{ old('attr_dealer_text') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('attr_dealer_text'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('attr_dealer_text') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="col-sm-12 attr_dealer_text_other-container">
                                    <label class="required"
                                           for="attr_dealer_text_other">Other Dealer </label>
                                    <input
                                        class="form-control {{ $errors->has('attr_dealer_text_other') ? 'is-invalid' : '' }}"
                                        type="text" name="attr_dealer_text_other" id="attr_dealer_text_other"
                                        value="{{ old('attr_dealer_text_other', '') }}"
                                        required>
                                    @if($errors->has('attr_dealer_text_other'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('attr_dealer_text_other') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="col-sm-6">
                                    <label class="required"
                                           for="attr_sales_name">{{ trans('cruds.requestCredit.fields.sales_name') }}
                                        <span class="text-danger">*</span></label>
                                    <input
                                        class="form-control {{ $errors->has('attr_sales_name') ? 'is-invalid' : '' }}"
                                        type="text" name="attr_sales_name" id="attr_sales_name"
                                        value="{{ old('attr_sales_name', '') }}"
                                        required>
                                    @if($errors->has('attr_sales_name'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('attr_sales_name') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="col-sm-6">
                                    <label class="required"
                                           for="attr_product_text">{{ trans('cruds.requestCredit.fields.product_name') }}
                                        <span class="text-danger">*</span></label>
                                    <select
                                        class="form-control select2 {{ $errors->has('attr_product_text') ? 'is-invalid' : '' }}"
                                        name="attr_product_text" id="attr_product_text" required>
                                        <option
                                            value="" {{ old('attr_product_text', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>

                                        @foreach($products as $id => $entry)
                                            <option
                                                value="{{ $id }}" {{ old('attr_product_text') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('attr_product_text'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('attr_product_text') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="col-sm-12">
                                    <label class="required"
                                           for="attr_brand_text">{{ trans('cruds.requestCredit.fields.brand') }}<span
                                            class="text-danger">*</span></label>
                                    <select
                                        class="form-control select2 {{ $errors->has('attr_brand_text') ? 'is-invalid' : '' }}"
                                        name="attr_brand_text" id="attr_brand_text" required>
                                        <option
                                            value="" {{ old('attr_brand_text', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>

                                        @foreach($brands as $id => $entry)
                                            <option
                                                value="{{ $id }}" {{ old('attr_brand_text') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('attr_brand_text'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('attr_brand_text') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="col-sm-12 attr_brand_text_other-container">
                                    <label class="required"
                                           for="attr_brand_text_other">Other Brands</label>
                                    <input
                                        class="form-control {{ $errors->has('attr_brand_text_other') ? 'is-invalid' : '' }}"
                                        type="text"
                                        name="attr_brand_text_other" id="attr_brand_text_other"
                                        value="{{ old('attr_brand_text_other', '') }}"
                                        required>
                                    @if($errors->has('attr_brand_text_other'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('attr_brand_text_other') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="col-sm-6">
                                    <label class="required"
                                           for="attr_models">{{ trans('cruds.requestCredit.fields.models') }}<span
                                            class="text-danger">*</span></label>
                                    <input class="form-control {{ $errors->has('attr_models') ? 'is-invalid' : '' }}"
                                           type="text"
                                           name="attr_models" id="attr_models" value="{{ old('attr_models', '') }}"
                                           required>
                                    @if($errors->has('attr_models'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('attr_models') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="col-sm-6">
                                    <label class="required"
                                           for="attr_number_of_units">{{ trans('cruds.requestCredit.fields.number_of_units') }}
                                        <span class="text-danger">*</span></label>
                                    <input
                                        class="form-control {{ $errors->has('attr_number_of_units') ? 'is-invalid' : '' }}"
                                        type="number" name="attr_number_of_units" id="attr_number_of_units"
                                        value="{{ old('attr_number_of_units', '') }}" step="1" required>
                                    @if($errors->has('attr_number_of_units'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('attr_number_of_units') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="col-sm-6">
                                    <label class="required"
                                           for="attr_otr">{{ trans('cruds.requestCredit.fields.otr') }}<span
                                            class="text-danger">*</span></label>
                                    <input class="form-control {{ $errors->has('attr_otr') ? 'is-invalid' : '' }}"
                                           type="text" data-type="currency"
                                           name="attr_otr" id="attr_otr" value="{{ old('attr_otr', '') }}" step="0.01"
                                           required>
                                    @if($errors->has('attr_otr'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('attr_otr') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="col-sm-6">
                                    <label class="required"
                                           for="attr_debt_principal">{{ trans('cruds.requestCredit.fields.debt_principal') }}
                                        <span class="text-danger">*</span></label>
                                    <input
                                        class="form-control {{ $errors->has('attr_debt_principal') ? 'is-invalid' : '' }}"
                                        type="text" data-type="currency" name="attr_debt_principal"
                                        id="attr_debt_principal"
                                        value="{{ old('attr_debt_principal', '') }}" required>
                                    @if($errors->has('attr_debt_principal'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('attr_debt_principal') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="col-sm-6">
                                    <label class="required"
                                           for="attr_insurance_text">{{ trans('cruds.requestCredit.fields.insurance_text') }}
                                        <span class="text-danger">*</span></label>
                                    <select
                                        class="form-control select2 {{ $errors->has('attr_insurance_text') ? 'is-invalid' : '' }}"
                                        name="attr_insurance_text" id="attr_insurance_text" required>
                                        <option
                                            value="" {{ old('attr_insurance_text', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                        @foreach($insurances as $id => $entry)
                                            <option
                                                value="{{ $id }}" {{ old('attr_insurance_text') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('attr_insurance_text'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('attr_insurance_text') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="col-sm-6">
                                    <label class="required"
                                           for="attr_tenors_text">{{ trans('cruds.requestCredit.fields.tenors_text') }}
                                        <span class="text-danger">*</span></label>
                                    <select
                                        class="form-control select2 {{ $errors->has('attr_tenors_text') ? 'is-invalid' : '' }}"
                                        name="attr_tenors_text" id="attr_tenors_text" required>
                                        <option
                                            value="" {{ old('attr_tenors_text', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>

                                        @foreach($tenors as $id => $entry)
                                            <option
                                                value="{{ $id }}" {{ old('attr_tenors_text') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('attr_tenors_text'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('attr_tenors_text') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="col-sm-6">
                                    <label
                                        for="attr_down_payment_text">Down Payment<span
                                            class="text-danger">*</span></label>
                                    <select
                                        class="form-control select2 {{ $errors->has('attr_down_payment_text') ? 'is-invalid' : '' }}"
                                        name="attr_down_payment_text" id="attr_down_payment_text" required>
                                        <option
                                            value="" {{ old('attr_down_payment_text', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                        @foreach(App\Models\RequestCreditHelp::DOWN_PAYMENT_SELECT as $key => $label)
                                            <option
                                                value="{{ $key }}" {{ old('attr_down_payment_text', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('attr_down_payment_text'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('attr_down_payment_text') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="col-sm-6 attr_down_payment_text_other-container">
                                    <label class="required"
                                           for="attr_down_payment_text_other">Other Down Payment</label>
                                    <input
                                        class="form-control {{ $errors->has('attr_down_payment_text_other') ? 'is-invalid' : '' }}"
                                        type="number" name="attr_down_payment_text_other"
                                        id="attr_down_payment_text_other"
                                        value="{{ old('attr_down_payment_text_other', '') }}"
                                        required>
                                    @if($errors->has('attr_down_payment_text_other'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('attr_down_payment_text_other') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="col-sm-6">
                                    <label class="d-block">{{ trans('cruds.requestCredit.fields.addm_addb') }}<span
                                            class="text-danger">*</span></label>
                                    <div
                                        class="form-check form-check-inline mt-3 {{ $errors->has('attr_addm_addb') ? 'is-invalid' : '' }}">
                                        <input class="form-check-input" type="radio" id="type_addm"
                                               name="attr_addm_addb"
                                               value="addm" {{ old('attr_addm_addb', '') === 'addm' ? 'checked' : '' }} >
                                        <label class="form-check-label" for="type_addm">ADDM</label>
                                    </div>
                                    <div
                                        class="form-check form-check-inline mt-3 {{ $errors->has('attr_addm_addb') ? 'is-invalid' : '' }}">
                                        <input class="form-check-input" type="radio" id="type_addb"
                                               name="attr_addm_addb"
                                               value="addb" {{ old('attr_addm_addb', '') === 'addb' ? 'checked' : '' }} >
                                        <label class="form-check-label" for="type_addb">ADDB</label>
                                    </div>
                                    @if($errors->has('attr_addm_addb'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('attr_addm_addb') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="col-sm-6">
                                    <label class="required"
                                           for="attr_effective_rates">{{ trans('cruds.requestCredit.fields.effective_rates') }}
                                        <span class="text-danger">*</span></label>
                                    <input
                                        class="form-control {{ $errors->has('attr_effective_rates') ? 'is-invalid' : '' }}"
                                        type="number" name="attr_effective_rates" id="attr_effective_rates"
                                        value="{{ old('attr_effective_rates', '') }}" step="0.01" required>
                                    @if($errors->has('attr_effective_rates'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('attr_effective_rates') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="col-sm-6">
                                    <label class="required"
                                           for="attr_car_year">{{ trans('cruds.requestCredit.fields.car_year') }}<span
                                            class="text-danger">*</span></label>
                                    <input
                                        class="form-control {{ $errors->has('attr_car_year') ? 'is-invalid' : '' }}"
                                        type="number" name="attr_car_year" id="attr_car_year"
                                        value="{{ old('attr_car_year', '') }}" step="0.01" required>
                                    @if($errors->has('attr_car_year'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('attr_car_year') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="col-sm-6">
                                    <label class="required"
                                           for="attr_debtor_phone">{{ trans('cruds.requestCredit.fields.debtor_phone') }}
                                        <span class="text-danger">*</span></label>
                                    <input
                                        class="form-control {{ $errors->has('attr_debtor_phone') ? 'is-invalid' : '' }}"
                                        type="text" name="attr_debtor_phone" id="attr_debtor_phone"
                                        value="{{ old('attr_debtor_phone', '') }}" required>
                                    @if($errors->has('attr_debtor_phone'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('attr_debtor_phone') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="col-sm-6">
                                    <label for="attr_remarks">{{ trans('cruds.requestCredit.fields.remarks') }}</label>
                                    <input class="form-control {{ $errors->has('attr_remarks') ? 'is-invalid' : '' }}"
                                           type="text" name="attr_remarks" id="attr_remarks"
                                           value="{{ old('attr_remarks', '') }}">
                                    @if($errors->has('attr_remarks'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('attr_remarks') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="col-sm-12">
                                    <label class="required"
                                           for="id_photos">{{ trans('cruds.requestCredit.fields.id_photos') }}<span
                                            class="text-danger">*</span></label>
                                    <div
                                        class="form-control needsclick dropzone {{ $errors->has('id_photos') ? 'is-invalid' : '' }}"
                                        id="id_photos-dropzone">
                                    </div>
                                    @if($errors->has('id_photos'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('id_photos') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="col-sm-12">
                                    <label class="required"
                                           for="kk_photos">{{ trans('cruds.requestCredit.fields.kk_photos') }}<span
                                            class="text-danger">*</span></label>
                                    <div
                                        class="form-control needsclick dropzone {{ $errors->has('kk_photos') ? 'is-invalid' : '' }}"
                                        id="kk_photos-dropzone">
                                    </div>
                                    @if($errors->has('kk_photos'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('kk_photos') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="col-sm-12">
                                    <label
                                           for="npwp_photos">{{ trans('cruds.requestCredit.fields.npwp_photos') }}
                                    </label>
                                    <div
                                        class="form-control needsclick dropzone {{ $errors->has('npwp_photos') ? 'is-invalid' : '' }}"
                                        id="npwp_photos-dropzone">
                                    </div>
                                    @if($errors->has('npwp_photos'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('npwp_photos') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="col-sm-12">
                                    <label
                                           for="other_photos">{{ trans('cruds.requestCredit.fields.other_photos') }}
                                    </label>
                                    <div
                                        class="form-control needsclick dropzone {{ $errors->has('other_photos') ? 'is-invalid' : '' }}"
                                        id="other_photos-dropzone">
                                    </div>
                                    @if($errors->has('other_photos'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('other_photos') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="col-12 d-flex justify-content-between">
                                    <button type="button" class="btn btn-label-secondary btn-prev"><i
                                            class="ti ti-arrow-left me-sm-1"></i>
                                        <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                    </button>
                                    <button type="submit" class="btn btn-success btn-submit">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /Modern Icons Wizard -->
    </div>
@endsection
