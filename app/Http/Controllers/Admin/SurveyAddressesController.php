<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroySurveyAddressRequest;
use App\Http\Requests\StoreSurveyAddressRequest;
use App\Http\Requests\UpdateSurveyAddressRequest;
use App\Models\RequestCredit;
use App\Models\SurveyAddress;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class SurveyAddressesController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('survey_address_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = SurveyAddress::with(['request_credit', 'surveyor'])->select(sprintf('%s.*', (new SurveyAddress)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'survey_address_show';
                $editGate      = 'survey_address_edit';
                $deleteGate    = 'survey_address_delete';
                $crudRoutePart = 'survey-addresses';

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
            $table->addColumn('request_credit_batch_number', function ($row) {
                return $row->request_credit ? $row->request_credit->batch_number : '';
            });

            $table->editColumn('address_type', function ($row) {
                return $row->address_type ? SurveyAddress::ADDRESS_TYPE_SELECT[$row->address_type] : '';
            });
            $table->editColumn('addresses', function ($row) {
                return $row->addresses ? $row->addresses : '';
            });
            $table->addColumn('surveyor_name', function ($row) {
                return $row->surveyor ? $row->surveyor->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'request_credit', 'surveyor']);

            return $table->make(true);
        }

        $request_credits = RequestCredit::get();
        $users           = User::get();

        return view('admin.surveyAddresses.index', compact('request_credits', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('survey_address_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $request_credits = RequestCredit::pluck('batch_number', 'id')->prepend(trans('global.pleaseSelect'), '');

        $surveyors = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.surveyAddresses.create', compact('request_credits', 'surveyors'));
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

        $surveyAddress->load('request_credit', 'surveyor');

        return view('admin.surveyAddresses.show', compact('surveyAddress'));
    }

    public function destroy(SurveyAddress $surveyAddress)
    {
        abort_if(Gate::denies('survey_address_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $surveyAddress->delete();

        return back();
    }

    public function massDestroy(MassDestroySurveyAddressRequest $request)
    {
        $surveyAddresses = SurveyAddress::find(request('ids'));

        foreach ($surveyAddresses as $surveyAddress) {
            $surveyAddress->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
