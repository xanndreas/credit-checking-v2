@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.workflowRequestCredit.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.workflow-request-credits.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.workflowRequestCredit.fields.id') }}
                        </th>
                        <td>
                            {{ $workflowRequestCredit->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.workflowRequestCredit.fields.request_credit_batch') }}
                        </th>
                        <td>
                            {{ $workflowRequestCredit->request_credit_batch }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.workflowRequestCredit.fields.request_credit') }}
                        </th>
                        <td>
                            {{ $workflowRequestCredit->request_credit->batch_number ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.workflowRequestCredit.fields.last_change_by') }}
                        </th>
                        <td>
                            {{ $workflowRequestCredit->last_change_by->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.workflowRequestCredit.fields.process_status') }}
                        </th>
                        <td>
                            {{ $workflowRequestCredit->process_status->process_status ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.workflow-request-credits.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection