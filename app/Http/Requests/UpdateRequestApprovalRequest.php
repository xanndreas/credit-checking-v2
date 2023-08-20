<?php

namespace App\Http\Requests;

use App\Models\RequestApproval;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateRequestApprovalRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('request_approval_edit');
    }

    public function rules()
    {
        return [
            'status' => [
                'string',
                'required',
            ],
        ];
    }
}
