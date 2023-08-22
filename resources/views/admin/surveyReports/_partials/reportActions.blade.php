@can('survey_report_create')
    @if($surveyReports)
        <a href="{{ route('admin.surveys.reports.download', ['survey' => $surveyReports->survey_id]) }}" class="btn btn-icon btn-label-secondary waves-effect">
            <span class="ti ti-download"></span>
        </a>
    @else
        <a href="{{ route('admin.surveys.reports.create', ['survey' => $survey->id]) }}" class="btn btn-icon btn-label-primary waves-effect">
            <span class="ti ti-pencil"></span>
        </a>
    @endif
@endcan

@can('survey_report_show')
    @if($surveyReports)
        <a href="{{ route('admin.surveys.reports.download', ['survey' => $surveyReports->survey_id]) }}" class="btn btn-icon btn-label-secondary waves-effect">
            <button type="button" class="btn btn-icon btn-label-secondary waves-effect">
                <span class="ti ti-download"></span>
            </button>
        </a>
    @else
        <button class="badge bg-label-warning" disabled>
            Waiting
        </button>
    @endif
@endcan
