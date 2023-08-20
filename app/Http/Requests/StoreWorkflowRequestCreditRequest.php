<?php

namespace App\Http\Requests;

use App\Models\WorkflowRequestCredit;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreWorkflowRequestCreditRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('workflow_request_credit_create');
    }

    public function rules()
    {
        return [
            'request_credit_batch' => [
                'string',
                'required',
            ],
            'request_credit_id' => [
                'required',
                'integer',
            ],
            'process_status_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
