<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\TenantTrait;
use App\Http\Requests\MassDestroySurveyAddressRequest;
use App\Http\Requests\StoreSurveyAddressRequest;
use App\Http\Requests\UpdateSurveyAddressRequest;
use App\Models\RequestCredit;
use App\Models\SurveyAddress;
use App\Models\User;
use App\Models\WorkflowRequestCredit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class SurveyAddressesController extends Controller
{
    use TenantTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('survey_address_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = RequestCredit::with(['auto_planner', 'request_debtors', 'request_attributes']);

            if (Gate::allows('actor_auto_planner_access')) {
                $query->whereRelation('auto_planner', 'id', Auth::id());
            } else if (Gate::allows('request_credit_super') || Gate::allows('actor_surveyor_admin_access')) {
                // do nothing
            } else {
                $child = $this->tenantChildUser(User::with('roles')
                    ->find(Auth::id())->firstOrFail());

                $query->whereHas('auto_planner',
                    fn($q) => $q->whereIn('id', $child == null ? [] : $child));
            }

            $requestCreditOnSurvey = WorkflowRequestCredit::with('request_credit', 'process_status')
                ->whereRelation('process_status', 'process_status', 'request_surveys')
                ->get()->pluck('request_credit_id');

            $query->whereIn('id', $requestCreditOnSurvey)
                ->select(sprintf('%s.*', (new RequestCredit)->table));

            $table = Datatables::eloquent($query);
            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'request_credit_show';
                $editGate = 'request_credit_edit';
                $deleteGate = 'request_credit_delete_disabled';
                $crudRoutePart = 'request-credits';

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

            $table->rawColumns(['actions', 'approvals', 'placeholder', 'auto_planner', 'request_debtor']);

            return $table->make(true);
        }

        return view('admin.surveyAddresses.index');
    }

    public function create()
    {
        abort_if(Gate::denies('survey_address_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function store(StoreSurveyAddressRequest $request)
    {
        $surveyAddress = SurveyAddress::create($request->all());

        return redirect()->route('admin.survey-addresses.index');
    }

    public function edit(SurveyAddress $surveyAddress)
    {
        abort_if(Gate::denies('survey_address_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $request_credits = RequestCredit::pluck('batch_number', 'id')->prepend(trans('global.pleaseSelect'), '');

        $surveyors = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $surveyAddress->load('request_credit', 'surveyor');

        return view('admin.surveyAddresses.edit', compact('request_credits', 'surveyAddress', 'surveyors'));
    }

    public function update(UpdateSurveyAddressRequest $request, SurveyAddress $surveyAddress)
    {
        $surveyAddress->update($request->all());

        return redirect()->route('admin.survey-addresses.index');
    }

    public function show(SurveyAddress $surveyAddress)
    {
        abort_if(Gate::denies('survey_address_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function destroy(SurveyAddress $surveyAddress)
    {
        abort_if(Gate::denies('survey_address_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $surveyAddress->delete();

        return back();
    }

    public function detail(RequestCredit $requestCredit) {


        return view('admin.surveyAddresses.show', compact('requestCredit'));
    }
}
