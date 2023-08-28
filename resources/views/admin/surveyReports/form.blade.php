@extends('layouts/layoutMaster')

@section('title', 'Survey Reports - Pages')

@section('vendor-style')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet"/>
@endsection

@section('vendor-script')
    <script src="{{asset('assets/vendor/libs/jquery-repeater/jquery-repeater.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
@endsection

@section('page-script')
    <script src="{{asset('assets/js/admin/survey-reports.js')}}"></script>
    <script>
        let uploadedIdentityMap = {},
            uploadedLegalityMap = {},
            uploadedIncomeMap = {},
            uploadedCheckingAccountMap = {},
            uploadedHomePictureMap = {},
            uploadedOfficePictureMap = {},
            uploadedSlikMap = {},
            uploadedBkrOfficePictureMap = {},
            uploadedUnitRefinancingMap = {},
            uploadedGuarantorMap = {};

        Dropzone.options.identityDropzone = {
            url: '{{ route('admin.survey-reports.storeMedia') }}',
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
                $('form').append('<input type="hidden" name="identity[]" value="' + response.name + '">')
                uploadedIdentityMap[file.name] = response.name
            },
            removedfile: function (file) {
                console.log(file)
                file.previewElement.remove()
                let name = ''
                if (typeof file.file_name !== 'undefined') {
                    name = file.file_name
                } else {
                    name = uploadedIdentityMap[file.name]
                }
                $('form').find('input[name="identity[]"][value="' + name + '"]').remove()
            },
            init: function () {
                @if(isset($surveyReport) && $surveyReport->identity)
                let files = {!! json_encode($surveyReport->identity) !!}

                for(let
                i in files
            )
                {
                    let file = files[i]
                    this.options.addedfile.call(this, file)
                    this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
                    file.previewElement.classList.add('dz-complete')
                    $('form').append('<input type="hidden" name="identity[]" value="' + file.file_name + '">')
                }

                @endif
            },
            error: function (file, response) {
                if ($.type(response) === 'string') {
                    let message = response
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

        Dropzone.options.legalityDropzone = {
            url: '{{ route('admin.survey-reports.storeMedia') }}',
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
                $('form').append('<input type="hidden" name="legality[]" value="' + response.name + '">')
                uploadedLegalityMap[file.name] = response.name
            },
            removedfile: function (file) {
                console.log(file)
                file.previewElement.remove()
                let name = ''
                if (typeof file.file_name !== 'undefined') {
                    name = file.file_name
                } else {
                    name = uploadedLegalityMap[file.name]
                }
                $('form').find('input[name="legality[]"][value="' + name + '"]').remove()
            },
            init: function () {
                @if(isset($surveyReport) && $surveyReport->legality)
                let files = {!! json_encode($surveyReport->legality) !!}

                for(let
                i in files
            )
                {
                    let file = files[i]
                    this.options.addedfile.call(this, file)
                    this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
                    file.previewElement.classList.add('dz-complete')
                    $('form').append('<input type="hidden" name="legality[]" value="' + file.file_name + '">')
                }

                @endif
            },
            error: function (file, response) {
                if ($.type(response) === 'string') {
                    let message = response
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

        Dropzone.options.incomeDropzone = {
            url: '{{ route('admin.survey-reports.storeMedia') }}',
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
                $('form').append('<input type="hidden" name="income[]" value="' + response.name + '">')
                uploadedIncomeMap[file.name] = response.name
            },
            removedfile: function (file) {
                console.log(file)
                file.previewElement.remove()
                let name = ''
                if (typeof file.file_name !== 'undefined') {
                    name = file.file_name
                } else {
                    name = uploadedIncomeMap[file.name]
                }
                $('form').find('input[name="income[]"][value="' + name + '"]').remove()
            },
            init: function () {
                @if(isset($surveyReport) && $surveyReport->income)
                let files = {!! json_encode($surveyReport->income) !!}

                for(let
                i in files
            )
                {
                    let file = files[i]
                    this.options.addedfile.call(this, file)
                    this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
                    file.previewElement.classList.add('dz-complete')
                    $('form').append('<input type="hidden" name="income[]" value="' + file.file_name + '">')
                }

                @endif
            },
            error: function (file, response) {
                if ($.type(response) === 'string') {
                    let message = response
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

        Dropzone.options.checkingAccountDropzone = {
            url: '{{ route('admin.survey-reports.storeMedia') }}',
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
                $('form').append('<input type="hidden" name="checking_account[]" value="' + response.name + '">')
                uploadedCheckingAccountMap[file.name] = response.name
            },
            removedfile: function (file) {
                console.log(file)
                file.previewElement.remove()
                let name = ''
                if (typeof file.file_name !== 'undefined') {
                    name = file.file_name
                } else {
                    name = uploadedCheckingAccountMap[file.name]
                }
                $('form').find('input[name="checking_account[]"][value="' + name + '"]').remove()
            },
            init: function () {
                @if(isset($surveyReport) && $surveyReport->checking_account)
                let files = {!! json_encode($surveyReport->checking_account) !!}

                for(let
                i in files
            )
                {
                    let file = files[i]
                    this.options.addedfile.call(this, file)
                    this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
                    file.previewElement.classList.add('dz-complete')
                    $('form').append('<input type="hidden" name="checking_account[]" value="' + file.file_name + '">')
                }

                @endif
            },
            error: function (file, response) {
                if ($.type(response) === 'string') {
                    let message = response
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

        Dropzone.options.homePictureDropzone = {
            url: '{{ route('admin.survey-reports.storeMedia') }}',
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
                $('form').append('<input type="hidden" name="home_picture[]" value="' + response.name + '">')
                uploadedHomePictureMap[file.name] = response.name
            },
            removedfile: function (file) {
                console.log(file)
                file.previewElement.remove()
                let name = ''
                if (typeof file.file_name !== 'undefined') {
                    name = file.file_name
                } else {
                    name = uploadedHomePictureMap[file.name]
                }
                $('form').find('input[name="home_picture[]"][value="' + name + '"]').remove()
            },
            init: function () {
                @if(isset($surveyReport) && $surveyReport->home_picture)
                let files = {!! json_encode($surveyReport->home_picture) !!}

                for(let
                i in files
            )
                {
                    let file = files[i]
                    this.options.addedfile.call(this, file)
                    this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
                    file.previewElement.classList.add('dz-complete')
                    $('form').append('<input type="hidden" name="home_picture[]" value="' + file.file_name + '">')
                }

                @endif
            },
            error: function (file, response) {
                if ($.type(response) === 'string') {
                    let message = response
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

        Dropzone.options.officePictureDropzone = {
            url: '{{ route('admin.survey-reports.storeMedia') }}',
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
                $('form').append('<input type="hidden" name="office_picture[]" value="' + response.name + '">')
                uploadedOfficePictureMap[file.name] = response.name
            },
            removedfile: function (file) {
                console.log(file)
                file.previewElement.remove()
                let name = ''
                if (typeof file.file_name !== 'undefined') {
                    name = file.file_name
                } else {
                    name = uploadedOfficePictureMap[file.name]
                }
                $('form').find('input[name="office_picture[]"][value="' + name + '"]').remove()
            },
            init: function () {
                @if(isset($surveyReport) && $surveyReport->office_picture)
                let files = {!! json_encode($surveyReport->office_picture) !!}

                for(let
                i in files
            )
                {
                    let file = files[i]
                    this.options.addedfile.call(this, file)
                    this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
                    file.previewElement.classList.add('dz-complete')
                    $('form').append('<input type="hidden" name="office_picture[]" value="' + file.file_name + '">')
                }

                @endif
            },
            error: function (file, response) {
                if ($.type(response) === 'string') {
                    let message = response
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

        Dropzone.options.slikDropzone = {
            url: '{{ route('admin.survey-reports.storeMedia') }}',
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
                $('form').append('<input type="hidden" name="slik[]" value="' + response.name + '">')
                uploadedSlikMap[file.name] = response.name
            },
            removedfile: function (file) {
                console.log(file)
                file.previewElement.remove()
                let name = ''
                if (typeof file.file_name !== 'undefined') {
                    name = file.file_name
                } else {
                    name = uploadedSlikMap[file.name]
                }
                $('form').find('input[name="slik[]"][value="' + name + '"]').remove()
            },
            init: function () {
                @if(isset($surveyReport) && $surveyReport->slik)
                let files = {!! json_encode($surveyReport->slik) !!}

                for(let
                i in files
            )
                {
                    let file = files[i]
                    this.options.addedfile.call(this, file)
                    this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
                    file.previewElement.classList.add('dz-complete')
                    $('form').append('<input type="hidden" name="slik[]" value="' + file.file_name + '">')
                }

                @endif
            },
            error: function (file, response) {
                if ($.type(response) === 'string') {
                    let message = response
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

        Dropzone.options.bkrOfficePictureDropzone = {
            url: '{{ route('admin.survey-reports.storeMedia') }}',
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
                $('form').append('<input type="hidden" name="bkr_office_picture[]" value="' + response.name + '">')
                uploadedBkrOfficePictureMap[file.name] = response.name
            },
            removedfile: function (file) {
                console.log(file)
                file.previewElement.remove()
                let name = ''
                if (typeof file.file_name !== 'undefined') {
                    name = file.file_name
                } else {
                    name = uploadedBkrOfficePictureMap[file.name]
                }
                $('form').find('input[name="bkr_office_picture[]"][value="' + name + '"]').remove()
            },
            init: function () {
                @if(isset($surveyReport) && $surveyReport->bkr_office_picture)
                let files = {!! json_encode($surveyReport->bkr_office_picture) !!}

                for(let
                i in files
            )
                {
                    let file = files[i]
                    this.options.addedfile.call(this, file)
                    this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
                    file.previewElement.classList.add('dz-complete')
                    $('form').append('<input type="hidden" name="bkr_office_picture[]" value="' + file.file_name + '">')
                }

                @endif
            },
            error: function (file, response) {
                if ($.type(response) === 'string') {
                    let message = response
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

        Dropzone.options.unitRefinancingDropzone = {
            url: '{{ route('admin.survey-reports.storeMedia') }}',
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
                $('form').append('<input type="hidden" name="unit_refinancing[]" value="' + response.name + '">')
                uploadedUnitRefinancingMap[file.name] = response.name
            },
            removedfile: function (file) {
                console.log(file)
                file.previewElement.remove()
                let name = ''
                if (typeof file.file_name !== 'undefined') {
                    name = file.file_name
                } else {
                    name = uploadedUnitRefinancingMap[file.name]
                }
                $('form').find('input[name="unit_refinancing[]"][value="' + name + '"]').remove()
            },
            init: function () {
                @if(isset($surveyReport) && $surveyReport->unit_refinancing)
                let files = {!! json_encode($surveyReport->unit_refinancing) !!}

                for(let
                i in files
            )
                {
                    let file = files[i]
                    this.options.addedfile.call(this, file)
                    this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
                    file.previewElement.classList.add('dz-complete')
                    $('form').append('<input type="hidden" name="unit_refinancing[]" value="' + file.file_name + '">')
                }

                @endif
            },
            error: function (file, response) {
                if ($.type(response) === 'string') {
                    let message = response
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

        Dropzone.options.guarantorDropzone = {
            url: '{{ route('admin.survey-reports.storeMedia') }}',
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
                $('form').append('<input type="hidden" name="guarantor[]" value="' + response.name + '">')
                uploadedGuarantorMap[file.name] = response.name
            },
            removedfile: function (file) {
                console.log(file)
                file.previewElement.remove()
                let name = ''
                if (typeof file.file_name !== 'undefined') {
                    name = file.file_name
                } else {
                    name = uploadedGuarantorMap[file.name]
                }
                $('form').find('input[name="guarantor[]"][value="' + name + '"]').remove()
            },
            init: function () {
                @if(isset($surveyReport) && $surveyReport->guarantor)
                let files = {!! json_encode($surveyReport->guarantor) !!}

                for(let
                i in files
            )
                {
                    let file = files[i]
                    this.options.addedfile.call(this, file)
                    this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
                    file.previewElement.classList.add('dz-complete')
                    $('form').append('<input type="hidden" name="guarantor[]" value="' + file.file_name + '">')
                }

                @endif
            },
            error: function (file, response) {
                if ($.type(response) === 'string') {
                    let message = response
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
    <div class="row">
        <div class="col-12">
            <div class="card">
                <form action="{{ route('admin.survey-reports.store', ['surveyAddress' => $surveyAddress->id] ) }}"
                      method="post"
                      enctype="multipart/form-data">
                    @csrf
                    <h5 class="card-header">
                        Survey Report
                    </h5>

                    <div class="card-body">
                        <div class="survey_address-repeater form-repeater-container mb-3">
                            <div data-repeater-list="survey_address">
                                <div data-repeater-item>
                                    <div class="row">
                                        <div class="mb-3 col-2 mb-0">
                                            <label class="form-label" for="survey_address-1-1">Tipe Alamat</label>
                                            <input type="text" id="survey_address-1-1" name="attribute"
                                                   class="form-control"/>
                                        </div>
                                        <div class="mb-3 col-4 mb-0">
                                            <label class="form-label" for="survey_address-1-2">Alamat</label>
                                            <input type="text" id="survey_address-1-2" name="attribute_2"
                                                   class="form-control"/>
                                        </div>
                                        <div class="mb-3 col-4 mb-0">
                                            <label class="form-label" for="survey_address-1-2">Catatan</label>
                                            <input type="text" id="survey_address-1-3" name="attribute_3"
                                                   class="form-control"/>
                                        </div>
                                        <div class="mb-3 col-2 d-flex align-items-center mb-0">
                                            <a class="w-100 btn btn-label-danger text-danger mt-4" data-repeater-delete>
                                                <i class="ti ti-x ti-xs me-1"></i>
                                                <span class="align-middle">Delete</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-0">
                                <a class="btn btn-xs text-lightest btn-primary" data-repeater-create>
                                    <i class="ti ti-plus me-1"></i>
                                    <span class="align-middle">Add</span>
                                </a>
                            </div>
                        </div>
                        <div class="mb-3 col-12 mb-0">
                            <label class="form-label" for="parking_access">Parking Access</label>
                            <textarea id="parking_access" name="parking_access"
                                      class="form-control {{ $errors->has('parking_access') ? 'is-invalid' : '' }}"></textarea>
                            @if($errors->has('parking_access'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('parking_access') }}
                                </div>
                            @endif
                        </div>
                        <div class="mb-3 col-12 mb-0">
                            <label class="form-label" for="owner_status">Owner Status</label>
                            <textarea id="owner_status" name="owner_status"
                                      class="form-control {{ $errors->has('owner_status') ? 'is-invalid' : '' }}"></textarea>
                            @if($errors->has('owner_status'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('owner_status') }}
                                </div>
                            @endif
                        </div>
                        <div class="mb-3 col-12 mb-0">
                            <label class="form-label" for="owner_beneficial">Owner Beneficial</label>
                            <textarea id="owner_beneficial" name="owner_beneficial"
                                      class="form-control {{ $errors->has('owner_beneficial') ? 'is-invalid' : '' }}"></textarea>
                            @if($errors->has('owner_beneficial'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('owner_beneficial') }}
                                </div>
                            @endif
                        </div>
                        <div class="mb-3 col-12 mb-0">
                            <label class="form-label" for="office_note">Office Note</label>
                            <textarea id="office_note" name="office_note"
                                      class="form-control {{ $errors->has('office_note') ? 'is-invalid' : '' }}"></textarea>
                            @if($errors->has('office_note'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('office_note') }}
                                </div>
                            @endif
                        </div>
                        <div class="document_attachment-repeater form-repeater-container mb-3">
                            <div data-repeater-list="document_attachment">
                                <div data-repeater-item>
                                    <div class="row">
                                        <div class="mb-3 col-2 mb-0">
                                            <label class="form-label" for="document_attachment-1-1">Tipe Dokumen</label>
                                            <input type="text" id="document_attachment-1-1" name="attribute"
                                                   class="form-control"/>
                                        </div>
                                        <div class="mb-3 col-8 mb-0">
                                            <label class="form-label" for="document_attachment-1-2">Description</label>
                                            <input type="text" id="document_attachment-1-2" name="attribute_2"
                                                   class="form-control"/>
                                        </div>
                                        <div class="mb-3 col-2 d-flex align-items-center mb-0">
                                            <a class="w-100 btn btn-label-danger text-danger mt-4" data-repeater-delete>
                                                <i class="ti ti-x ti-xs me-1"></i>
                                                <span class="align-middle">Delete</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-0">
                                <a class="btn btn-xs text-lightest btn-primary" data-repeater-create>
                                    <i class="ti ti-plus me-1"></i>
                                    <span class="align-middle">Add</span>
                                </a>
                            </div>
                        </div>
                        <div class="environmental_check-repeater form-repeater-container mb-3">
                            <div data-repeater-list="environmental_check">
                                <div data-repeater-item>
                                    <div class="row">
                                        <div class="mb-3 col-2 mb-0">
                                            <label class="form-label" for="environmental_check-1-1">Witness</label>
                                            <input type="text" id="environmental_check-1-1" name="attribute"
                                                   class="form-control"/>
                                        </div>
                                        <div class="mb-3 col-8 mb-0">
                                            <label class="form-label" for="environmental_check-1-2">Note</label>
                                            <input type="text" id="environmental_check-1-2" name="attribute_2"
                                                   class="form-control"/>
                                        </div>
                                        <div class="mb-3 col-2 d-flex align-items-center mb-0">
                                            <a class="w-100 btn btn-label-danger text-danger mt-4" data-repeater-delete>
                                                <i class="ti ti-x ti-xs me-1"></i>
                                                <span class="align-middle">Delete</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-0">
                                <a class="btn btn-xs text-lightest btn-primary" data-repeater-create>
                                    <i class="ti ti-plus me-1"></i>
                                    <span class="align-middle">Add</span>
                                </a>
                            </div>
                        </div>
                        <div class="note-repeater form-repeater-container mb-3">
                            <div data-repeater-list="note">
                                <div data-repeater-item>
                                    <div class="row">
                                        <div class="mb-3 col-10 mb-0">
                                            <label class="form-label" for="note-1-1">Notes</label>
                                            <input type="text" id="note-1-1" name="attribute" class="form-control"/>
                                        </div>
                                        <div class="mb-3 col-2 d-flex align-items-center mb-0">
                                            <a class="w-100 btn btn-label-danger text-danger mt-4" data-repeater-delete>
                                                <i class="ti ti-x ti-xs me-1"></i>
                                                <span class="align-middle">Delete</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-0">
                                <a class="btn btn-xs text-lightest btn-primary" data-repeater-create>
                                    <i class="ti ti-plus me-1"></i>
                                    <span class="align-middle">Add</span>
                                </a>
                            </div>
                        </div>
                        <div class="incomplete_document-repeater form-repeater-container mb-3">
                            <div data-repeater-list="incomplete_document">
                                <div data-repeater-item>
                                    <div class="row">
                                        <div class="mb-3 col-2 mb-0">
                                            <label class="form-label" for="incomplete_document-1-1">Types</label>
                                            <input type="text" id="incomplete_document-1-1" name="attribute"
                                                   class="form-control"/>
                                        </div>
                                        <div class="mb-3 col-8 mb-0">
                                            <label class="form-label" for="incomplete_document-1-2">Note</label>
                                            <input type="text" id="incomplete_document-1-2" name="attribute_2"
                                                   class="form-control"/>
                                        </div>
                                        <div class="mb-3 col-2 d-flex align-items-center mb-0">
                                            <a class="w-100 btn btn-label-danger text-danger mt-4" data-repeater-delete>
                                                <i class="ti ti-x ti-xs me-1"></i>
                                                <span class="align-middle">Delete</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-0">
                                <a class="btn btn-xs text-lightest btn-primary" data-repeater-create>
                                    <i class="ti ti-plus me-1"></i>
                                    <span class="align-middle">Add</span>
                                </a>
                            </div>
                        </div>
                        <div class="mb-3 col-sm-12">
                            <label class="required">Identity</label>
                            <div
                                class="needsclick dropzone form-control {{ $errors->has('identity') ? 'is-invalid' : '' }}"
                                id="identity-dropzone">
                            </div>
                            @if($errors->has('identity'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('identity') }}
                                </div>
                            @endif
                        </div>
                        <div class="mb-3 col-sm-12">
                            <label class="required">Legality</label>
                            <div
                                class="needsclick dropzone form-control {{ $errors->has('legality') ? 'is-invalid' : '' }}"
                                id="legality-dropzone">
                            </div>
                            @if($errors->has('legality'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('legality') }}
                                </div>
                            @endif
                        </div>
                        <div class="mb-3 col-sm-12">
                            <label class="required">Income</label>
                            <div
                                class="needsclick dropzone form-control {{ $errors->has('income') ? 'is-invalid' : '' }}"
                                id="income-dropzone">
                            </div>
                            @if($errors->has('income'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('income') }}
                                </div>
                            @endif
                        </div>
                        <div class="mb-3 col-sm-12">
                            <label class="required">Checking Account</label>
                            <div
                                class="needsclick dropzone form-control {{ $errors->has('checking_account') ? 'is-invalid' : '' }}"
                                id="checking_account-dropzone">
                            </div>
                            @if($errors->has('checking_account'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('checking_account') }}
                                </div>
                            @endif
                        </div>
                        <div class="mb-3 col-sm-12">
                            <label class="required">Home Picture</label>
                            <div
                                class="needsclick dropzone form-control {{ $errors->has('home_picture') ? 'is-invalid' : '' }}"
                                id="home_picture-dropzone">
                            </div>
                            @if($errors->has('home_picture'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('home_picture') }}
                                </div>
                            @endif
                        </div>
                        <div class="mb-3 col-sm-12">
                            <label class="required">Office Picture</label>
                            <div
                                class="needsclick dropzone form-control {{ $errors->has('office_picture') ? 'is-invalid' : '' }}"
                                id="office_picture-dropzone">
                            </div>
                            @if($errors->has('office_picture'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('office_picture') }}
                                </div>
                            @endif
                        </div>
                        <div class="mb-3 col-sm-12">
                            <label class="required">SLIK</label>
                            <div
                                class="needsclick dropzone form-control {{ $errors->has('slik') ? 'is-invalid' : '' }}"
                                id="slik-dropzone">
                            </div>
                            @if($errors->has('slik'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('slik') }}
                                </div>
                            @endif
                        </div>
                        <div class="mb-3 col-sm-12">
                            <label class="required">BKR/Office Picture</label>
                            <div
                                class="needsclick dropzone form-control {{ $errors->has('bkr_office_picture') ? 'is-invalid' : '' }}"
                                id="bkr_office_picture-dropzone">
                            </div>
                            @if($errors->has('bkr_office_picture'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('bkr_office_picture') }}
                                </div>
                            @endif
                        </div>
                        <div class="mb-3 col-sm-12">
                            <label class="required">Unit Refinancing</label>
                            <div
                                class="needsclick dropzone form-control {{ $errors->has('unit_refinancing') ? 'is-invalid' : '' }}"
                                id="unit_refinancing-dropzone">
                            </div>
                            @if($errors->has('unit_refinancing'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('unit_refinancing') }}
                                </div>
                            @endif
                        </div>
                        <div class="mb-3 col-sm-12">
                            <label class="required">Guarantor Images</label>
                            <div
                                class="needsclick dropzone form-control {{ $errors->has('guarantor') ? 'is-invalid' : '' }}"
                                id="guarantor-dropzone">
                            </div>
                            @if($errors->has('guarantor'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('guarantor') }}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success text-white">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
