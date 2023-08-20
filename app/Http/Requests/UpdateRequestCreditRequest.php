<?php

namespace App\Http\Requests;

use App\Models\RequestCredit;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateRequestCreditRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('request_credit_edit');
    }

    public function rules()
    {
        return [
            'batch_number' => [
                'string',
                'required',
                'unique:request_credits,batch_number,' . request()->route('request_credit')->id,
            ],
            'credit_type' => [
                'required',
            ],
            'auto_planner_id' => [
                'required',
                'integer',
            ],
            'request_debtors.*' => [
                'integer',
            ],
            'request_debtors' => [
                'required',
                'array',
            ],
            'request_attributes.*' => [
                'integer',
            ],
            'request_attributes' => [
                'required',
                'array',
            ],
        ];
    }
}
