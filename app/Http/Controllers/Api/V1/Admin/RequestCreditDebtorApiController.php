<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRequestCreditDebtorRequest;
use App\Http\Requests\UpdateRequestCreditDebtorRequest;
use App\Http\Resources\Admin\RequestCreditDebtorResource;
use App\Models\RequestCreditDebtor;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RequestCreditDebtorApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('request_credit_debtor_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new RequestCreditDebtorResource(RequestCreditDebtor::all());
    }

    public function store(StoreRequestCreditDebtorRequest $request)
    {
        $requestCreditDebtor = RequestCreditDebtor::create($request->all());

        return (new RequestCreditDebtorResource($requestCreditDebtor))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(RequestCreditDebtor $requestCreditDebtor)
    {
        abort_if(Gate::denies('request_credit_debtor_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new RequestCreditDebtorResource($requestCreditDebtor);
    }

    public function update(UpdateRequestCreditDebtorRequest $request, RequestCreditDebtor $requestCreditDebtor)
    {
        $requestCreditDebtor->update($request->all());

        return (new RequestCreditDebtorResource($requestCreditDebtor))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(RequestCreditDebtor $requestCreditDebtor)
    {
        abort_if(Gate::denies('request_credit_debtor_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $requestCreditDebtor->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
