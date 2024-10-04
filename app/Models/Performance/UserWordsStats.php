<?php

namespace App\Models\Performance;

use App\Models\ResearchOrders\OrderInfo;
use App\Models\ResearchOrders\OrderTask;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserWordsStats extends Model
{
    use HasFactory;
    protected $table = "user_words_stats";
    protected $fillable = [
        'Completed',
        'task_id',
        'order_id',
        'Canceled',
        'user_id'
    ];

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
