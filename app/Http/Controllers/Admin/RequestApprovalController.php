<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyRequestApprovalRequest;
use App\Http\Requests\StoreRequestApprovalRequest;
use App\Http\Requests\UpdateRequestApprovalRequest;
use App\Models\RequestApproval;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class RequestApprovalController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('request_approval_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = RequestApproval::query()->select(sprintf('%s.*', (new RequestApproval)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'request_approval_show';
                $editGate      = 'request_approval_edit';
                $deleteGate    = 'request_approval_delete';
                $crudRoutePart = 'request-approvals';

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
            $table->editColumn('status', function ($row) {
                return $row->status ? $row->status : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.requestApprovals.index');
    }

    public function create()
    {
        abort_if(Gate::denies('request_approval_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.requestApprovals.create');
    }

    public function store(StoreRequestApprovalRequest $request)
    {
        $requestApproval = RequestApproval::create($request->all());

        return redirect()->route('admin.request-approvals.index');
    }

    public function edit(RequestApproval $requestApproval)
    {
        abort_if(Gate::denies('request_approval_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.requestApprovals.edit', compact('requestApproval'));
    }

    public function update(UpdateRequestApprovalRequest $request, RequestApproval $requestApproval)
    {
        $requestApproval->update($request->all());

        return redirect()->route('admin.request-approvals.index');
    }

    public function show(RequestApproval $requestApproval)
    {
        abort_if(Gate::denies('request_approval_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.requestApprovals.show', compact('requestApproval'));
    }

    public function destroy(RequestApproval $requestApproval)
    {
        abort_if(Gate::denies('request_approval_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $requestApproval->delete();

        return back();
    }

    public function massDestroy(MassDestroyRequestApprovalRequest $request)
    {
        $requestApprovals = RequestApproval::find(request('ids'));

        foreach ($requestApprovals as $requestApproval) {
            $requestApproval->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
