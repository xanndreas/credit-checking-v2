<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyRequestCreditDebtorRequest;
use App\Http\Requests\StoreRequestCreditDebtorRequest;
use App\Http\Requests\UpdateRequestCreditDebtorRequest;
use App\Models\RequestCreditDebtor;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class RequestCreditDebtorController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('request_credit_debtor_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = RequestCreditDebtor::query()->select(sprintf('%s.*', (new RequestCreditDebtor)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'request_credit_debtor_show';
                $editGate      = 'request_credit_debtor_edit';
                $deleteGate    = 'request_credit_debtor_delete';
                $crudRoutePart = 'request-credit-debtors';

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
            $table->editColumn('personel_type', function ($row) {
                return $row->personel_type ? RequestCreditDebtor::PERSONEL_TYPE_SELECT[$row->personel_type] : '';
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('identity_type', function ($row) {
                return $row->identity_type ? RequestCreditDebtor::IDENTITY_TYPE_SELECT[$row->identity_type] : '';
            });
            $table->editColumn('identity_number', function ($row) {
                return $row->identity_number ? $row->identity_number : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.requestCreditDebtors.index');
    }

    public function create()
    {
        abort_if(Gate::denies('request_credit_debtor_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.requestCreditDebtors.create');
    }

    public function store(StoreRequestCreditDebtorRequest $request)
    {
        $requestCreditDebtor = RequestCreditDebtor::create($request->all());

        return redirect()->route('admin.request-credit-debtors.index');
    }

    public function edit(RequestCreditDebtor $requestCreditDebtor)
    {
        abort_if(Gate::denies('request_credit_debtor_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.requestCreditDebtors.edit', compact('requestCreditDebtor'));
    }

    public function update(UpdateRequestCreditDebtorRequest $request, RequestCreditDebtor $requestCreditDebtor)
    {
        $requestCreditDebtor->update($request->all());

        return redirect()->route('admin.request-credit-debtors.index');
    }

    public function show(RequestCreditDebtor $requestCreditDebtor)
    {
        abort_if(Gate::denies('request_credit_debtor_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.requestCreditDebtors.show', compact('requestCreditDebtor'));
    }

    public function destroy(RequestCreditDebtor $requestCreditDebtor)
    {
        abort_if(Gate::denies('request_credit_debtor_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $requestCreditDebtor->delete();

        return back();
    }

    public function massDestroy(MassDestroyRequestCreditDebtorRequest $request)
    {
        $requestCreditDebtors = RequestCreditDebtor::find(request('ids'));

        foreach ($requestCreditDebtors as $requestCreditDebtor) {
            $requestCreditDebtor->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
