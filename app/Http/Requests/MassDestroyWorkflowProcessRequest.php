<?php

namespace App\Http\Requests;

use App\Models\WorkflowProcess;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyWorkflowProcessRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('workflow_process_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:workflow_processes,id',
        ];
    }
}
