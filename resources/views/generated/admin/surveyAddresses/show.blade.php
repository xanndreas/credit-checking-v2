@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.surveyAddress.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.survey-addresses.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.surveyAddress.fields.id') }}
                        </th>
                        <td>
                            {{ $surveyAddress->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.surveyAddress.fields.request_credit') }}
                        </th>
                        <td>
                            {{ $surveyAddress->request_credit->batch_number ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.surveyAddress.fields.address_type') }}
                        </th>
                        <td>
                            {{ App\Models\SurveyAddress::ADDRESS_TYPE_SELECT[$surveyAddress->address_type] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.surveyAddress.fields.addresses') }}
                        </th>
                        <td>
                            {{ $surveyAddress->addresses }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.surveyAddress.fields.surveyor') }}
                        </th>
                        <td>
                            {{ $surveyAddress->surveyor->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.survey-addresses.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection