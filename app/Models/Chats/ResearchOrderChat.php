<?php

namespace App\Models\Chats;

use App\Models\Auth\User;
use App\Models\ResearchOrders\OrderInfo;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ResearchOrderChat extends Model
{
    use HasFactory;
    protected $table = "research_order_chats";
    protected $fillable = [
        'User_Message',
        'is_executive',
        'order_id',
        'user_id'
    ];
    protected $casts = [
        'is_executive' => 'integer',
    ];


    public function authorized_user():belongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function order_info():belongsTo
    {
        return $this->belongsTo(OrderInfo::class, 'order_id');
    }

    public function attachments():HasMany
    {
        return $this->hasMany(ResearchOrderChatAttachment::class, 'msg_id');
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
