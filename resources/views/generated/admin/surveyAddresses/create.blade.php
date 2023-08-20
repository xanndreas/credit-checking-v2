@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.surveyAddress.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.survey-addresses.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="request_credit_id">{{ trans('cruds.surveyAddress.fields.request_credit') }}</label>
                <select class="form-control select2 {{ $errors->has('request_credit') ? 'is-invalid' : '' }}" name="request_credit_id" id="request_credit_id" required>
                    @foreach($request_credits as $id => $entry)
                        <option value="{{ $id }}" {{ old('request_credit_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('request_credit'))
                    <div class="invalid-feedback">
                        {{ $errors->first('request_credit') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.surveyAddress.fields.request_credit_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.surveyAddress.fields.address_type') }}</label>
                <select class="form-control {{ $errors->has('address_type') ? 'is-invalid' : '' }}" name="address_type" id="address_type" required>
                    <option value disabled {{ old('address_type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\SurveyAddress::ADDRESS_TYPE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('address_type', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('address_type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('address_type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.surveyAddress.fields.address_type_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="addresses">{{ trans('cruds.surveyAddress.fields.addresses') }}</label>
                <textarea class="form-control {{ $errors->has('addresses') ? 'is-invalid' : '' }}" name="addresses" id="addresses">{{ old('addresses') }}</textarea>
                @if($errors->has('addresses'))
                    <div class="invalid-feedback">
                        {{ $errors->first('addresses') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.surveyAddress.fields.addresses_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="surveyor_id">{{ trans('cruds.surveyAddress.fields.surveyor') }}</label>
                <select class="form-control select2 {{ $errors->has('surveyor') ? 'is-invalid' : '' }}" name="surveyor_id" id="surveyor_id" required>
                    @foreach($surveyors as $id => $entry)
                        <option value="{{ $id }}" {{ old('surveyor_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('surveyor'))
                    <div class="invalid-feedback">
                        {{ $errors->first('surveyor') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.surveyAddress.fields.surveyor_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection