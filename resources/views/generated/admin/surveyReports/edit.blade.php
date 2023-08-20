@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.surveyReport.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.survey-reports.update", [$surveyReport->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="request_credit_id">{{ trans('cruds.surveyReport.fields.request_credit') }}</label>
                <select class="form-control select2 {{ $errors->has('request_credit') ? 'is-invalid' : '' }}" name="request_credit_id" id="request_credit_id" required>
                    @foreach($request_credits as $id => $entry)
                        <option value="{{ $id }}" {{ (old('request_credit_id') ? old('request_credit_id') : $surveyReport->request_credit->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('request_credit'))
                    <div class="invalid-feedback">
                        {{ $errors->first('request_credit') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.surveyReport.fields.request_credit_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="survey_address_id">{{ trans('cruds.surveyReport.fields.survey_address') }}</label>
                <select class="form-control select2 {{ $errors->has('survey_address') ? 'is-invalid' : '' }}" name="survey_address_id" id="survey_address_id" required>
                    @foreach($survey_addresses as $id => $entry)
                        <option value="{{ $id }}" {{ (old('survey_address_id') ? old('survey_address_id') : $surveyReport->survey_address->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('survey_address'))
                    <div class="invalid-feedback">
                        {{ $errors->first('survey_address') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.surveyReport.fields.survey_address_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="survey_attributes">{{ trans('cruds.surveyReport.fields.survey_attributes') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('survey_attributes') ? 'is-invalid' : '' }}" name="survey_attributes[]" id="survey_attributes" multiple>
                    @foreach($survey_attributes as $id => $survey_attribute)
                        <option value="{{ $id }}" {{ (in_array($id, old('survey_attributes', [])) || $surveyReport->survey_attributes->contains($id)) ? 'selected' : '' }}>{{ $survey_attribute }}</option>
                    @endforeach
                </select>
                @if($errors->has('survey_attributes'))
                    <div class="invalid-feedback">
                        {{ $errors->first('survey_attributes') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.surveyReport.fields.survey_attributes_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="submited_by_id">{{ trans('cruds.surveyReport.fields.submited_by') }}</label>
                <select class="form-control select2 {{ $errors->has('submited_by') ? 'is-invalid' : '' }}" name="submited_by_id" id="submited_by_id" required>
                    @foreach($submited_bies as $id => $entry)
                        <option value="{{ $id }}" {{ (old('submited_by_id') ? old('submited_by_id') : $surveyReport->submited_by->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('submited_by'))
                    <div class="invalid-feedback">
                        {{ $errors->first('submited_by') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.surveyReport.fields.submited_by_helper') }}</span>
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