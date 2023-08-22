<?php

namespace App\Http\Controllers\Admin;

use App\Exports\CreditCheckingExport;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Controllers\Traits\TenantTrait;
use App\Http\Controllers\Traits\WorkflowCreditRequestTrait;
use App\Http\Requests\StoreRequestCreditRequest;
use App\Http\Requests\UpdateRequestCreditRequest;
use App\Models\RequestCredit;
use App\Models\RequestCreditAttribute;
use App\Models\RequestCreditDebtor;
use App\Models\RequestCreditHelp;
use App\Models\User;
use App\Models\WorkflowRequestCredit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class RequestCreditController extends Controller
{
    use MediaUploadingTrait, TenantTrait, WorkflowCreditRequestTrait;

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
            $table->addColumn('approvals', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'request_credit_show';
                $editGate = 'request_credit_edit';
                $deleteGate = 'request_credit_delete';
                $crudRoutePart = 'request-credits';

                return view('_partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });


            $table->editColumn('approvals', function ($row) {
                $requestApprovals = WorkflowRequestCredit::with('process_status')
                    ->where('request_credit_id', $row->id)->first();

                $approveGate = 'approval_request_credit_approve';

                return view('admin.requestCredits._partials.approveActions', compact(
                    'approveGate',
                    'requestApprovals',
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

            $table->addColumn('workflow_status', function ($row) {
                $workflowRequestCredit = WorkflowRequestCredit::with('process_status')
                    ->where('request_credit_id', $row->id)->first();

                return $workflowRequestCredit->process_status ? $workflowRequestCredit->process_status->process_status : '';
            });

            $table->editColumn('request_debtor', function ($row) {
                $labels = [];
                foreach ($row->request_debtors as $request_debtor) {
                    $labels[] = sprintf('<span class="badge bg-secondary">%s</span>', $request_debtor->name);
                }

                return implode(' ', $labels);
            });

            foreach (RequestCredit::REQUEST_ATTRIBUTE_FIELDS as $item) {
                $table->addColumn($item, '&nbsp;');

                $table->editColumn($item, function ($row) use ($item) {
                    $requestCreditAttribute = $row->request_attributes->filter(function ($it) use ($item) {
                        return $it->object_name == $item;
                    })->first();

                    return $requestCreditAttribute ? $requestCreditAttribute->attribute : '';
                });
            }

            $table->rawColumns(['actions', 'approvals', 'placeholder', 'auto_planner', 'request_debtor', 'request_attribute']);

            return $table->make(true);
        }

        return view('admin.requestCredits.index');
    }

    public function create()
    {
        abort_if(Gate::denies('request_credit_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $auto_planners = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $plHolder = RequestCreditHelp::where('type', 'placeholders')->pluck('attribute', 'attribute');

        $dealers = RequestCreditHelp::where('type', 'dealers')->pluck('attribute', 'attribute')->concat($plHolder);

        $products = RequestCreditHelp::where('type', 'products')->pluck('attribute', 'attribute')->concat($plHolder);

        $brands = RequestCreditHelp::where('type', 'brands')->pluck('attribute', 'attribute')->concat($plHolder);

        $insurances = RequestCreditHelp::where('type', 'insurances')->pluck('attribute', 'attribute');

        $tenors = RequestCreditHelp::where('type', 'tenors')->pluck('attribute', 'attribute');

        return view('admin.requestCredits.create',
            compact('auto_planners', 'brands', 'dealers', 'insurances', 'products', 'tenors'));
    }

    public function store(StoreRequestCreditRequest $request)
    {
        $requestCreditData = array_merge(
            $request->only('credit_type'),
            [
                'batch_number' => Str::random(10),
                'auto_planner_id' => Auth::id()
            ]
        );

        $requestCredit = RequestCredit::create($requestCreditData);
        $requestAll = $request->all();

        $creditPersonel = [];
        if ($request->credit_type == 'individu')
            $creditPersonel = ['debtor', 'debtor_partner', 'guarantor'];
        else if ($request->credit_type == 'badan_usaha')
            $creditPersonel = ['business', 'shareholder'];

        foreach ($creditPersonel as $item) {
            if (isset($requestAll[$item . '_name']) && $requestAll[$item . '_identity_number']) {
                $requestCreditDebtor[] = RequestCreditDebtor::create([
                    'personel_type' => $item,
                    'name' => $requestAll[$item . '_name'],
                    'identity_type' => $requestAll['credit_type'] == 'badan_usaha' ? 'npwp' :
                        $requestAll[$item . '_identity_type'],

                    'identity_number' => $requestAll[$item . '_identity_number'],
                ])->id;
            }
        }

        $requestCreditAttribute = [];
        foreach (RequestCredit::REQUEST_ATTRIBUTE_FIELDS as $item) {
            if (isset($requestAll['attr_' . $item])) {
                $requestCreditAttribute[] = RequestCreditAttribute::create(
                    [
                        'object_name' => $item,
                        'attribute' => $requestAll['attr_' . $item],
                        'attribute_2' => null,
                        'attribute_3' => null,
                    ]
                )->id;
            }
        }

        $requestCredit->request_debtors()->sync($requestCreditDebtor);
        $requestCredit->request_attributes()->sync($requestCreditAttribute);

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

        $submitActions = $this->submitActions(true, Auth::id(), $requestCredit->id);

        return redirect()->route('admin.request-credits.index');
    }

    public function edit(RequestCredit $requestCredit)
    {
        abort_if(Gate::denies('request_credit_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function update(UpdateRequestCreditRequest $request, RequestCredit $requestCredit)
    {
        return response(null, Response::HTTP_NO_CONTENT);
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
            return Excel::download(new CreditCheckingExport($request->minDate, $request->maxDate), 'request-credit.xlsx');
        }

        return redirect()->back();
    }

    public function approvals(RequestCredit $requestCredit, Request $request)
    {
        if ($request->has('next')) {
            if ($request->has('process_notes') && $request->next == "false") {
                if ($request->process_notes != null) {
                    $this->submitActions(true, Auth::id(), $requestCredit->id, $request->process_notes);
                } else {
                    $this->submitActions(false, Auth::id(), $requestCredit->id, $request->process_notes);
                }
            } elseif ($request->next == "true") {
                $this->submitActions(true, Auth::id(), $requestCredit->id);
            }

            return redirect()->route('admin.request-credits.index');
        }

        return response(null, Response::HTTP_BAD_REQUEST);
    }
}
