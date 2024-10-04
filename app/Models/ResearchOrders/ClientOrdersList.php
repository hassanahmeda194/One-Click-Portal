<?php

namespace App\Models\ResearchOrders;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ClientOrdersList extends Model
{
    use HasFactory;
    protected $table = "client_orders_lists";
    protected $fillable = [
        'order_id',
        'client_id'
    ];

    public function client_info():belongsTo
    {
        return $this->belongsTo(OrderClientInfo::class, 'client_id');
    }

    public function order_info():HasMany
    {
        return $this->hasMany(OrderInfo::class, 'order_id');
    }

    // User DB Attribute
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
