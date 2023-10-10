<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class RequestCredit extends Model implements HasMedia
{
    use SoftDeletes, HasFactory, InteractsWithMedia;

    public $table = 'request_credits';

    protected $appends = [
        'id_photos',
        'kk_photos',
        'npwp_photos',
        'other_photos',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const CREDIT_TYPE_SELECT = [
        'individu'    => 'Individu',
        'badan_usaha' => 'Badan Usaha',
    ];

    public const REQUEST_ATTRIBUTE_FIELDS = [
        'dealer_text',
        'dealer_other',
        'sales_name',
        'product_text',
        'product_text_other',
        'brand_text',
        'brand_text_other',
        'models',
        'number_of_units',
        'otr',
        'debt_principal',
        'insurance_text',
        'down_payment_text',
        'down_payment_text_other',
        'addm_addb',
        'effective_rates',
        'car_year',
        'debtor_phone',
        'remarks',
        'tenors_text',
    ];

    protected $fillable = [
        'batch_number',
        'credit_type',
        'auto_planner_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function auto_planner()
    {
        return $this->belongsTo(User::class, 'auto_planner_id');
    }

    public function request_debtors()
    {
        return $this->belongsToMany(RequestCreditDebtor::class);
    }

    public function request_attributes()
    {
        return $this->belongsToMany(RequestCreditAttribute::class);
    }

    public function getIdPhotosAttribute()
    {
        $files = $this->getMedia('id_photos');
        $files->each(function ($item) {
            $item->url = $item->getUrl();
            $item->thumbnail = $item->getUrl('thumb');
            $item->preview = $item->getUrl('preview');
        });

        return $files;
    }

    public function getKkPhotosAttribute()
    {
        $files = $this->getMedia('kk_photos');
        $files->each(function ($item) {
            $item->url = $item->getUrl();
            $item->thumbnail = $item->getUrl('thumb');
            $item->preview = $item->getUrl('preview');
        });

        return $files;
    }

    public function getNpwpPhotosAttribute()
    {
        $files = $this->getMedia('npwp_photos');
        $files->each(function ($item) {
            $item->url = $item->getUrl();
            $item->thumbnail = $item->getUrl('thumb');
            $item->preview = $item->getUrl('preview');
        });

        return $files;
    }

    public function getOtherPhotosAttribute()
    {
        $files = $this->getMedia('other_photos');
        $files->each(function ($item) {
            $item->url = $item->getUrl();
            $item->thumbnail = $item->getUrl('thumb');
            $item->preview = $item->getUrl('preview');
        });

        return $files;
    }
}
