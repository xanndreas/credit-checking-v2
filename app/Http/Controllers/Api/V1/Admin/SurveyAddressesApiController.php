<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSurveyAddressRequest;
use App\Http\Requests\UpdateSurveyAddressRequest;
use App\Http\Resources\Admin\SurveyAddressResource;
use App\Models\SurveyAddress;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SurveyAddressesApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('survey_address_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SurveyAddressResource(SurveyAddress::with(['request_credit', 'surveyor'])->get());
    }

    public function store(StoreSurveyAddressRequest $request)
    {
        $surveyAddress = SurveyAddress::create($request->all());

        return (new SurveyAddressResource($surveyAddress))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(SurveyAddress $surveyAddress)
    {
        abort_if(Gate::denies('survey_address_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SurveyAddressResource($surveyAddress->load(['request_credit', 'surveyor']));
    }

    public function update(UpdateSurveyAddressRequest $request, SurveyAddress $surveyAddress)
    {
        $surveyAddress->update($request->all());

        return (new SurveyAddressResource($surveyAddress))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(SurveyAddress $surveyAddress)
    {
        abort_if(Gate::denies('survey_address_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $surveyAddress->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
