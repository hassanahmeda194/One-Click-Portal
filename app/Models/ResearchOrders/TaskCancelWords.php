<?php

namespace App\Models\ResearchOrders;

use App\Models\Auth\User;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TaskCancelWords extends Model
{
    use HasFactory;
    protected $table = "task_cancel_words";
    protected $fillable = [
        'Comments',
        'task_id',
        'order_id',
        'cancel_by'
    ];

    public function cancel():belongsTo
    {
        return $this->belongsTo(User::class, 'cancel_by');
    }

    public function order_info():belongsTo
    {
        return $this->belongsTo(OrderInfo::class, 'order_id');
    }

    public function task_info():belongsTo
    {
        return $this->belongsTo(OrderTask::class, 'task_id');
    }

    // User DB Attribute

    public function createdAt(): Attribute
    {
        return new Attribute(
            get: fn ($value) => date('F d, Y H:i:s A', strToTime($value)),
            set: fn ($value) => $value,
        );
    }

    public function updatedAt(): Attribute
    {
        return new Attribute(
            get: fn ($value) => date('F d, Y H:i:s A', strToTime($value)),
            set: fn ($value) => $value,
        );
    }
}
