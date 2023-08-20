@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.surveyReport.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.survey-reports.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.surveyReport.fields.id') }}
                        </th>
                        <td>
                            {{ $surveyReport->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.surveyReport.fields.request_credit') }}
                        </th>
                        <td>
                            {{ $surveyReport->request_credit->batch_number ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.surveyReport.fields.survey_address') }}
                        </th>
                        <td>
                            {{ $surveyReport->survey_address->address_type ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.surveyReport.fields.survey_attributes') }}
                        </th>
                        <td>
                            @foreach($surveyReport->survey_attributes as $key => $survey_attributes)
                                <span class="label label-info">{{ $survey_attributes->object_name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.surveyReport.fields.submited_by') }}
                        </th>
                        <td>
                            {{ $surveyReport->submited_by->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.survey-reports.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection