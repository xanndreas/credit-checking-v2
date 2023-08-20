@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.workflowRequestCreditHistory.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.workflow-request-credit-histories.update", [$workflowRequestCreditHistory->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="workflow_request_credit_id">{{ trans('cruds.workflowRequestCreditHistory.fields.workflow_request_credit') }}</label>
                <select class="form-control select2 {{ $errors->has('workflow_request_credit') ? 'is-invalid' : '' }}" name="workflow_request_credit_id" id="workflow_request_credit_id" required>
                    @foreach($workflow_request_credits as $id => $entry)
                        <option value="{{ $id }}" {{ (old('workflow_request_credit_id') ? old('workflow_request_credit_id') : $workflowRequestCreditHistory->workflow_request_credit->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('workflow_request_credit'))
                    <div class="invalid-feedback">
                        {{ $errors->first('workflow_request_credit') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.workflowRequestCreditHistory.fields.workflow_request_credit_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="actor_id">{{ trans('cruds.workflowRequestCreditHistory.fields.actor') }}</label>
                <select class="form-control select2 {{ $errors->has('actor') ? 'is-invalid' : '' }}" name="actor_id" id="actor_id" required>
                    @foreach($actors as $id => $entry)
                        <option value="{{ $id }}" {{ (old('actor_id') ? old('actor_id') : $workflowRequestCreditHistory->actor->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('actor'))
                    <div class="invalid-feedback">
                        {{ $errors->first('actor') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.workflowRequestCreditHistory.fields.actor_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="process_status">{{ trans('cruds.workflowRequestCreditHistory.fields.process_status') }}</label>
                <input class="form-control {{ $errors->has('process_status') ? 'is-invalid' : '' }}" type="text" name="process_status" id="process_status" value="{{ old('process_status', $workflowRequestCreditHistory->process_status) }}" required>
                @if($errors->has('process_status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('process_status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.workflowRequestCreditHistory.fields.process_status_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="process_notes">{{ trans('cruds.workflowRequestCreditHistory.fields.process_notes') }}</label>
                <input class="form-control {{ $errors->has('process_notes') ? 'is-invalid' : '' }}" type="text" name="process_notes" id="process_notes" value="{{ old('process_notes', $workflowRequestCreditHistory->process_notes) }}">
                @if($errors->has('process_notes'))
                    <div class="invalid-feedback">
                        {{ $errors->first('process_notes') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.workflowRequestCreditHistory.fields.process_notes_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="attribute">{{ trans('cruds.workflowRequestCreditHistory.fields.attribute') }}</label>
                <input class="form-control {{ $errors->has('attribute') ? 'is-invalid' : '' }}" type="text" name="attribute" id="attribute" value="{{ old('attribute', $workflowRequestCreditHistory->attribute) }}">
                @if($errors->has('attribute'))
                    <div class="invalid-feedback">
                        {{ $errors->first('attribute') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.workflowRequestCreditHistory.fields.attribute_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="attribute_2">{{ trans('cruds.workflowRequestCreditHistory.fields.attribute_2') }}</label>
                <input class="form-control {{ $errors->has('attribute_2') ? 'is-invalid' : '' }}" type="text" name="attribute_2" id="attribute_2" value="{{ old('attribute_2', $workflowRequestCreditHistory->attribute_2) }}">
                @if($errors->has('attribute_2'))
                    <div class="invalid-feedback">
                        {{ $errors->first('attribute_2') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.workflowRequestCreditHistory.fields.attribute_2_helper') }}</span>
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