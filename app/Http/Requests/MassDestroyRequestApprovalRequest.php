<?php

namespace App\Http\Requests;

use App\Models\RequestApproval;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyRequestApprovalRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('request_approval_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:request_approvals,id',
        ];
    }
}
