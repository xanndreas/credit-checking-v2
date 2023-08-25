<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroySurveyReportRequest;
use App\Http\Requests\StoreSurveyReportRequest;
use App\Http\Requests\UpdateSurveyReportRequest;
use App\Models\RequestCredit;
use App\Models\SurveyAddress;
use App\Models\SurveyReport;
use App\Models\SurveyReportAttribute;
use App\Models\User;
use App\Models\WorkflowRequestCredit;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class SurveyReportController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('survey_report_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = SurveyAddress::with(['request_credit', 'request_credit.request_debtors', 'surveyor'])
                ->orderBy('id');

            if (Gate::allows('actor_surveyor_access')) {
                $query->where('surveyor_id', Auth::id());
            } else if (Gate::allows('request_credit_super')) {
                // do nothing
            } else {
                $child = $this->tenantChildUser(User::with('roles')
                    ->find(Auth::id())->firstOrFail());

                $query->whereHas('surveyor',
                    fn($q) => $q->whereIn('id', $child == null ? [] : $child));
            }

            $query->select(sprintf('%s.*', (new SurveyAddress)->table));

            $table = Datatables::eloquent($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $surveyReports = SurveyReport::with('survey_address')->where('survey_address_id', $row->id)
                    ->first();

                $workflowRequestCredit = WorkflowRequestCredit::with('request_credit', 'process_status')
                    ->where('request_credit_id', $row->request_credit_id)->first();

                return view('admin.surveyReports._partials.reportActions', compact('surveyReports', 'workflowRequestCredit', 'row'));
            });

            $table->addColumn('request_credit_batch_number', function ($row) {
                return $row->request_credit ? '<a href="' . route('admin.request-credits.show', ['request_credit' => $row->request_credit->id]) . '">' .
                    '#' . $row->request_credit->batch_number . '</a>' : '';
            });

            $table->editColumn('request_credit_debtor', function ($row) {
                $labels = [];
                foreach ($row->request_credit->request_debtors as $request_debtor) {
                    $labels[] = sprintf('<span class="badge bg-label-warning">%s</span>', $request_debtor->name);
                }

                return implode(' ', $labels);
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

            $table->rawColumns(['actions', 'placeholder', 'request_credit_batch_number', 'request_credit', 'request_credit_debtor', 'surveyor']);

            return $table->make(true);
        }

        return view('admin.surveyReports.index');
    }

    public function create(SurveyAddress $surveyAddress)
    {
        abort_if(Gate::denies('survey_report_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.surveyReports.form', compact('surveyAddress'));
    }

    public function store(SurveyAddress $surveyAddress, StoreSurveyReportRequest $request)
    {
        $surveyReport = SurveyReport::create([
            'request_credit_id' => $surveyAddress->request_credit_id,
            'survey_address_id' => $surveyAddress->id,
            'submited_by_id' => Auth::id()
        ]);

        $surveyReportAttributeId = [];

        foreach ($request->only(['parking_access', 'owner_status', 'owner_beneficial', 'office_note']) as $index => $item) {
            $createSurveyAttribute = SurveyReportAttribute::create(['object_name' => $index, 'attribute' => $item]);
            if ($createSurveyAttribute) {
                $surveyReportAttributeId[] = $createSurveyAttribute->id;
            }
        }

        if ($request->has('survey_address')) {
            foreach ($request->survey_address as $survey_address) {
                $createSurveyAttribute = SurveyReportAttribute::create(array_merge($survey_address, ['object_name' => 'survey_address']));
                if ($createSurveyAttribute) {
                    $surveyReportAttributeId[] = $createSurveyAttribute->id;
                }
            }
        }


        if ($request->has('document_attachment')) {
            foreach ($request->document_attachment as $document_attachment) {
                $createSurveyAttribute = SurveyReportAttribute::create(array_merge($document_attachment, ['object_name' => 'document_attachment']));
                if ($createSurveyAttribute) {
                    $surveyReportAttributeId[] = $createSurveyAttribute->id;
                }
            }

        }
        if ($request->has('environmental_check')) {
            foreach ($request->environmental_check as $environmental_check) {
                $createSurveyAttribute = SurveyReportAttribute::create(array_merge($environmental_check, ['object_name' => 'environmental_check']));
                if ($createSurveyAttribute) {
                    $surveyReportAttributeId[] = $createSurveyAttribute->id;
                }
            }
        }

        if ($request->has('note')) {
            foreach ($request->note as $note) {
                $createSurveyAttribute = SurveyReportAttribute::create(array_merge($note, ['object_name' => 'note']));
                if ($createSurveyAttribute) {
                    $surveyReportAttributeId[] = $createSurveyAttribute->id;
                }
            }
        }

        if ($request->has('incomplete_document')) {
            foreach ($request->incomplete_document as $incomplete_document) {
                $createSurveyAttribute = SurveyReportAttribute::create(array_merge($incomplete_document, ['object_name' => 'incomplete_document']));
                if ($createSurveyAttribute) {
                    $surveyReportAttributeId[] = $createSurveyAttribute->id;
                }
            }
        }

        foreach ($request->input('identity', []) as $file) {
            $surveyReport->addMedia(storage_path('tmp/uploads/' . basename($file)))
                ->toMediaCollection('identity');
        }

        foreach ($request->input('legality', []) as $file) {
            $surveyReport->addMedia(storage_path('tmp/uploads/' . basename($file)))
                ->toMediaCollection('legality');
        }

        foreach ($request->input('income', []) as $file) {
            $surveyReport->addMedia(storage_path('tmp/uploads/' . basename($file)))
                ->toMediaCollection('income');
        }

        foreach ($request->input('checking_account', []) as $file) {
            $surveyReport->addMedia(storage_path('tmp/uploads/' . basename($file)))
                ->toMediaCollection('checking_account');
        }

        foreach ($request->input('home_picture', []) as $file) {
            $surveyReport->addMedia(storage_path('tmp/uploads/' . basename($file)))
                ->toMediaCollection('home_picture');
        }

        foreach ($request->input('office_picture', []) as $file) {
            $surveyReport->addMedia(storage_path('tmp/uploads/' . basename($file)))
                ->toMediaCollection('office_picture');
        }

        foreach ($request->input('slik', []) as $file) {
            $surveyReport->addMedia(storage_path('tmp/uploads/' . basename($file)))
                ->toMediaCollection('slik');
        }

        foreach ($request->input('bkr_office_picture', []) as $file) {
            $surveyReport->addMedia(storage_path('tmp/uploads/' . basename($file)))
                ->toMediaCollection('bkr_office_picture');
        }

        foreach ($request->input('unit_refinancing', []) as $file) {
            $surveyReport->addMedia(storage_path('tmp/uploads/' . basename($file)))
                ->toMediaCollection('unit_refinancing');
        }

        foreach ($request->input('guarantor', []) as $file) {
            $surveyReport->addMedia(storage_path('tmp/uploads/' . basename($file)))
                ->toMediaCollection('guarantor');
        }

        $surveyReport->survey_attributes()->sync($surveyReportAttributeId);

        return redirect()->route('admin.survey-reports.index');
    }

    public function download(SurveyAddress $surveyAddress)
    {

        $surveyReport = SurveyReport::with('survey_attributes', 'survey_address', 'survey_address.surveyor')
            ->where('survey_address_id', $surveyAddress->id)->first();

        if ($surveyReport) {
            $pdf = Pdf::loadView('admin.printTemplates.surveyReport', compact('surveyReport'));
            return $pdf->download('SURVEY-' . $surveyReport->created_at . '.pdf');
        }

        return response(null, Response::HTTP_NOT_FOUND);
    }

    public function edit(SurveyReport $surveyReport)
    {
        abort_if(Gate::denies('survey_report_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $request_credits = RequestCredit::pluck('batch_number', 'id')->prepend(trans('global.pleaseSelect'), '');

        $survey_addresses = SurveyAddress::pluck('address_type', 'id')->prepend(trans('global.pleaseSelect'), '');

        $survey_attributes = SurveyReportAttribute::pluck('object_name', 'id');

        $submited_bies = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $surveyReport->load('request_credit', 'survey_address', 'survey_attributes', 'submited_by');

        return view('admin.surveyReports.edit', compact('request_credits', 'submited_bies', 'surveyReport', 'survey_addresses', 'survey_attributes'));
    }

    public function update(UpdateSurveyReportRequest $request, SurveyReport $surveyReport)
    {
        $surveyReport->update($request->all());
        $surveyReport->survey_attributes()->sync($request->input('survey_attributes', []));

        return redirect()->route('admin.survey-reports.index');
    }

    public function show(SurveyReport $surveyReport)
    {
        abort_if(Gate::denies('survey_report_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $surveyReport->load('request_credit', 'survey_address', 'survey_attributes', 'submited_by');

        return view('admin.surveyReports.show', compact('surveyReport'));
    }

    public function destroy(SurveyReport $surveyReport)
    {
        abort_if(Gate::denies('survey_report_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $surveyReport->delete();

        return back();
    }
}
