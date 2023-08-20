@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.requestCreditHelp.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.request-credit-helps.update", [$requestCreditHelp->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label>{{ trans('cruds.requestCreditHelp.fields.type') }}</label>
                <select class="form-control {{ $errors->has('type') ? 'is-invalid' : '' }}" name="type" id="type">
                    <option value disabled {{ old('type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\RequestCreditHelp::TYPE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('type', $requestCreditHelp->type) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.requestCreditHelp.fields.type_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="attribute">{{ trans('cruds.requestCreditHelp.fields.attribute') }}</label>
                <input class="form-control {{ $errors->has('attribute') ? 'is-invalid' : '' }}" type="text" name="attribute" id="attribute" value="{{ old('attribute', $requestCreditHelp->attribute) }}">
                @if($errors->has('attribute'))
                    <div class="invalid-feedback">
                        {{ $errors->first('attribute') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.requestCreditHelp.fields.attribute_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="attribute_2">{{ trans('cruds.requestCreditHelp.fields.attribute_2') }}</label>
                <input class="form-control {{ $errors->has('attribute_2') ? 'is-invalid' : '' }}" type="text" name="attribute_2" id="attribute_2" value="{{ old('attribute_2', $requestCreditHelp->attribute_2) }}">
                @if($errors->has('attribute_2'))
                    <div class="invalid-feedback">
                        {{ $errors->first('attribute_2') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.requestCreditHelp.fields.attribute_2_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="attribute_3">{{ trans('cruds.requestCreditHelp.fields.attribute_3') }}</label>
                <input class="form-control {{ $errors->has('attribute_3') ? 'is-invalid' : '' }}" type="text" name="attribute_3" id="attribute_3" value="{{ old('attribute_3', $requestCreditHelp->attribute_3) }}">
                @if($errors->has('attribute_3'))
                    <div class="invalid-feedback">
                        {{ $errors->first('attribute_3') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.requestCreditHelp.fields.attribute_3_helper') }}</span>
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