<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWorkflowRequestCreditHistoryRequest;
use App\Http\Requests\UpdateWorkflowRequestCreditHistoryRequest;
use App\Http\Resources\Admin\WorkflowRequestCreditHistoryResource;
use App\Models\WorkflowRequestCreditHistory;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class WorkflowRequestCreditHistoryApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('workflow_request_credit_history_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new WorkflowRequestCreditHistoryResource(WorkflowRequestCreditHistory::with(['workflow_request_credit', 'actor'])->get());
    }

    public function store(StoreWorkflowRequestCreditHistoryRequest $request)
    {
        $workflowRequestCreditHistory = WorkflowRequestCreditHistory::create($request->all());

        return (new WorkflowRequestCreditHistoryResource($workflowRequestCreditHistory))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(WorkflowRequestCreditHistory $workflowRequestCreditHistory)
    {
        abort_if(Gate::denies('workflow_request_credit_history_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new WorkflowRequestCreditHistoryResource($workflowRequestCreditHistory->load(['workflow_request_credit', 'actor']));
    }

    public function update(UpdateWorkflowRequestCreditHistoryRequest $request, WorkflowRequestCreditHistory $workflowRequestCreditHistory)
    {
        $workflowRequestCreditHistory->update($request->all());

        return (new WorkflowRequestCreditHistoryResource($workflowRequestCreditHistory))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(WorkflowRequestCreditHistory $workflowRequestCreditHistory)
    {
        abort_if(Gate::denies('workflow_request_credit_history_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $workflowRequestCreditHistory->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
