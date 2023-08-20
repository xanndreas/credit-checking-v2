<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWorkflowProcessRequest;
use App\Http\Requests\UpdateWorkflowProcessRequest;
use App\Http\Resources\Admin\WorkflowProcessResource;
use App\Models\WorkflowProcess;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class WorkflowProcessApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('workflow_process_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new WorkflowProcessResource(WorkflowProcess::all());
    }

    public function store(StoreWorkflowProcessRequest $request)
    {
        $workflowProcess = WorkflowProcess::create($request->all());

        return (new WorkflowProcessResource($workflowProcess))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(WorkflowProcess $workflowProcess)
    {
        abort_if(Gate::denies('workflow_process_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new WorkflowProcessResource($workflowProcess);
    }

    public function update(UpdateWorkflowProcessRequest $request, WorkflowProcess $workflowProcess)
    {
        $workflowProcess->update($request->all());

        return (new WorkflowProcessResource($workflowProcess))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(WorkflowProcess $workflowProcess)
    {
        abort_if(Gate::denies('workflow_process_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $workflowProcess->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
