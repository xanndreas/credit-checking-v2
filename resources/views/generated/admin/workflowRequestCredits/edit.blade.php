@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.workflowRequestCredit.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.workflow-request-credits.update", [$workflowRequestCredit->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="request_credit_batch">{{ trans('cruds.workflowRequestCredit.fields.request_credit_batch') }}</label>
                <input class="form-control {{ $errors->has('request_credit_batch') ? 'is-invalid' : '' }}" type="text" name="request_credit_batch" id="request_credit_batch" value="{{ old('request_credit_batch', $workflowRequestCredit->request_credit_batch) }}" required>
                @if($errors->has('request_credit_batch'))
                    <div class="invalid-feedback">
                        {{ $errors->first('request_credit_batch') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.workflowRequestCredit.fields.request_credit_batch_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="request_credit_id">{{ trans('cruds.workflowRequestCredit.fields.request_credit') }}</label>
                <select class="form-control select2 {{ $errors->has('request_credit') ? 'is-invalid' : '' }}" name="request_credit_id" id="request_credit_id" required>
                    @foreach($request_credits as $id => $entry)
                        <option value="{{ $id }}" {{ (old('request_credit_id') ? old('request_credit_id') : $workflowRequestCredit->request_credit->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('request_credit'))
                    <div class="invalid-feedback">
                        {{ $errors->first('request_credit') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.workflowRequestCredit.fields.request_credit_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="last_change_by_id">{{ trans('cruds.workflowRequestCredit.fields.last_change_by') }}</label>
                <select class="form-control select2 {{ $errors->has('last_change_by') ? 'is-invalid' : '' }}" name="last_change_by_id" id="last_change_by_id">
                    @foreach($last_change_bies as $id => $entry)
                        <option value="{{ $id }}" {{ (old('last_change_by_id') ? old('last_change_by_id') : $workflowRequestCredit->last_change_by->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('last_change_by'))
                    <div class="invalid-feedback">
                        {{ $errors->first('last_change_by') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.workflowRequestCredit.fields.last_change_by_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="process_status_id">{{ trans('cruds.workflowRequestCredit.fields.process_status') }}</label>
                <select class="form-control select2 {{ $errors->has('process_status') ? 'is-invalid' : '' }}" name="process_status_id" id="process_status_id" required>
                    @foreach($process_statuses as $id => $entry)
                        <option value="{{ $id }}" {{ (old('process_status_id') ? old('process_status_id') : $workflowRequestCredit->process_status->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('process_status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('process_status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.workflowRequestCredit.fields.process_status_helper') }}</span>
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