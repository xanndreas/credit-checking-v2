<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRequestCreditAttributeRequest;
use App\Http\Requests\UpdateRequestCreditAttributeRequest;
use App\Http\Resources\Admin\RequestCreditAttributeResource;
use App\Models\RequestCreditAttribute;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RequestCreditAttributeApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('request_credit_attribute_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new RequestCreditAttributeResource(RequestCreditAttribute::all());
    }

    public function store(StoreRequestCreditAttributeRequest $request)
    {
        $requestCreditAttribute = RequestCreditAttribute::create($request->all());

        return (new RequestCreditAttributeResource($requestCreditAttribute))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(RequestCreditAttribute $requestCreditAttribute)
    {
        abort_if(Gate::denies('request_credit_attribute_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new RequestCreditAttributeResource($requestCreditAttribute);
    }

    public function update(UpdateRequestCreditAttributeRequest $request, RequestCreditAttribute $requestCreditAttribute)
    {
        $requestCreditAttribute->update($request->all());

        return (new RequestCreditAttributeResource($requestCreditAttribute))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(RequestCreditAttribute $requestCreditAttribute)
    {
        abort_if(Gate::denies('request_credit_attribute_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $requestCreditAttribute->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
