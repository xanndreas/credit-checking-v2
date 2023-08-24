<?php

namespace App\Http\Requests;

use App\Models\SurveyReport;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

class StoreSurveyReportRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('survey_report_create');
    }

    public function rules()
    {
        return [
            'office_note' => [
                'required',
                'string',
            ],
            'owner_beneficial' => [
                'required',
                'string',
            ],
            'owner_status' => [
                'required',
                'string',
            ],
            'parking_access' => [
                'required',
                'string',
            ],
            'attachments' => [
                'required',
            ],
            'survey_address' => [
                'array',
            ],
            'document_attachment' => [
                'array',
            ],
            'environmental_check' => [
                'array',
            ],
            'note' => [
                'array',
            ],
            'incomplete_document' => [
                'array',
            ],

        ];
    }
}
