<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyWorkflowProcessRequest;
use App\Http\Requests\StoreWorkflowProcessRequest;
use App\Http\Requests\UpdateWorkflowProcessRequest;
use App\Models\WorkflowProcess;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class WorkflowProcessController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('workflow_process_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = WorkflowProcess::query()->select(sprintf('%s.*', (new WorkflowProcess)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'workflow_process_show';
                $editGate      = 'workflow_process_edit';
                $deleteGate    = 'workflow_process_delete';
                $crudRoutePart = 'workflow-processes';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('process_status', function ($row) {
                return $row->process_status ? $row->process_status : '';
            });
            $table->editColumn('description', function ($row) {
                return $row->description ? $row->description : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.workflowProcesses.index');
    }

    public function create()
    {
        abort_if(Gate::denies('workflow_process_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.workflowProcesses.create');
    }

    public function store(StoreWorkflowProcessRequest $request)
    {
        $workflowProcess = WorkflowProcess::create($request->all());

        return redirect()->route('admin.workflow-processes.index');
    }

    public function edit(WorkflowProcess $workflowProcess)
    {
        abort_if(Gate::denies('workflow_process_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.workflowProcesses.edit', compact('workflowProcess'));
    }

    public function update(UpdateWorkflowProcessRequest $request, WorkflowProcess $workflowProcess)
    {
        $workflowProcess->update($request->all());

        return redirect()->route('admin.workflow-processes.index');
    }

    public function show(WorkflowProcess $workflowProcess)
    {
        abort_if(Gate::denies('workflow_process_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.workflowProcesses.show', compact('workflowProcess'));
    }

    public function destroy(WorkflowProcess $workflowProcess)
    {
        abort_if(Gate::denies('workflow_process_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $workflowProcess->delete();

        return back();
    }

    public function massDestroy(MassDestroyWorkflowProcessRequest $request)
    {
        $workflowProcesses = WorkflowProcess::find(request('ids'));

        foreach ($workflowProcesses as $workflowProcess) {
            $workflowProcess->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
