<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserTenant extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'user_tenants';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'code',
        'parent_id',
        'user_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function parent()
    {
        return $this->belongsTo(User::class, 'parent_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
