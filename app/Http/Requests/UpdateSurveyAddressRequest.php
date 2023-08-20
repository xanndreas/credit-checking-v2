<?php

namespace App\Http\Requests;

use App\Models\SurveyAddress;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateSurveyAddressRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('survey_address_edit');
    }

    public function rules()
    {
        return [
            'request_credit_id' => [
                'required',
                'integer',
            ],
            'address_type' => [
                'required',
            ],
            'surveyor_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
