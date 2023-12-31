{{--@dd($surveyReports)--}}
@can('survey_report_create')
    @if(!$surveyReports)
        @if($row->remarks != null)
            @if($workflowRequestCredit->process_status->process_status == 'survey_process')
                <a href="{{ route('admin.survey-reports.create', ['surveyAddress' => $row->id]) }}"
                   class="btn btn-icon btn-label-primary waves-effect">
                    <span class="ti ti-pencil"></span>
                </a>
            @endif
        @else
            <button type="button" class="btn btn-icon btn-label-success waves-effect btn-remarks-update" data-bs-toggle="modal"
                    data-bs-target="#remarksUpdateModal">
                <i class="tf-icons ti ti-clipboard"></i>
            </button>
        @endif
    @endif
@endcan

@can('survey_report_show')
    @if($surveyReports)
        <a href="{{ route('admin.survey-reports.download', ['surveyAddress' => $surveyReports->survey_address_id]) }}"
           class="btn btn-icon btn-label-success waves-effect">
            <span class="ti ti-download"></span>
        </a>
    @else
        @if($workflowRequestCredit->process_status->process_status !== 'survey_process')
            <button class="btn btn-label-warning waves-effect" disabled>
                Waiting
            </button>
        @endif
    @endif
@endcan
