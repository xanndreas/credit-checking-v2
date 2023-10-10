<?php

namespace App\Exports;

use App\Http\Controllers\Traits\TenantTrait;
use App\Models\RequestCredit;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class CreditCheckingExport implements FromQuery, WithHeadings, WithMapping
{
    use Exportable, TenantTrait;

    private Carbon|false $maxDate;
    private Carbon|false $minDate;

    public function __construct(string $minDate, string $maxDate)
    {
        $this->minDate = Carbon::createFromFormat('Y-m-d H:i:s', $minDate);;
        $this->maxDate = Carbon::createFromFormat('Y-m-d H:i:s', $maxDate);;
    }

    public function query()
    {
        $requestCredit = RequestCredit::with(['auto_planner', 'request_debtors', 'request_attributes'])
            ->whereBetween('created_at', [$this->minDate, $this->maxDate]);

        if (Gate::allows('actor_auto_planner_access')) {
            $requestCredit->whereRelation('auto_planner', 'id', Auth::id());
        } else if (Gate::allows('request_credit_super')) {
            // do nothing
        } else {
            $child = $this->tenantChildUser(User::with('roles')
                ->find(Auth::id())->firstOrFail());

            $requestCredit->whereHas('auto_planner',
                fn($q) => $q->whereIn('id', $child == null ? [] : $child));
        }

        return $requestCredit;
    }

    public function headings(): array
    {
        return [
            'Timestamp',
            'Email Address',
            'NAMA AUTO PLANNER',
            'Individu / Badan Usaha',
            'Nama Calon Debitur Individu/Badan Usaha',
            'Jenis Identitas',
            'Nomer Identitas Calon Debitur',
            'Nama Pasangan',
            'Nomer Identitas Pasangan',
            'Nama Penjamin',
            'Nomer Identitas Penjamin',
            'Nama Pemegang Saham / Pengurus',
            'Nomer Identitas Pemegang Saham / Pengurus',
            'Dealer',
            'Produk',
            'Brand',
            'Model (yang lengkap)',
            'Tahun Mobil',
            'Jumlah Unit',
            'OTR',
            'Pokok Hutang',
            'Asuransi',
            'Down Payment',
            'Tenor (tahun)',
            'ADDM / ADDB',
            'RATE (Bunga) Effective',
            'Nomer HP Calon Debitur',
            'REMARKS',
            'UPLOAD KTP, KK, NPWP, DLL',
            'Nama Pemegang Saham / Pengurus',
            'Nomer Identitas Pemegang Saham / Pengurus',
            'Nama Sales'
        ];
    }

    public function map($row): array
    {
        $requestMedia = null;
        foreach ($row->id_photos as $id_photo) {
            $requestMedia .= $id_photo->getUrl() . ', ';
        }
        foreach ($row->kk_photos as $kk_photo) {
            $requestMedia .= $kk_photo->getUrl() . ', ';
        }
        foreach ($row->npwp_photos as $npwp_photo) {
            $requestMedia .= $npwp_photo->getUrl() . ', ';
        }
        foreach ($row->other_photos as $other_photo) {
            $requestMedia .= $other_photo->getUrl() . ', ';
        }

        return [
            $row->created_at,
            $row->auto_planner->email,
            $row->auto_planner->name,
            RequestCredit::CREDIT_TYPE_SELECT[$row->credit_type],
            $this->attribute_finder($row->request_attributes, 'dealer_text'),
            $this->debtor_finder($row->request_debtors, 'debtor')->name ?? '',
            $this->debtor_finder($row->request_debtors, 'debtor')->identity_type ?? '',
            $this->debtor_finder($row->request_debtors, 'debtor')->identity_number ?? '',
            $this->debtor_finder($row->request_debtors, 'debtor_partner')->name ?? '',
            $this->debtor_finder($row->request_debtors, 'debtor_partner')->identity_number ?? '',
            $this->debtor_finder($row->request_debtors, 'guarantor')->name ?? '',
            $this->debtor_finder($row->request_debtors, 'guarantor')->identity_number ?? '',
            $this->debtor_finder($row->request_debtors, 'shareholder')->identity_number ?? '',
            $this->attribute_finder($row->request_attributes, 'dealer_text'),
            $this->attribute_finder($row->request_attributes, 'product_text'),
            $this->attribute_finder($row->request_attributes, 'brand_text'),
            $this->attribute_finder($row->request_attributes, 'models'),
            $this->attribute_finder($row->request_attributes, 'car_year'),
            $this->attribute_finder($row->request_attributes, 'number_of_units'),
            $this->attribute_finder($row->request_attributes, 'otr'),
            $this->attribute_finder($row->request_attributes, 'debt_principal'),
            $this->attribute_finder($row->request_attributes, 'insurance_text'),
            $this->attribute_finder($row->request_attributes, 'down_payment_text'),
            $this->attribute_finder($row->request_attributes, 'tenors_text'),
            $this->attribute_finder($row->request_attributes, 'addm_addb'),
            $this->attribute_finder($row->request_attributes, 'effective_rates'),
            $this->attribute_finder($row->request_attributes, 'debtor_phone'),
            $this->attribute_finder($row->request_attributes, 'remarks'),
            $requestMedia,
            $this->debtor_finder($row->request_debtors, 'shareholder')->name ?? '',
            $this->debtor_finder($row->request_debtors, 'shareholder')->identity_number ?? '',
            $row->auto_planner->name
        ];
    }

    public function attribute_finder($attribute, $to_find)
    {
        $attrs = $attribute->filter(function ($item) use ($to_find) {
            return $item->object_name == $to_find;
        })->first();

        return $attrs ? $attrs->attribute : '';
    }

    public function debtor_finder($debtor, $to_find)
    {
        return $debtor->filter(function ($item) use ($to_find) {
            return $item->personel_type == $to_find;
        })->first();
    }
}
