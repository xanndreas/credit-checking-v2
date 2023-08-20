<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WorkflowRequestCredit extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'workflow_request_credits';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'request_credit_batch',
        'request_credit_id',
        'last_change_by_id',
        'process_status_id',
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

    public function last_change_by()
    {
        return $this->belongsTo(User::class, 'last_change_by_id');
    }

    public function process_status()
    {
        return $this->belongsTo(WorkflowProcess::class, 'process_status_id');
    }
}
