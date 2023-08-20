<?php

namespace App\Http\Requests;

use App\Models\RequestCreditHelp;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateRequestCreditHelpRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('request_credit_help_edit');
    }

    public function rules()
    {
        return [
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
