<?php

namespace App\Http\Requests;

use App\Models\RequestApproval;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreRequestApprovalRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('request_approval_create');
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
