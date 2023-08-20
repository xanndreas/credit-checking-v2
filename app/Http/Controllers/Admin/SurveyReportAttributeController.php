<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroySurveyReportAttributeRequest;
use App\Http\Requests\StoreSurveyReportAttributeRequest;
use App\Http\Requests\UpdateSurveyReportAttributeRequest;
use App\Models\SurveyReportAttribute;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class SurveyReportAttributeController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('survey_report_attribute_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = SurveyReportAttribute::query()->select(sprintf('%s.*', (new SurveyReportAttribute)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'survey_report_attribute_show';
                $editGate      = 'survey_report_attribute_edit';
                $deleteGate    = 'survey_report_attribute_delete';
                $crudRoutePart = 'survey-report-attributes';

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
            $table->editColumn('object_name', function ($row) {
                return $row->object_name ? $row->object_name : '';
            });
            $table->editColumn('attribute', function ($row) {
                return $row->attribute ? $row->attribute : '';
            });
            $table->editColumn('attribute_2', function ($row) {
                return $row->attribute_2 ? $row->attribute_2 : '';
            });
            $table->editColumn('attribute_3', function ($row) {
                return $row->attribute_3 ? $row->attribute_3 : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.surveyReportAttributes.index');
    }

    public function create()
    {
        abort_if(Gate::denies('survey_report_attribute_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.surveyReportAttributes.create');
    }

    public function store(StoreSurveyReportAttributeRequest $request)
    {
        $surveyReportAttribute = SurveyReportAttribute::create($request->all());

        return redirect()->route('admin.survey-report-attributes.index');
    }

    public function edit(SurveyReportAttribute $surveyReportAttribute)
    {
        abort_if(Gate::denies('survey_report_attribute_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.surveyReportAttributes.edit', compact('surveyReportAttribute'));
    }

    public function update(UpdateSurveyReportAttributeRequest $request, SurveyReportAttribute $surveyReportAttribute)
    {
        $surveyReportAttribute->update($request->all());

        return redirect()->route('admin.survey-report-attributes.index');
    }

    public function show(SurveyReportAttribute $surveyReportAttribute)
    {
        abort_if(Gate::denies('survey_report_attribute_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.surveyReportAttributes.show', compact('surveyReportAttribute'));
    }

    public function destroy(SurveyReportAttribute $surveyReportAttribute)
    {
        abort_if(Gate::denies('survey_report_attribute_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $surveyReportAttribute->delete();

        return back();
    }

    public function massDestroy(MassDestroySurveyReportAttributeRequest $request)
    {
        $surveyReportAttributes = SurveyReportAttribute::find(request('ids'));

        foreach ($surveyReportAttributes as $surveyReportAttribute) {
            $surveyReportAttribute->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
