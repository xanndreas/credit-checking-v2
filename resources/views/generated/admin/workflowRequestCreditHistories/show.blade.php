@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.workflowRequestCreditHistory.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.workflow-request-credit-histories.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.workflowRequestCreditHistory.fields.id') }}
                        </th>
                        <td>
                            {{ $workflowRequestCreditHistory->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.workflowRequestCreditHistory.fields.workflow_request_credit') }}
                        </th>
                        <td>
                            {{ $workflowRequestCreditHistory->workflow_request_credit->request_credit_batch ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.workflowRequestCreditHistory.fields.actor') }}
                        </th>
                        <td>
                            {{ $workflowRequestCreditHistory->actor->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.workflowRequestCreditHistory.fields.process_status') }}
                        </th>
                        <td>
                            {{ $workflowRequestCreditHistory->process_status }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.workflowRequestCreditHistory.fields.process_notes') }}
                        </th>
                        <td>
                            {{ $workflowRequestCreditHistory->process_notes }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.workflowRequestCreditHistory.fields.attribute') }}
                        </th>
                        <td>
                            {{ $workflowRequestCreditHistory->attribute }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.workflowRequestCreditHistory.fields.attribute_2') }}
                        </th>
                        <td>
                            {{ $workflowRequestCreditHistory->attribute_2 }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.workflow-request-credit-histories.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection