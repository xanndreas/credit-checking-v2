@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.requestCreditAttribute.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.request-credit-attributes.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.requestCreditAttribute.fields.id') }}
                        </th>
                        <td>
                            {{ $requestCreditAttribute->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.requestCreditAttribute.fields.object_name') }}
                        </th>
                        <td>
                            {{ $requestCreditAttribute->object_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.requestCreditAttribute.fields.attribute') }}
                        </th>
                        <td>
                            {{ $requestCreditAttribute->attribute }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.requestCreditAttribute.fields.attribute_2') }}
                        </th>
                        <td>
                            {{ $requestCreditAttribute->attribute_2 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.requestCreditAttribute.fields.attribute_3') }}
                        </th>
                        <td>
                            {{ $requestCreditAttribute->attribute_3 }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.request-credit-attributes.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection