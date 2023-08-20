<?php

namespace App\Http\Requests;

use App\Models\RequestCreditHelp;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyRequestCreditHelpRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('request_credit_help_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:request_credit_helps,id',
        ];
    }
}
