@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.requestCreditDebtor.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.request-credit-debtors.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.requestCreditDebtor.fields.id') }}
                        </th>
                        <td>
                            {{ $requestCreditDebtor->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.requestCreditDebtor.fields.personel_type') }}
                        </th>
                        <td>
                            {{ App\Models\RequestCreditDebtor::PERSONEL_TYPE_SELECT[$requestCreditDebtor->personel_type] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.requestCreditDebtor.fields.name') }}
                        </th>
                        <td>
                            {{ $requestCreditDebtor->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.requestCreditDebtor.fields.identity_type') }}
                        </th>
                        <td>
                            {{ App\Models\RequestCreditDebtor::IDENTITY_TYPE_SELECT[$requestCreditDebtor->identity_type] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.requestCreditDebtor.fields.identity_number') }}
                        </th>
                        <td>
                            {{ $requestCreditDebtor->identity_number }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.request-credit-debtors.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection