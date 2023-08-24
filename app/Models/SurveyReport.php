<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class SurveyReport extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia, HasFactory;

    public $table = 'survey_reports';

    protected $appends = [
        'attachments',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'request_credit_id',
        'survey_address_id',
        'submited_by_id',
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

    public function request_credit()
    {
        return $this->belongsTo(RequestCredit::class, 'request_credit_id');
    }

    public function survey_address()
    {
        return $this->belongsTo(SurveyAddress::class, 'survey_address_id');
    }

    public function survey_attributes()
    {
        return $this->belongsToMany(SurveyReportAttribute::class);
    }

    public function submited_by()
    {
        return $this->belongsTo(User::class, 'submited_by_id');
    }

    public function getAttachmentsAttribute()
    {
        $files = $this->getMedia('attachments');
        $files->each(function ($item) {
            $item->url = $item->getUrl();
            $item->thumbnail = $item->getUrl('thumb');
            $item->preview = $item->getUrl('preview');
        });

        return $files;
    }
}
