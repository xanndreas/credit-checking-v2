<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroySurveyReportRequest;
use App\Http\Requests\StoreSurveyReportRequest;
use App\Http\Requests\UpdateSurveyReportRequest;
use App\Models\RequestCredit;
use App\Models\SurveyAddress;
use App\Models\SurveyReport;
use App\Models\SurveyReportAttribute;
use App\Models\User;
use App\Models\WorkflowRequestCredit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class SurveyReportController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('survey_report_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = RequestCredit::with(['auto_planner', 'request_debtors', 'request_attributes']);

            if (Gate::allows('actor_auto_planner_access')) {
                $query->whereRelation('auto_planner', 'id', Auth::id());

                $requestCreditOnSurvey = WorkflowRequestCredit::with('request_credit', 'process_status')
                    ->whereRelation('process_status', 'process_status', 'survey_process')
                    ->whereRelation('process_status', 'process_status', 'survey_report')
                    ->get()->pluck('request_credit_id');

                $query->whereIn('id', $requestCreditOnSurvey);
            } else if (Gate::allows('request_credit_super') || Gate::allows('actor_surveyor_admin_access')) {
                // do nothing
            } else {
                $child = $this->tenantChildUser(User::with('roles')
                    ->find(Auth::id())->firstOrFail());

                $query->whereHas('auto_planner',
                    fn($q) => $q->whereIn('id', $child == null ? [] : $child));
            }

            $query->select(sprintf('%s.*', (new RequestCredit)->table));

            $table = Datatables::eloquent($query);
            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

//            $table->editColumn('actions', function ($row) {
//                $survey = $row;
//                $surveyReports = SurveyReport::with('request_credit', 'surveyor')
//                    ->where('survey_id', $row->id)->first();
//
//                return view('admin.surveys.reports._partials.reportActions', compact('surveyReports', 'survey'));
//            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });

            $table->editColumn('batch_number', function ($row) {
                return $row->batch_number ? $row->batch_number : '';
            });

            $table->editColumn('credit_type', function ($row) {
                return $row->credit_type ? RequestCredit::CREDIT_TYPE_SELECT[$row->credit_type] : '';
            });

            $table->addColumn('auto_planner_name', function ($row) {
                return $row->auto_planner ? $row->auto_planner->name : '';
            });

            $table->addColumn('workflow_status', function ($row) {
                $workflowRequestCredit = WorkflowRequestCredit::with('process_status')
                    ->where('request_credit_id', $row->id)->first();

                return $workflowRequestCredit->process_status ? $workflowRequestCredit->process_status->process_status : '';
            });

            $table->editColumn('request_debtor', function ($row) {
                $labels = [];
                foreach ($row->request_debtors as $request_debtor) {
                    $labels[] = sprintf('<span class="badge bg-secondary">%s</span>', $request_debtor->name);
                }

                return implode(' ', $labels);
            });

            $table->rawColumns(['actions', 'approvals', 'placeholder', 'auto_planner', 'request_debtor']);

            return $table->make(true);
        }

        return view('admin.surveyReports.index');
    }

    public function create()
    {
        abort_if(Gate::denies('survey_report_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $request_credits = RequestCredit::pluck('batch_number', 'id')->prepend(trans('global.pleaseSelect'), '');

        $survey_addresses = SurveyAddress::pluck('address_type', 'id')->prepend(trans('global.pleaseSelect'), '');

        $survey_attributes = SurveyReportAttribute::pluck('object_name', 'id');

        $submited_bies = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.surveyReports.create', compact('request_credits', 'submited_bies', 'survey_addresses', 'survey_attributes'));
    }

    public function store(StoreSurveyReportRequest $request)
    {
        $surveyReport = SurveyReport::create($request->all());
        $surveyReport->survey_attributes()->sync($request->input('survey_attributes', []));

        return redirect()->route('admin.survey-reports.index');
    }

    public function edit(SurveyReport $surveyReport)
    {
        abort_if(Gate::denies('survey_report_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $request_credits = RequestCredit::pluck('batch_number', 'id')->prepend(trans('global.pleaseSelect'), '');

        $survey_addresses = SurveyAddress::pluck('address_type', 'id')->prepend(trans('global.pleaseSelect'), '');

        $survey_attributes = SurveyReportAttribute::pluck('object_name', 'id');

        $submited_bies = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $surveyReport->load('request_credit', 'survey_address', 'survey_attributes', 'submited_by');

        return view('admin.surveyReports.edit', compact('request_credits', 'submited_bies', 'surveyReport', 'survey_addresses', 'survey_attributes'));
    }

    public function update(UpdateSurveyReportRequest $request, SurveyReport $surveyReport)
    {
        $surveyReport->update($request->all());
        $surveyReport->survey_attributes()->sync($request->input('survey_attributes', []));

        return redirect()->route('admin.survey-reports.index');
    }

    public function show(SurveyReport $surveyReport)
    {
        abort_if(Gate::denies('survey_report_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $surveyReport->load('request_credit', 'survey_address', 'survey_attributes', 'submited_by');

        return view('admin.surveyReports.show', compact('surveyReport'));
    }

    public function destroy(SurveyReport $surveyReport)
    {
        abort_if(Gate::denies('survey_report_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $surveyReport->delete();

        return back();
    }
}
