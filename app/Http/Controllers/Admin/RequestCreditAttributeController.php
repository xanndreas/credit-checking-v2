<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyRequestCreditAttributeRequest;
use App\Http\Requests\StoreRequestCreditAttributeRequest;
use App\Http\Requests\UpdateRequestCreditAttributeRequest;
use App\Models\RequestCreditAttribute;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class RequestCreditAttributeController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('request_credit_attribute_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = RequestCreditAttribute::query()->select(sprintf('%s.*', (new RequestCreditAttribute)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'request_credit_attribute_show';
                $editGate      = 'request_credit_attribute_edit';
                $deleteGate    = 'request_credit_attribute_delete';
                $crudRoutePart = 'request-credit-attributes';

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
            $table->editColumn('object_name', function ($row) {
                return $row->object_name ? $row->object_name : '';
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

        return view('admin.requestCreditAttributes.index');
    }

    public function create()
    {
        abort_if(Gate::denies('request_credit_attribute_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.requestCreditAttributes.create');
    }

    public function store(StoreRequestCreditAttributeRequest $request)
    {
        $requestCreditAttribute = RequestCreditAttribute::create($request->all());

        return redirect()->route('admin.request-credit-attributes.index');
    }

    public function edit(RequestCreditAttribute $requestCreditAttribute)
    {
        abort_if(Gate::denies('request_credit_attribute_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.requestCreditAttributes.edit', compact('requestCreditAttribute'));
    }

    public function update(UpdateRequestCreditAttributeRequest $request, RequestCreditAttribute $requestCreditAttribute)
    {
        $requestCreditAttribute->update($request->all());

        return redirect()->route('admin.request-credit-attributes.index');
    }

    public function show(RequestCreditAttribute $requestCreditAttribute)
    {
        abort_if(Gate::denies('request_credit_attribute_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.requestCreditAttributes.show', compact('requestCreditAttribute'));
    }

    public function destroy(RequestCreditAttribute $requestCreditAttribute)
    {
        abort_if(Gate::denies('request_credit_attribute_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $requestCreditAttribute->delete();

        return back();
    }

    public function massDestroy(MassDestroyRequestCreditAttributeRequest $request)
    {
        $requestCreditAttributes = RequestCreditAttribute::find(request('ids'));

        foreach ($requestCreditAttributes as $requestCreditAttribute) {
            $requestCreditAttribute->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
