<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RequestCreditDebtor extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'request_credit_debtors';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const IDENTITY_TYPE_SELECT = [
        'ktp'      => 'KTP',
        'passport' => 'Passport',
        'npwp'     => 'NPWP',
    ];

    protected $fillable = [
        'personel_type',
        'name',     
        'identity_type',
        'identity_number',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const PERSONEL_TYPE_SELECT = [
        'debtor'         => 'Debtor',
        'debtor_partner' => 'Debtor Partner',
        'guarantor'      => 'Guarantor',
        'guarantor_partner' => 'Guarantor Partner',
        'business'       => 'Business',
        'shareholder'    => 'Shareholder',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
