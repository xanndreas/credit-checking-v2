{{--@dd($surveyReports)--}}
@can('survey_report_create')
    @if($surveyReports)
        <a href="{{ route('admin.survey-reports.download', ['surveyAddress' => $surveyReports->survey_address_id]) }}"
           class="btn btn-icon btn-label-success waves-effect">
            <span class="ti ti-download"></span>
        </a>
    @else
        <a href="{{ route('admin.survey-reports.create', ['surveyAddress' => $row->id]) }}"
           class="btn btn-icon btn-label-primary waves-effect">
            <span class="ti ti-pencil"></span>
        </a>
    @endif
@endcan

@can('survey_report_show')
    @if($surveyReports)
        <a href="{{ route('admin.survey-reports.download', ['surveyAddress' => $surveyReports->survey_address_id]) }}"
           class="btn btn-icon btn-label-success waves-effect">
            <span class="ti ti-download"></span>
        </a>
    @else
        <button class="btn btn-label-warning waves-effect" disabled>
            Waiting
        </button>
    @endif
@endcan
