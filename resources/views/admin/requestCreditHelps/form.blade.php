<!-- Offcanvas to add -->
<div class="offcanvas offcanvas-end {{ $errors->any() ? 'show' : '' }}" tabindex="-1" id="offcanvasAddRequestCreditHelp"
     aria-labelledby="offcanvasAddRequestCreditHelpLabel">
    <div class="offcanvas-header">
        <h5 id="offcanvasAddRequestCreditHelpLabel" class="offcanvas-title">Request Credit Help</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                aria-label="Close"></button>
    </div>
    <div class="offcanvas-body mx-0 flex-grow-0 pt-0 h-100">
        <form class="pt-0" id="addNewRequestCreditHelpForm" method="POST"
              action="" enctype="multipart/form-data">
            @method('put')
            @csrf
            <div class="mb-3">
                <label class="required" for="attribute">{{ trans('cruds.requestCreditHelp.fields.attribute') }}</label>
                <input class="form-control {{ $errors->has('attribute') ? 'is-invalid' : '' }}" type="text" name="attribute" id="attribute" value="{{ old('attribute', '') }}" required>
                @if($errors->has('attribute'))
                    <div class="invalid-feedback">
                        {{ $errors->first('attribute') }}
                    </div>
                @endif
            </div>
            <div class="mb-3">
                <label class="required" for="attribute_2">{{ trans('cruds.requestCreditHelp.fields.attribute_2') }}</label>
                <input class="form-control {{ $errors->has('attribute_2') ? 'is-invalid' : '' }}" type="text" name="attribute_2" id="attribute_2" value="{{ old('attribute_2', '') }}" required>
                @if($errors->has('attribute_2'))
                    <div class="invalid-feedback">
                        {{ $errors->first('attribute_2') }}
                    </div>
                @endif
            </div>
            <div class="mb-3">
                <label class="required" for="attribute_3">{{ trans('cruds.requestCreditHelp.fields.attribute_3') }}</label>
                <input class="form-control {{ $errors->has('attribute_3') ? 'is-invalid' : '' }}" type="text" name="attribute_3" id="attribute_3" value="{{ old('attribute_3', '') }}" required>
                @if($errors->has('attribute_3'))
                    <div class="invalid-feedback">
                        {{ $errors->first('attribute_3') }}
                    </div>
                @endif
            </div>
            <div class="mb-3">
                <label for="type"
                    class="required">{{ trans('cruds.requestCreditHelp.fields.type') }}</label>
                <select
                    class="form-control {{ $errors->has('type') ? 'is-invalid' : '' }}"
                    name="type" id="type" required>
                    <option
                        value="" {{ old('type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\RequestCreditHelp::TYPE_SELECT as $key => $label)
                        <option
                            value="{{ $key }}" {{ old('type', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('type') }}
                    </div>
                @endif
            </div>

            <a id="submitAddRequestCreditHelp" data-id=""
               class="btn btn-outline-primary waves-effect text-primary me-sm-3 me-1 ">{{ trans('global.save') }}</a>
            <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="offcanvas">Cancel</button>
        </form>
    </div>
</div>
