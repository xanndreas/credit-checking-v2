@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.workflowProcess.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.workflow-processes.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="process_status">{{ trans('cruds.workflowProcess.fields.process_status') }}</label>
                <input class="form-control {{ $errors->has('process_status') ? 'is-invalid' : '' }}" type="text" name="process_status" id="process_status" value="{{ old('process_status', '') }}" required>
                @if($errors->has('process_status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('process_status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.workflowProcess.fields.process_status_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.workflowProcess.fields.description') }}</label>
                <input class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" type="text" name="description" id="description" value="{{ old('description', '') }}">
                @if($errors->has('description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.workflowProcess.fields.description_helper') }}</span>
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