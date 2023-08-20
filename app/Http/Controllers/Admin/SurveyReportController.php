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
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class SurveyReportController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('survey_report_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = SurveyReport::with(['request_credit', 'survey_address', 'survey_attributes', 'submited_by'])->select(sprintf('%s.*', (new SurveyReport)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'survey_report_show';
                $editGate = 'survey_report_edit';
                $deleteGate = 'survey_report_delete';
                $crudRoutePart = 'survey-reports';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->addColumn('request_credit_batch_number', function ($row) {
                return $row->request_credit ? $row->request_credit->batch_number : '';
            });

            $table->addColumn('survey_address_address_type', function ($row) {
                return $row->survey_address ? $row->survey_address->address_type : '';
            });

            $table->editColumn('survey_attributes', function ($row) {
                $labels = [];
                foreach ($row->survey_attributes as $survey_attribute) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $survey_attribute->object_name);
                }

                return implode(' ', $labels);
            });
            $table->addColumn('submited_by_name', function ($row) {
                return $row->submited_by ? $row->submited_by->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'request_credit', 'survey_address', 'survey_attributes', 'submited_by']);

            return $table->make(true);
        }

        $request_credits = RequestCredit::get();
        $survey_addresses = SurveyAddress::get();
        $survey_report_attributes = SurveyReportAttribute::get();
        $users = User::get();

        return view('admin.surveyReports.index', compact('request_credits', 'survey_addresses', 'survey_report_attributes', 'users'));
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
