<?php

namespace App\Models\ResearchOrders;

use App\Models\Auth\User;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OrderClientInfo extends Model
{
    use HasFactory;
    protected $table = "order_client_infos";
    protected $fillable = [
        'Client_Code',
        'Client_Name',
        'Client_Country',
        'Client_Email',
        'Client_Phone',
        'user_id'
    ];

    public function authorized_user():belongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function order_info():HasMany
    {
        return $this->hasMany(OrderInfo::class, 'order_id', 'user_id');
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
