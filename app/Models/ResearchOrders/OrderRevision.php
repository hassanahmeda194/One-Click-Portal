<?php

namespace App\Models\ResearchOrders;

use App\Models\Auth\User;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OrderRevision extends Model
{
    use HasFactory;
    protected $table = "order_revisions";
    protected $fillable = [
        'Order_Revision',
        'order_id',
        'revised_by'
    ];

    public function revision_by():belongsTo
    {
        return $this->belongsTo(User::class, 'revised_by');
    }

    public function order_info():belongsTo
    {
        return $this->belongsTo(OrderInfo::class, 'order_id');
    }

    public function attachments():HasMany
    {
        return $this->hasMany(OrderRevisionAttachments::class, 'revision_id');
    }
    
    public function SubmitAttachment():HasMany
    {
        return $this->hasMany(SubmitRevisionAttachment::class, 'revision_id');
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
