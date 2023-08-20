<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyWorkflowRequestCreditHistoryRequest;
use App\Http\Requests\StoreWorkflowRequestCreditHistoryRequest;
use App\Http\Requests\UpdateWorkflowRequestCreditHistoryRequest;
use App\Models\User;
use App\Models\WorkflowRequestCredit;
use App\Models\WorkflowRequestCreditHistory;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class WorkflowRequestCreditHistoryController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('workflow_request_credit_history_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = WorkflowRequestCreditHistory::with(['workflow_request_credit', 'actor'])->select(sprintf('%s.*', (new WorkflowRequestCreditHistory)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'workflow_request_credit_history_show';
                $editGate      = 'workflow_request_credit_history_edit';
                $deleteGate    = 'workflow_request_credit_history_delete';
                $crudRoutePart = 'workflow-request-credit-histories';

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
            $table->addColumn('workflow_request_credit_request_credit_batch', function ($row) {
                return $row->workflow_request_credit ? $row->workflow_request_credit->request_credit_batch : '';
            });

            $table->addColumn('actor_name', function ($row) {
                return $row->actor ? $row->actor->name : '';
            });

            $table->editColumn('process_status', function ($row) {
                return $row->process_status ? $row->process_status : '';
            });
            $table->editColumn('process_notes', function ($row) {
                return $row->process_notes ? $row->process_notes : '';
            });
            $table->editColumn('attribute', function ($row) {
                return $row->attribute ? $row->attribute : '';
            });
            $table->editColumn('attribute_2', function ($row) {
                return $row->attribute_2 ? $row->attribute_2 : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'workflow_request_credit', 'actor']);

            return $table->make(true);
        }

        $workflow_request_credits = WorkflowRequestCredit::get();
        $users                    = User::get();

        return view('admin.workflowRequestCreditHistories.index', compact('workflow_request_credits', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('workflow_request_credit_history_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $workflow_request_credits = WorkflowRequestCredit::pluck('request_credit_batch', 'id')->prepend(trans('global.pleaseSelect'), '');

        $actors = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.workflowRequestCreditHistories.create', compact('actors', 'workflow_request_credits'));
    }

    public function store(StoreWorkflowRequestCreditHistoryRequest $request)
    {
        $workflowRequestCreditHistory = WorkflowRequestCreditHistory::create($request->all());

        return redirect()->route('admin.workflow-request-credit-histories.index');
    }

    public function edit(WorkflowRequestCreditHistory $workflowRequestCreditHistory)
    {
        abort_if(Gate::denies('workflow_request_credit_history_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $workflow_request_credits = WorkflowRequestCredit::pluck('request_credit_batch', 'id')->prepend(trans('global.pleaseSelect'), '');

        $actors = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $workflowRequestCreditHistory->load('workflow_request_credit', 'actor');

        return view('admin.workflowRequestCreditHistories.edit', compact('actors', 'workflowRequestCreditHistory', 'workflow_request_credits'));
    }

    public function update(UpdateWorkflowRequestCreditHistoryRequest $request, WorkflowRequestCreditHistory $workflowRequestCreditHistory)
    {
        $workflowRequestCreditHistory->update($request->all());

        return redirect()->route('admin.workflow-request-credit-histories.index');
    }

    public function show(WorkflowRequestCreditHistory $workflowRequestCreditHistory)
    {
        abort_if(Gate::denies('workflow_request_credit_history_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $workflowRequestCreditHistory->load('workflow_request_credit', 'actor');

        return view('admin.workflowRequestCreditHistories.show', compact('workflowRequestCreditHistory'));
    }

    public function destroy(WorkflowRequestCreditHistory $workflowRequestCreditHistory)
    {
        abort_if(Gate::denies('workflow_request_credit_history_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $workflowRequestCreditHistory->delete();

        return back();
    }

    public function massDestroy(MassDestroyWorkflowRequestCreditHistoryRequest $request)
    {
        $workflowRequestCreditHistories = WorkflowRequestCreditHistory::find(request('ids'));

        foreach ($workflowRequestCreditHistories as $workflowRequestCreditHistory) {
            $workflowRequestCreditHistory->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
