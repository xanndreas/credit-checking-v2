<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRequestCreditHelpRequest;
use App\Http\Requests\UpdateRequestCreditHelpRequest;
use App\Http\Resources\Admin\RequestCreditHelpResource;
use App\Models\RequestCreditHelp;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RequestCreditHelpApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('request_credit_help_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new RequestCreditHelpResource(RequestCreditHelp::all());
    }

    public function store(StoreRequestCreditHelpRequest $request)
    {
        $requestCreditHelp = RequestCreditHelp::create($request->all());

        return (new RequestCreditHelpResource($requestCreditHelp))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(RequestCreditHelp $requestCreditHelp)
    {
        abort_if(Gate::denies('request_credit_help_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new RequestCreditHelpResource($requestCreditHelp);
    }

    public function update(UpdateRequestCreditHelpRequest $request, RequestCreditHelp $requestCreditHelp)
    {
        $requestCreditHelp->update($request->all());

        return (new RequestCreditHelpResource($requestCreditHelp))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(RequestCreditHelp $requestCreditHelp)
    {
        abort_if(Gate::denies('request_credit_help_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $requestCreditHelp->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
