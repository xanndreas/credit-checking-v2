<?php

namespace App\Http\Requests;

use App\Models\SurveyReport;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreSurveyReportRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('survey_report_create');
    }

    public function rules()
    {
        return [
            'request_credit_id' => [
                'required',
                'integer',
            ],
            'survey_address_id' => [
                'required',
                'integer',
            ],
            'survey_attributes.*' => [
                'integer',
            ],
            'survey_attributes' => [
                'array',
            ],
            'submited_by_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
