@extends('layouts/layoutMaster')

@section('title', 'Settings')

@section('vendor-style')
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/select2/select2.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/formvalidation/dist/css/formValidation.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/select2/select2.css')}}"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet"/>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
@endsection

@section('page-script')
    <script src="{{asset('assets/js/admin/settings.js')}}"></script>
    <script>
        let uploadedOtherPhotosMap = {}
        Dropzone.options.otherPhotosDropzone = {
            url: '{{ route('admin.settings.storeMedia') }}',
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
                uploadedOtherPhotosMap[file.name] = response.name
            },
            removedfile: function (file) {
                console.log(file)
                file.previewElement.remove()
                let name = ''
                if (typeof file.file_name !== 'undefined') {
                    name = file.file_name
                } else {
                    name = uploadedOtherPhotosMap[file.name]
                }
                $('form').find('input[name="other_photos[]"][value="' + name + '"]').remove()
            },
            init: function () {
                @if(isset($dealerInformation) && $dealerInformation->other_photos)
                let files = {!! json_encode($dealerInformation->other_photos) !!}

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
    <div class="row">
        <div class="col-12">
            <h6 class="text-muted">Setting</h6>
            <div class="nav-align-top mb-4">
                <ul class="nav nav-pills mb-3" role="tablist">
                    <li class="nav-item">
                        <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                                data-bs-target="#navs-pills-top-pages" aria-controls="navs-pills-top-pages"
                                aria-selected="true">Pages
                        </button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                                data-bs-target="#navs-pills-top-roles" aria-controls="navs-pills-top-roles"
                                aria-selected="false">Roles
                        </button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                                data-bs-target="#navs-pills-login-logs" aria-controls="navs-pills-login-logs"
                                aria-selected="false">Login Logs
                        </button>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="navs-pills-top-pages" role="tabpanel">
                        <form class="add-new-user pt-0" id="addNewUserForm" method="POST"
                              action="" enctype="multipart/form-data">
                            @method('put')
                            @csrf
                            <div class="mb-3">
                                <label class="required"
                                       for="other_photos">Logo </label>
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

                            <button type="submit"
                                    class="btn btn-primary waves-effect float-end">{{ trans('global.update') }}</button>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="navs-pills-top-roles" role="tabpanel">
                        <div class="card-header border-bottom">
                            <h5 class="card-title mb-3">Roles</h5>
                        </div>
                        <div class="table-responsive">
                            <table class="datatables-users table border-top table-hover datatable-Role">
                                <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.role.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.role.fields.title') }}
                                    </th>
                                    <th>
                                        {{ trans('global.actions') }}
                                    </th>
                                </tr>
                                </thead>
                            </table>
                        </div>

                        @include('admin.settings.form')
                    </div>
                    <div class="tab-pane fade" id="navs-pills-login-logs" role="tabpanel">
                        <div class="card-header border-bottom">
                            <h5 class="card-title mb-3">Login Logs</h5>
                        </div>
                        <div class="table-responsive">
                            <table class="datatables-users table border-top table-hover datatable-LoginLogs">
                                <thead>
                                <tr>
                                    <th class="w-px-14">
                                    </th>
                                    <th>
                                        Auth Name
                                    </th>
                                    <th>
                                        IP Address
                                    </th>
                                    <th>
                                        User Agent
                                    </th>
                                    <th>
                                        Login At
                                    </th>
                                    <th>
                                        Login Success
                                    </th>
                                    <th>
                                        Logout At
                                    </th>
                                    <th>
                                        Clear By User
                                    </th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



