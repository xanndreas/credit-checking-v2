<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRequestApprovalRequest;
use App\Http\Requests\UpdateRequestApprovalRequest;
use App\Http\Resources\Admin\RequestApprovalResource;
use App\Models\RequestApproval;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RequestApprovalApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('request_approval_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new RequestApprovalResource(RequestApproval::all());
    }

    public function store(StoreRequestApprovalRequest $request)
    {
        $requestApproval = RequestApproval::create($request->all());

        return (new RequestApprovalResource($requestApproval))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(RequestApproval $requestApproval)
    {
        abort_if(Gate::denies('request_approval_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new RequestApprovalResource($requestApproval);
    }

    public function update(UpdateRequestApprovalRequest $request, RequestApproval $requestApproval)
    {
        $requestApproval->update($request->all());

        return (new RequestApprovalResource($requestApproval))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(RequestApproval $requestApproval)
    {
        abort_if(Gate::denies('request_approval_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $requestApproval->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
