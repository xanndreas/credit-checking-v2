<?php

namespace App\Http\Requests;

use App\Models\WorkflowProcess;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreWorkflowProcessRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('workflow_process_create');
    }

    public function rules()
    {
        return [
            'process_status' => [
                'string',
                'required',
                'unique:workflow_processes',
            ],
            'description' => [
                'string',
                'nullable',
            ],
        ];
    }
}
