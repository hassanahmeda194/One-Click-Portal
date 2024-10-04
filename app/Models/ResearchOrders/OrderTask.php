<?php

namespace App\Models\ResearchOrders;

use App\Helpers\PortalHelpers;
use App\Models\Auth\User;
use App\Models\Performance\UserWordsStats;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class OrderTask extends Model
{
    use HasFactory;
    protected $table = "order_tasks";
    protected $fillable = [
        'Assign_Words',
        'Total_Words',
        'Due_Words',
        'DeadLine',
        'DeadLine_Time',
        'Task_Status',
        'order_id',
        'assign_id',
        'assign_by'
    ];

    public function assign():belongsTo
    {
        return $this->belongsTo(User::class, 'assign_id');
    }

    public function assign_by():belongsTo
    {
        return $this->belongsTo(User::class, 'assign_by');
    }

    public function order_info():belongsTo
    {
        return $this->belongsTo(OrderInfo::class, 'order_id');
    }

    public function submit_info():HasMany
    {
        return $this->hasMany(OrderTaskSubmit::class, 'task_id');
    }

    public function revision():HasMany
    {
        return $this->hasMany(TaskRevision::class, 'task_id');
    }

    public function stats():HasOne
    {
        return $this->hasOne(UserWordsStats::class, 'task_id');
    }

    // User DB Attribute

    public function getTaskStatusAttribute()
    {
        return PortalHelpers::getOrderStatus($this->attributes['Task_Status']);
    }

    public function deadline(): Attribute
    {
        return new Attribute(
            get: fn ($value) => date('F d, Y', strToTime($value)),
            set: fn ($value) => $value,
        );
    }

    public function assignWords(): Attribute
    {
        return new Attribute(
            get: fn($value) => number_format($value),
            set: fn($value) => $value,
        );
    }
    public function totalWords(): Attribute
    {
        return new Attribute(
            get: fn($value) => number_format($value),
            set: fn($value) => $value,
        );
    }
    public function dueWords(): Attribute
    {
        return new Attribute(
            get: fn($value) => number_format($value),
            set: fn($value) => $value,
        );
    }

    public function createdAt(): Attribute
    {
        return new Attribute(
            get: fn ($value) => date('F d, Y', strToTime($value)),
            set: fn ($value) => $value,
        );
    }

    public function updatedAt(): Attribute
    {
        return new Attribute(
            get: fn ($value) => date('F d, Y', strToTime($value)),
            set: fn ($value) => $value,
        );
    }
}
