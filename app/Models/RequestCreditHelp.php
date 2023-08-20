<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RequestCreditHelp extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'request_credit_helps';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'type',
        'attribute',
        'attribute_2',
        'attribute_3',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const TYPE_SELECT = [
        'brands'        => 'Brands',
        'dealers'       => 'Dealer',
        'insurances'    => 'Insurances',
        'products'      => 'Products',
        'tenors'        => 'Tenors',
        'years'         => 'Years',
        'placeholders'  => 'Placeholders',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
