<?php

namespace App\Models\ContentOrders;

use App\Helpers\PortalHelpers;
use App\Models\Auth\User;
use App\Models\ResearchOrders\OrderInfo;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class  ContentBasicInfo extends Model
{
    use HasFactory;
    protected $table = "content_basic_infos";
    protected $fillable = [
        'Content_Title',
        'Industry_Name',
        'Writing_Style',
        'Preferred_Voice',
        'Target_Audience',
        'Target_Gender',
        'Free_Image',
        'Generic_Type',
        'Preferred_Language',
        'Keywords',
        'Meta_Description',
        'Reference_Link',
        'Order_Services',
        'Word_Count',
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

    public function getTargetAudienceAttribute()
    {
        return PortalHelpers::getTargetAudienceGender($this->attributes['Target_Audience']);
    }

    public function getTargetGenderAttribute()
    {
        return PortalHelpers::getTargetAudienceGender($this->attributes['Target_Gender']);
    }

    public function getFreeImageAttribute()
    {
        return PortalHelpers::getFreeImage($this->attributes['Free_Image']);
    }

    public function scopeNotCompleted($query)
    {
        return $query->whereNot('Order_Status', 2);
    }

    public function wordCount(): Attribute
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
