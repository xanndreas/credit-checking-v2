@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.requestCredit.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.request-credits.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.requestCredit.fields.id') }}
                        </th>
                        <td>
                            {{ $requestCredit->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.requestCredit.fields.batch_number') }}
                        </th>
                        <td>
                            {{ $requestCredit->batch_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.requestCredit.fields.credit_type') }}
                        </th>
                        <td>
                            {{ App\Models\RequestCredit::CREDIT_TYPE_SELECT[$requestCredit->credit_type] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.requestCredit.fields.auto_planner') }}
                        </th>
                        <td>
                            {{ $requestCredit->auto_planner->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.requestCredit.fields.request_debtor') }}
                        </th>
                        <td>
                            @foreach($requestCredit->request_debtors as $key => $request_debtor)
                                <span class="label label-info">{{ $request_debtor->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.requestCredit.fields.request_attribute') }}
                        </th>
                        <td>
                            @foreach($requestCredit->request_attributes as $key => $request_attribute)
                                <span class="label label-info">{{ $request_attribute->object_name }}</span>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.request-credits.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection