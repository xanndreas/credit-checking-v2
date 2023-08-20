<?php

namespace App\Http\Requests;

use App\Models\SurveyReportAttribute;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroySurveyReportAttributeRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('survey_report_attribute_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:survey_report_attributes,id',
        ];
    }
}
