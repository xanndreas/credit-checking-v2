<?php

namespace App\Http\Requests;

use App\Models\WorkflowRequestCreditHistory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyWorkflowRequestCreditHistoryRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('workflow_request_credit_history_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:workflow_request_credit_histories,id',
        ];
    }
}
