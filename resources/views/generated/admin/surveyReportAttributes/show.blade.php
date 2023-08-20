@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.surveyReportAttribute.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.survey-report-attributes.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.surveyReportAttribute.fields.id') }}
                        </th>
                        <td>
                            {{ $surveyReportAttribute->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.surveyReportAttribute.fields.object_name') }}
                        </th>
                        <td>
                            {{ $surveyReportAttribute->object_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.surveyReportAttribute.fields.attribute') }}
                        </th>
                        <td>
                            {{ $surveyReportAttribute->attribute }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.surveyReportAttribute.fields.attribute_2') }}
                        </th>
                        <td>
                            {{ $surveyReportAttribute->attribute_2 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.surveyReportAttribute.fields.attribute_3') }}
                        </th>
                        <td>
                            {{ $surveyReportAttribute->attribute_3 }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.survey-report-attributes.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection