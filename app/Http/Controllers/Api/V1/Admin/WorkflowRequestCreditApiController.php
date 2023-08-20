<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWorkflowRequestCreditRequest;
use App\Http\Requests\UpdateWorkflowRequestCreditRequest;
use App\Http\Resources\Admin\WorkflowRequestCreditResource;
use App\Models\WorkflowRequestCredit;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class WorkflowRequestCreditApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('workflow_request_credit_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new WorkflowRequestCreditResource(WorkflowRequestCredit::with(['request_credit', 'last_change_by', 'process_status'])->get());
    }

    public function store(StoreWorkflowRequestCreditRequest $request)
    {
        $workflowRequestCredit = WorkflowRequestCredit::create($request->all());

        return (new WorkflowRequestCreditResource($workflowRequestCredit))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(WorkflowRequestCredit $workflowRequestCredit)
    {
        abort_if(Gate::denies('workflow_request_credit_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new WorkflowRequestCreditResource($workflowRequestCredit->load(['request_credit', 'last_change_by', 'process_status']));
    }

    public function update(UpdateWorkflowRequestCreditRequest $request, WorkflowRequestCredit $workflowRequestCredit)
    {
        $workflowRequestCredit->update($request->all());

        return (new WorkflowRequestCreditResource($workflowRequestCredit))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(WorkflowRequestCredit $workflowRequestCredit)
    {
        abort_if(Gate::denies('workflow_request_credit_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $workflowRequestCredit->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
