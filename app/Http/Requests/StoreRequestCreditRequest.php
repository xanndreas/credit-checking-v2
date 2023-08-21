<?php

namespace App\Http\Requests;

use App\Models\RequestCredit;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreRequestCreditRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('request_credit_create');
    }

    public function rules()
    {
        return [
            'credit_type' => [
                'required',
            ],
            'debtor_name' => [
                'sometimes',
                'required',
            ],
            'debtor_identity_type' => [
                'sometimes',
                'required',
            ],
            'debtor_identity_number' => [
                'sometimes',
                'required',
                'min:16',
            ],
            'partner_name' => [
                'sometimes',
                'required',
            ],
            'partner_identity_type' => [
                'sometimes',
                'required',
            ],
            'partner_identity_number' => [
                'sometimes',
                'required',
                'min:16',
            ],
            'guarantor_name' => [
                'sometimes',
                'required',
            ],
            'guarantor_identity_type' => [
                'sometimes',
                'required',
            ],
            'guarantor_identity_number' => [
                'sometimes',
                'required',
                'min:16',
            ],
            'business_name' => [
                'sometimes',
                'required',
            ],
            'business_identity_number' => [
                'sometimes',
                'required',
                'min:16',
            ],
            'shareholder_name' => [
                'sometimes',
                'required',
            ],
            'shareholder_identity_type' => [
                'sometimes',
                'required',
            ],
            'shareholder_identity_number' => [
                'sometimes',
                'required',
                'min:16',
            ],
            'attr_dealer_text' => [
                'required',
            ],
            'attr_sales_name' => [
                'string',
                'required',
            ],
            'attr_product_text' => [
                'required',
            ],
            'attr_brand_text' => [
                'required',
            ],
            'attr_models' => [
                'string',
                'required',
            ],
            'attr_number_of_units' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'attr_otr' => [
                'required',
            ],
            'attr_debt_principal' => [
                'string',
                'required',
            ],
            'attr_insurance_text' => [
                'required',
            ],
            'attr_down_payment_text' => [
                'string',
                'required',
            ],
            'attr_tenors_text' => [
                'required',
            ],
            'attr_addm_addb' => [
                'string',
                'required',
            ],
            'attr_effective_rates' => [
                'numeric',
                'required',
            ],
            'attr_debtor_phone' => [
                'string',
                'required',
            ],
            'id_photos' => [
                'array',
                'required',
            ],
            'id_photos.*' => [
                'required',
            ],
            'kk_photos' => [
                'array',
                'required',
            ],
            'kk_photos.*' => [
                'required',
            ],
            'npwp_photos' => [
                'array',
                'required',
            ],
            'npwp_photos.*' => [
                'required',
            ],
            'other_photos' => [
                'array',
                'required',
            ],
            'other_photos.*' => [
                'required',
            ],
            'remarks' => [
                'string',
                'nullable',
            ],
        ];
    }
}
