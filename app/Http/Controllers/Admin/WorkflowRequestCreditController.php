<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyWorkflowRequestCreditRequest;
use App\Http\Requests\StoreWorkflowRequestCreditRequest;
use App\Http\Requests\UpdateWorkflowRequestCreditRequest;
use App\Models\RequestCredit;
use App\Models\User;
use App\Models\WorkflowProcess;
use App\Models\WorkflowRequestCredit;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class WorkflowRequestCreditController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('workflow_request_credit_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = WorkflowRequestCredit::with(['request_credit', 'last_change_by', 'process_status'])->select(sprintf('%s.*', (new WorkflowRequestCredit)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'workflow_request_credit_show';
                $editGate      = 'workflow_request_credit_edit';
                $deleteGate    = 'workflow_request_credit_delete';
                $crudRoutePart = 'workflow-request-credits';

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
            $table->editColumn('request_credit_batch', function ($row) {
                return $row->request_credit_batch ? $row->request_credit_batch : '';
            });
            $table->addColumn('request_credit_batch_number', function ($row) {
                return $row->request_credit ? $row->request_credit->batch_number : '';
            });

            $table->addColumn('last_change_by_name', function ($row) {
                return $row->last_change_by ? $row->last_change_by->name : '';
            });

            $table->addColumn('process_status_process_status', function ($row) {
                return $row->process_status ? $row->process_status->process_status : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'request_credit', 'last_change_by', 'process_status']);

            return $table->make(true);
        }

        $request_credits    = RequestCredit::get();
        $users              = User::get();
        $workflow_processes = WorkflowProcess::get();

        return view('admin.workflowRequestCredits.index', compact('request_credits', 'users', 'workflow_processes'));
    }

    public function create()
    {
        abort_if(Gate::denies('workflow_request_credit_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $request_credits = RequestCredit::pluck('batch_number', 'id')->prepend(trans('global.pleaseSelect'), '');

        $last_change_bies = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $process_statuses = WorkflowProcess::pluck('process_status', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.workflowRequestCredits.create', compact('last_change_bies', 'process_statuses', 'request_credits'));
    }

    public function store(StoreWorkflowRequestCreditRequest $request)
    {
        $workflowRequestCredit = WorkflowRequestCredit::create($request->all());

        return redirect()->route('admin.workflow-request-credits.index');
    }

    public function edit(WorkflowRequestCredit $workflowRequestCredit)
    {
        abort_if(Gate::denies('workflow_request_credit_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $request_credits = RequestCredit::pluck('batch_number', 'id')->prepend(trans('global.pleaseSelect'), '');

        $last_change_bies = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $process_statuses = WorkflowProcess::pluck('process_status', 'id')->prepend(trans('global.pleaseSelect'), '');

        $workflowRequestCredit->load('request_credit', 'last_change_by', 'process_status');

        return view('admin.workflowRequestCredits.edit', compact('last_change_bies', 'process_statuses', 'request_credits', 'workflowRequestCredit'));
    }

    public function update(UpdateWorkflowRequestCreditRequest $request, WorkflowRequestCredit $workflowRequestCredit)
    {
        $workflowRequestCredit->update($request->all());

        return redirect()->route('admin.workflow-request-credits.index');
    }

    public function show(WorkflowRequestCredit $workflowRequestCredit)
    {
        abort_if(Gate::denies('workflow_request_credit_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $workflowRequestCredit->load('request_credit', 'last_change_by', 'process_status');

        return view('admin.workflowRequestCredits.show', compact('workflowRequestCredit'));
    }

    public function destroy(WorkflowRequestCredit $workflowRequestCredit)
    {
        abort_if(Gate::denies('workflow_request_credit_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $workflowRequestCredit->delete();

        return back();
    }

    public function massDestroy(MassDestroyWorkflowRequestCreditRequest $request)
    {
        $workflowRequestCredits = WorkflowRequestCredit::find(request('ids'));

        foreach ($workflowRequestCredits as $workflowRequestCredit) {
            $workflowRequestCredit->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
