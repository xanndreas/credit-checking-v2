<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WorkflowRequestCreditHistory extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'workflow_request_credit_histories';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'workflow_request_credit_id',
        'actor_id',
        'process_status',
        'process_notes',
        'attribute',
        'attribute_2',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function workflow_request_credit()
    {
        return $this->belongsTo(WorkflowRequestCredit::class, 'workflow_request_credit_id');
    }

    public function actor()
    {
        return $this->belongsTo(User::class, 'actor_id');
    }
}
