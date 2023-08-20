<?php

namespace App\Http\Requests;

use App\Models\WorkflowProcess;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateWorkflowProcessRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('workflow_process_edit');
    }

    public function rules()
    {
        return [
            'process_status' => [
                'string',
                'required',
                'unique:workflow_processes,process_status,' . request()->route('workflow_process')->id,
            ],
            'description' => [
                'string',
                'nullable',
            ],
        ];
    }
}
