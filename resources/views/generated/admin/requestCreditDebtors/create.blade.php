@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.requestCreditDebtor.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.request-credit-debtors.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required">{{ trans('cruds.requestCreditDebtor.fields.personel_type') }}</label>
                <select class="form-control {{ $errors->has('personel_type') ? 'is-invalid' : '' }}" name="personel_type" id="personel_type" required>
                    <option value disabled {{ old('personel_type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\RequestCreditDebtor::PERSONEL_TYPE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('personel_type', 'debtor') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('personel_type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('personel_type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.requestCreditDebtor.fields.personel_type_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="name">{{ trans('cruds.requestCreditDebtor.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}">
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.requestCreditDebtor.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.requestCreditDebtor.fields.identity_type') }}</label>
                <select class="form-control {{ $errors->has('identity_type') ? 'is-invalid' : '' }}" name="identity_type" id="identity_type">
                    <option value disabled {{ old('identity_type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\RequestCreditDebtor::IDENTITY_TYPE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('identity_type', 'ktp') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('identity_type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('identity_type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.requestCreditDebtor.fields.identity_type_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="identity_number">{{ trans('cruds.requestCreditDebtor.fields.identity_number') }}</label>
                <input class="form-control {{ $errors->has('identity_number') ? 'is-invalid' : '' }}" type="text" name="identity_number" id="identity_number" value="{{ old('identity_number', '') }}">
                @if($errors->has('identity_number'))
                    <div class="invalid-feedback">
                        {{ $errors->first('identity_number') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.requestCreditDebtor.fields.identity_number_helper') }}</span>
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