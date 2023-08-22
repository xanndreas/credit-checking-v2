<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyRequestCreditHelpRequest;
use App\Http\Requests\StoreRequestCreditHelpRequest;
use App\Http\Requests\UpdateRequestCreditHelpRequest;
use App\Models\RequestCreditHelp;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class RequestCreditHelpController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('request_credit_help_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = RequestCreditHelp::query()->select(sprintf('%s.*', (new RequestCreditHelp)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'request_credit_help_show';
                $editGate      = 'request_credit_help_edit';
                $deleteGate    = 'request_credit_help_delete';
                $crudRoutePart = 'request-credit-helps';

                return view('_partials.datatablesActions', compact(
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
            $table->editColumn('type', function ($row) {
                return $row->type ? RequestCreditHelp::TYPE_SELECT[$row->type] : '';
            });
            $table->editColumn('attribute', function ($row) {
                return $row->attribute ? $row->attribute : '';
            });
            $table->editColumn('attribute_2', function ($row) {
                return $row->attribute_2 ? $row->attribute_2 : '';
            });
            $table->editColumn('attribute_3', function ($row) {
                return $row->attribute_3 ? $row->attribute_3 : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.requestCreditHelps.index');
    }

    public function create()
    {
        abort_if(Gate::denies('request_credit_help_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.requestCreditHelps.create');
    }

    public function store(StoreRequestCreditHelpRequest $request)
    {
        $requestCreditHelp = RequestCreditHelp::create($request->all());

        return redirect()->route('admin.request-credit-helps.index');
    }

    public function edit(RequestCreditHelp $requestCreditHelp)
    {
        abort_if(Gate::denies('request_credit_help_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.requestCreditHelps.edit', compact('requestCreditHelp'));
    }

    public function update(UpdateRequestCreditHelpRequest $request, RequestCreditHelp $requestCreditHelp)
    {
        $requestCreditHelp->update($request->all());

        return redirect()->route('admin.request-credit-helps.index');
    }

    public function show(RequestCreditHelp $requestCreditHelp)
    {
        abort_if(Gate::denies('request_credit_help_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.requestCreditHelps.show', compact('requestCreditHelp'));
    }

    public function destroy(RequestCreditHelp $requestCreditHelp)
    {
        abort_if(Gate::denies('request_credit_help_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $requestCreditHelp->delete();

        return back();
    }

    public function massDestroy(MassDestroyRequestCreditHelpRequest $request)
    {
        $requestCreditHelps = RequestCreditHelp::find(request('ids'));

        foreach ($requestCreditHelps as $requestCreditHelp) {
            $requestCreditHelp->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
