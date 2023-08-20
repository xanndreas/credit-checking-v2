<?php

namespace App\Http\Requests;

use App\Models\RequestCreditDebtor;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyRequestCreditDebtorRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('request_credit_debtor_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:request_credit_debtors,id',
        ];
    }
}
