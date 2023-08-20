@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.requestCredit.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.request-credits.update", [$requestCredit->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="batch_number">{{ trans('cruds.requestCredit.fields.batch_number') }}</label>
                <input class="form-control {{ $errors->has('batch_number') ? 'is-invalid' : '' }}" type="text" name="batch_number" id="batch_number" value="{{ old('batch_number', $requestCredit->batch_number) }}" required>
                @if($errors->has('batch_number'))
                    <div class="invalid-feedback">
                        {{ $errors->first('batch_number') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.requestCredit.fields.batch_number_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.requestCredit.fields.credit_type') }}</label>
                <select class="form-control {{ $errors->has('credit_type') ? 'is-invalid' : '' }}" name="credit_type" id="credit_type" required>
                    <option value disabled {{ old('credit_type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\RequestCredit::CREDIT_TYPE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('credit_type', $requestCredit->credit_type) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('credit_type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('credit_type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.requestCredit.fields.credit_type_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="auto_planner_id">{{ trans('cruds.requestCredit.fields.auto_planner') }}</label>
                <select class="form-control select2 {{ $errors->has('auto_planner') ? 'is-invalid' : '' }}" name="auto_planner_id" id="auto_planner_id" required>
                    @foreach($auto_planners as $id => $entry)
                        <option value="{{ $id }}" {{ (old('auto_planner_id') ? old('auto_planner_id') : $requestCredit->auto_planner->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('auto_planner'))
                    <div class="invalid-feedback">
                        {{ $errors->first('auto_planner') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.requestCredit.fields.auto_planner_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="request_debtors">{{ trans('cruds.requestCredit.fields.request_debtor') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('request_debtors') ? 'is-invalid' : '' }}" name="request_debtors[]" id="request_debtors" multiple required>
                    @foreach($request_debtors as $id => $request_debtor)
                        <option value="{{ $id }}" {{ (in_array($id, old('request_debtors', [])) || $requestCredit->request_debtors->contains($id)) ? 'selected' : '' }}>{{ $request_debtor }}</option>
                    @endforeach
                </select>
                @if($errors->has('request_debtors'))
                    <div class="invalid-feedback">
                        {{ $errors->first('request_debtors') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.requestCredit.fields.request_debtor_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="request_attributes">{{ trans('cruds.requestCredit.fields.request_attribute') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('request_attributes') ? 'is-invalid' : '' }}" name="request_attributes[]" id="request_attributes" multiple required>
                    @foreach($request_attributes as $id => $request_attribute)
                        <option value="{{ $id }}" {{ (in_array($id, old('request_attributes', [])) || $requestCredit->request_attributes->contains($id)) ? 'selected' : '' }}>{{ $request_attribute }}</option>
                    @endforeach
                </select>
                @if($errors->has('request_attributes'))
                    <div class="invalid-feedback">
                        {{ $errors->first('request_attributes') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.requestCredit.fields.request_attribute_helper') }}</span>
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