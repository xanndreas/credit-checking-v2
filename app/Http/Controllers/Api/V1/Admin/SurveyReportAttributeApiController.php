<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSurveyReportAttributeRequest;
use App\Http\Requests\UpdateSurveyReportAttributeRequest;
use App\Http\Resources\Admin\SurveyReportAttributeResource;
use App\Models\SurveyReportAttribute;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SurveyReportAttributeApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('survey_report_attribute_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SurveyReportAttributeResource(SurveyReportAttribute::all());
    }

    public function store(StoreSurveyReportAttributeRequest $request)
    {
        $surveyReportAttribute = SurveyReportAttribute::create($request->all());

        return (new SurveyReportAttributeResource($surveyReportAttribute))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(SurveyReportAttribute $surveyReportAttribute)
    {
        abort_if(Gate::denies('survey_report_attribute_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SurveyReportAttributeResource($surveyReportAttribute);
    }

    public function update(UpdateSurveyReportAttributeRequest $request, SurveyReportAttribute $surveyReportAttribute)
    {
        $surveyReportAttribute->update($request->all());

        return (new SurveyReportAttributeResource($surveyReportAttribute))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(SurveyReportAttribute $surveyReportAttribute)
    {
        abort_if(Gate::denies('survey_report_attribute_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $surveyReportAttribute->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
