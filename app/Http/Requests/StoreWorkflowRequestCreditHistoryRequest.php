<?php

namespace App\Http\Requests;

use App\Models\WorkflowRequestCreditHistory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreWorkflowRequestCreditHistoryRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('workflow_request_credit_history_create');
    }

    public function rules()
    {
        return [
            'workflow_request_credit_id' => [
                'required',
                'integer',
            ],
            'actor_id' => [
                'required',
                'integer',
            ],
            'process_status' => [
                'string',
                'required',
            ],
            'process_notes' => [
                'string',
                'nullable',
            ],
            'attribute' => [
                'string',
                'nullable',
            ],
            'attribute_2' => [
                'string',
                'nullable',
            ],
        ];
    }
}
