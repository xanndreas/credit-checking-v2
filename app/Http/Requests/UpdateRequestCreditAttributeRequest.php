<?php

namespace App\Http\Requests;

use App\Models\RequestCreditAttribute;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateRequestCreditAttributeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('request_credit_attribute_edit');
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
