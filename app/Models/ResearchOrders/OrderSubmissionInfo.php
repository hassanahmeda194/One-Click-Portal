<?php

namespace App\Models\ResearchOrders;

use App\Models\Auth\User;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderSubmissionInfo extends Model
{
    use HasFactory;
    protected $table = "order_submission_infos";
    protected $fillable = [
        'DeadLine',
        'DeadLine_Time',
        'F_DeadLine',
        'S_DeadLine',
        'T_DeadLine',
        'Four_DeadLine',
        'Fifth_DeadLine',
        'Sixth_DeadLine',
        'Seven_DeadLine',
        'Eight_DeadLine',
        'nine_DeadLine',
        'ten_DeadLine',
        'eleven_DeadLine',
        'twelve_DeadLine',
        'thirteen_DeadLine',
        'fourteen_DeadLine',
        'fifteen_DeadLine',
        'order_id',
        'user_id',
        'client_id'
    ];


    public function authorized_user(): belongsTo
    {
        return $this->belongsTo(User::class, 'user_id')->withTrashed();
    }

    public function order_info(): belongsTo
    {
        return $this->belongsTo(OrderInfo::class, 'order_id', 'user_id');
    }
    public function order_infos(): belongsTo
    {
        return $this->belongsTo(OrderInfo::class, 'order_id');
    }

    // User DB Attribute
    public function deadLine(): Attribute
    {
        return new Attribute(
            get: fn ($value) => date('F d, Y', strToTime($value)),
            set: fn ($value) => $value,
        );
    }

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
