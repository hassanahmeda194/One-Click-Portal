<?php

namespace App\Models\LeaveEntitlements;

use App\Helpers\PortalHelpers;
use App\Models\Auth\User;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LeaveRequest extends Model
{
    use HasFactory;
    protected $table = "leave_requests";
    protected $fillable = ['Leave_Subject', 'F_Date', 'L_Date', 'Leave_Reason', 'approved_by', 'leave_id', 'user_id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function leave(): BelongsTo
    {
        return $this->belongsTo(LeaveSetting::class, 'leave_id');
    }

    // User DB Attribute
    public function getLeaveStatusAttribute()
    {
            return PortalHelpers::getAttendanceStatus($this->attributes['Leave_Status']);    
        
    }

    public function createdAt(): Attribute
    {
        return new Attribute(
            get: fn($value) => date('F d, Y H:i:s A', strToTime($value)),
            set: fn($value) => $value,
        );
    }

    public function updatedAt(): Attribute
    {
        return new Attribute(
            get: fn($value) => date('F d, Y H:i:s A', strToTime($value)),
            set: fn($value) => $value,
        );
    }
}
