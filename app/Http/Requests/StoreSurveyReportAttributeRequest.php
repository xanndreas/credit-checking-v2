<?php

namespace App\Http\Requests;

use App\Models\SurveyReportAttribute;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreSurveyReportAttributeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('survey_report_attribute_create');
    }

    public function rules()
    {
        return [
            'object_name' => [
                'string',
                'required',
            ],
            'attribute' => [
                'string',
                'nullable',
            ],
            'attribute_2' => [
                'string',
                'nullable',
            ],
            'attribute_3' => [
                'string',
                'nullable',
            ],
        ];
    }
}
