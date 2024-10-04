<?php

namespace App\Models\Auth;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserLeaveInfo extends Model
{
    use HasFactory;
    protected $table = "user_leave_infos";
    protected $fillable = [
        'Sick_Leaves',
        'Annual_Leaves',
        'Casual_Leaves',
        'Off_Day',
        'Un_Paid',
        'user_id'
    ];

    public function authorized_user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id');
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
