<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SurveyAddress extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'survey_addresses';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const ADDRESS_TYPE_SELECT = [
        'domicile' => 'Domicile',
        'guarantor' => 'Guarantor',
        'office'   => 'Office',
    ];

    public const ADDRESS_TYPE_SELECT_PERSONAL = [
        'domicile' => 'Domicile',
        'guarantor' => 'Guarantor',
        'office'   => 'Office',
        'other'    => 'Other',
    ];

    public const ADDRESS_TYPE_SELECT_BUSINESS = [
        'office'        => 'Office',
        'shareholder'   => 'Shareholders',
        'other'         => 'Other',
    ];

    protected $fillable = [
        'request_credit_id',
        'address_type',
        'addresses',
        'remarks',
        'surveyor_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function request_credit()
    {
        return $this->belongsTo(RequestCredit::class, 'request_credit_id');
    }

    public function surveyor()
    {
        return $this->belongsTo(User::class, 'surveyor_id');
    }
}
