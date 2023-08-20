<?php

namespace App\Http\Requests;

use App\Models\RequestCreditDebtor;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreRequestCreditDebtorRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('request_credit_debtor_create');
    }

    public function rules()
    {
        return [
            'personel_type' => [
                'required',
            ],
            'name' => [
                'string',
                'nullable',
            ],
            'identity_number' => [
                'string',
                'min:16',
                'nullable',
            ],
        ];
    }
}
