<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSurveyReportRequest;
use App\Http\Requests\UpdateSurveyReportRequest;
use App\Http\Resources\Admin\SurveyReportResource;
use App\Models\SurveyReport;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SurveyReportApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('survey_report_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SurveyReportResource(SurveyReport::with(['request_credit', 'survey_address', 'survey_attributes', 'submited_by'])->get());
    }

    public function store(StoreSurveyReportRequest $request)
    {
        $surveyReport = SurveyReport::create($request->all());
        $surveyReport->survey_attributes()->sync($request->input('survey_attributes', []));

        return (new SurveyReportResource($surveyReport))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(SurveyReport $surveyReport)
    {
        abort_if(Gate::denies('survey_report_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SurveyReportResource($surveyReport->load(['request_credit', 'survey_address', 'survey_attributes', 'submited_by']));
    }

    public function update(UpdateSurveyReportRequest $request, SurveyReport $surveyReport)
    {
        $surveyReport->update($request->all());
        $surveyReport->survey_attributes()->sync($request->input('survey_attributes', []));

        return (new SurveyReportResource($surveyReport))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(SurveyReport $surveyReport)
    {
        abort_if(Gate::denies('survey_report_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $surveyReport->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
