<?php

namespace App\Models\ResearchOrders;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ResearchOrderSubmissionDeadline extends Model
{
    use HasFactory;

    protected $table = "research_order_submission_deadlines";
    protected $fillable = [
        'DeadLines',
        'is_Submit',
        'submit_at',
        'order_id',
        'submit_by',
    ];

    public function order_info(): belongsTo
    {
        return $this->belongsTo(OrderInfo::class, 'order_id', 'user_id');
    }

    public function deadlines(): Attribute
    {
        return new Attribute(
            get: fn($value) => date('F d, Y', strToTime($value)),
            set: fn($value) => $value,
        );
    }
}
