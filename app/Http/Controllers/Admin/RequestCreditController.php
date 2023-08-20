<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Controllers\Traits\TenantTrait;
use App\Http\Requests\MassDestroyRequestCreditRequest;
use App\Http\Requests\StoreRequestCreditRequest;
use App\Http\Requests\UpdateRequestCreditRequest;
use App\Models\RequestCredit;
use App\Models\RequestCreditAttribute;
use App\Models\RequestCreditDebtor;
use App\Models\RequestCreditHelp;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class RequestCreditController extends Controller
{
    use MediaUploadingTrait, TenantTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('request_credit_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = RequestCredit::with(['auto_planner', 'request_debtors', 'request_attributes']);

            if (Gate::allows('actor_auto_planner_access')) {
                $query->whereRelation('auto_planner', 'id', Auth::id());
            } else if (Gate::allows('request_credit_super')) {
                // do nothing
            } else {
                $child = $this->tenantChildUser(User::with('roles')
                    ->find(Auth::id())->firstOrFail());

                $query->whereHas('auto_planner',
                    fn($q) => $q->whereIn('id', $child == null ? [] : $child));
            }

            $query->select(sprintf('%s.*', (new RequestCredit)->table));

            $table = Datatables::eloquent($query);

            $table->filter(function ($query) {
                if (request()->has('minDate') && request()->has('maxDate')) {
                    $query->whereBetween('created_at', [request()->minDate, request()->maxDate]);
                }
            }, true);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'request_credit_show';
                $editGate = 'request_credit_edit';
                $deleteGate = 'request_credit_delete';
                $crudRoutePart = 'request-credits';

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
            $table->editColumn('batch_number', function ($row) {
                return $row->batch_number ? $row->batch_number : '';
            });
            $table->editColumn('credit_type', function ($row) {
                return $row->credit_type ? RequestCredit::CREDIT_TYPE_SELECT[$row->credit_type] : '';
            });
            $table->addColumn('auto_planner_name', function ($row) {
                return $row->auto_planner ? $row->auto_planner->name : '';
            });

            $table->editColumn('request_debtor', function ($row) {
                $labels = [];
                foreach ($row->request_debtors as $request_debtor) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $request_debtor->name);
                }

                return implode(' ', $labels);
            });

            foreach (RequestCredit::REQUEST_ATTRIBUTE_FIELDS as $item) {
                $table->addColumn($item, '&nbsp;');

                $table->editColumn($item, function ($row) use ($item) {
                    return $row->request_attributes->filter(function ($it) use ($item) {
                        return $it->object_name == $item;
                    })->first() ?? '';
                });
            }

            $table->rawColumns(['actions', 'placeholder', 'auto_planner', 'request_debtor', 'request_attribute']);

            return $table->make(true);
        }

        return view('admin.requestCredits.index');
    }

    public function create()
    {
        abort_if(Gate::denies('request_credit_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $auto_planners = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $dealers    = RequestCreditHelp::where('type', 'dealers')->pluck('attribute', 'attribute');

        $products   = RequestCreditHelp::where('type', 'products')->pluck('attribute', 'attribute');

        $brands     = RequestCreditHelp::where('type', 'brands')->pluck('attribute', 'attribute');

        $insurances = RequestCreditHelp::where('type', 'insurances')->pluck('attribute', 'attribute');

        $tenors     = RequestCreditHelp::where('type', 'tenors')->pluck('attribute', 'attribute');

        return view('admin.requestCredits.create',
            compact('auto_planners', 'brands', 'dealers', 'insurances', 'products', 'tenors'));
    }

    public function store(StoreRequestCreditRequest $request)
    {
        $requestCredit = RequestCredit::create($request->all());
//        $requestCredit->request_debtors()->sync($request->input('request_debtors', []));
//        $requestCredit->request_attributes()->sync($request->input('request_attributes', []));

        foreach ($request->input('id_photos', []) as $file) {
            $requestCredit->addMedia(storage_path('tmp/uploads/' . basename($file)))
                ->usingFileName('KTP_' . $request->debtor_name . '_' . uniqid() . '.' . explode('.', $file)[1])
                ->toMediaCollection('id_photos');
        }

        foreach ($request->input('kk_photos', []) as $file) {
            $requestCredit->addMedia(storage_path('tmp/uploads/' . basename($file)))
                ->usingFileName('KK_' . $request->debtor_name . '_' . uniqid() . '.' . explode('.', $file)[1])
                ->toMediaCollection('kk_photos');
        }

        foreach ($request->input('npwp_photos', []) as $file) {
            $requestCredit->addMedia(storage_path('tmp/uploads/' . basename($file)))
                ->usingFileName('NPWP_' . $request->debtor_name . '_' . uniqid() . '.' . explode('.', $file)[1])
                ->toMediaCollection('npwp_photos');
        }

        foreach ($request->input('other_photos', []) as $file) {
            $requestCredit->addMedia(storage_path('tmp/uploads/' . basename($file)))
                ->usingFileName('Other_' . $request->debtor_name . '_' . uniqid() . '.' . explode('.', $file)[1])
                ->toMediaCollection('other_photos');
        }

        return redirect()->route('admin.request-credits.index');
    }

    public function edit(RequestCredit $requestCredit)
    {
        abort_if(Gate::denies('request_credit_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $auto_planners = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $request_debtors = RequestCreditDebtor::pluck('name', 'id');

        $request_attributes = RequestCreditAttribute::pluck('object_name', 'id');

        $requestCredit->load('auto_planner', 'request_debtors', 'request_attributes');

        return view('admin.requestCredits.edit', compact('auto_planners', 'requestCredit', 'request_attributes', 'request_debtors'));
    }

    public function update(UpdateRequestCreditRequest $request, RequestCredit $requestCredit)
    {
        $requestCredit->update($request->all());
        $requestCredit->request_debtors()->sync($request->input('request_debtors', []));
        $requestCredit->request_attributes()->sync($request->input('request_attributes', []));

        return redirect()->route('admin.request-credits.index');
    }

    public function show(RequestCredit $requestCredit)
    {
        abort_if(Gate::denies('request_credit_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $requestCredit->load('auto_planner', 'request_debtors', 'request_attributes');

        return view('admin.requestCredits.show', compact('requestCredit'));
    }

    public function destroy(RequestCredit $requestCredit)
    {
        abort_if(Gate::denies('request_credit_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $requestCredit->delete();

        return back();
    }

    public function download(Request $request)
    {
        if ($request->minDate != null && $request->maxDate != null) {
            return Excel::download(new CreditCheckingExport($request->minDate, $request->maxDate), 'credit-checking.xlsx');
        }

        return redirect()->back();
    }
}
