<?php

namespace App\Http\Requests;

use App\Models\RequestCreditAttribute;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyRequestCreditAttributeRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('request_credit_attribute_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:request_credit_attributes,id',
        ];
    }
}
