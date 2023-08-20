@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.requestCreditAttribute.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.request-credit-attributes.update", [$requestCreditAttribute->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="object_name">{{ trans('cruds.requestCreditAttribute.fields.object_name') }}</label>
                <input class="form-control {{ $errors->has('object_name') ? 'is-invalid' : '' }}" type="text" name="object_name" id="object_name" value="{{ old('object_name', $requestCreditAttribute->object_name) }}" required>
                @if($errors->has('object_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('object_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.requestCreditAttribute.fields.object_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="attribute">{{ trans('cruds.requestCreditAttribute.fields.attribute') }}</label>
                <input class="form-control {{ $errors->has('attribute') ? 'is-invalid' : '' }}" type="text" name="attribute" id="attribute" value="{{ old('attribute', $requestCreditAttribute->attribute) }}">
                @if($errors->has('attribute'))
                    <div class="invalid-feedback">
                        {{ $errors->first('attribute') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.requestCreditAttribute.fields.attribute_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="attribute_2">{{ trans('cruds.requestCreditAttribute.fields.attribute_2') }}</label>
                <input class="form-control {{ $errors->has('attribute_2') ? 'is-invalid' : '' }}" type="text" name="attribute_2" id="attribute_2" value="{{ old('attribute_2', $requestCreditAttribute->attribute_2) }}">
                @if($errors->has('attribute_2'))
                    <div class="invalid-feedback">
                        {{ $errors->first('attribute_2') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.requestCreditAttribute.fields.attribute_2_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="attribute_3">{{ trans('cruds.requestCreditAttribute.fields.attribute_3') }}</label>
                <input class="form-control {{ $errors->has('attribute_3') ? 'is-invalid' : '' }}" type="text" name="attribute_3" id="attribute_3" value="{{ old('attribute_3', $requestCreditAttribute->attribute_3) }}">
                @if($errors->has('attribute_3'))
                    <div class="invalid-feedback">
                        {{ $errors->first('attribute_3') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.requestCreditAttribute.fields.attribute_3_helper') }}</span>
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