@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.workflowProcess.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.workflow-processes.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.workflowProcess.fields.id') }}
                        </th>
                        <td>
                            {{ $workflowProcess->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.workflowProcess.fields.process_status') }}
                        </th>
                        <td>
                            {{ $workflowProcess->process_status }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.workflowProcess.fields.description') }}
                        </th>
                        <td>
                            {{ $workflowProcess->description }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.workflow-processes.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection