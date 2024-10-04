<?php

namespace App\Models\ResearchOrders;

use App\Helpers\PortalHelpers;
use App\Models\Auth\User;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class  OrderBasicInfo extends Model
{
    use HasFactory;

    protected $table = "order_basic_infos";
    protected $fillable = [
        'Order_Services',
        'Education_Level',
        'Pages_Count',
        'Word_Count',
        'Spacing',
        'Citation_Style',
        'Preferred_Language',
        'Sources',
        'Order_Website',
        'Order_Status',
        'order_id',
        'user_id',
        'client_id'
    ];

    public function authorized_user(): belongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function order_info(): belongsTo
    {
        return $this->belongsTo(OrderInfo::class, 'order_id', 'user_id');
    }

    // User DB Attribute
    public function getOrderStatusAttribute()
    {
        return PortalHelpers::getOrderStatus($this->attributes['Order_Status']);
    }

    public function scopeNotCompleted($query)
    {
        return $query->whereNot('Order_Status', 2);
    }

    public function pagesCount(): Attribute
    {
        return new Attribute(
            get: fn($value) => number_format($value),
            set: fn($value) => $value,
        );
    }

   
    public function createdAt(): Attribute
    {
        return new Attribute(
            get: fn($value) => date('F d, Y', strToTime($value)),
            set: fn($value) => $value,
        );
    }

    public function updatedAt(): Attribute
    {
        return new Attribute(
            get: fn($value) => date('F d, Y', strToTime($value)),
            set: fn($value) => $value,
        );
    }
}
