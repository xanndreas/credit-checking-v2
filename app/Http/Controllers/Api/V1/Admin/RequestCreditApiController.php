<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRequestCreditRequest;
use App\Http\Requests\UpdateRequestCreditRequest;
use App\Http\Resources\Admin\RequestCreditResource;
use App\Models\RequestCredit;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RequestCreditApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('request_credit_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new RequestCreditResource(RequestCredit::with(['auto_planner', 'request_debtors', 'request_attributes'])->get());
    }

    public function store(StoreRequestCreditRequest $request)
    {
        $requestCredit = RequestCredit::create($request->all());
        $requestCredit->request_debtors()->sync($request->input('request_debtors', []));
        $requestCredit->request_attributes()->sync($request->input('request_attributes', []));

        return (new RequestCreditResource($requestCredit))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(RequestCredit $requestCredit)
    {
        abort_if(Gate::denies('request_credit_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new RequestCreditResource($requestCredit->load(['auto_planner', 'request_debtors', 'request_attributes']));
    }

    public function update(UpdateRequestCreditRequest $request, RequestCredit $requestCredit)
    {
        $requestCredit->update($request->all());
        $requestCredit->request_debtors()->sync($request->input('request_debtors', []));
        $requestCredit->request_attributes()->sync($request->input('request_attributes', []));

        return (new RequestCreditResource($requestCredit))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(RequestCredit $requestCredit)
    {
        abort_if(Gate::denies('request_credit_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $requestCredit->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
