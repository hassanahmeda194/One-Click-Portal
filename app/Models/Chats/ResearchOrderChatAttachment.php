<?php

namespace App\Models\Chats;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ResearchOrderChatAttachment extends Model
{
    use HasFactory;
    protected $table = "research_order_chat_attachments";
    protected $fillable = [
        'File_Name',
        'file_path',
        'msg_id'
    ];

    public function chat(): BelongsTo
    {
        return $this->belongsTo(ResearchOrderChat::class, 'msg_id');
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
