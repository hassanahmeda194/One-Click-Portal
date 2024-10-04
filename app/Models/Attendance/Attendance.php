<?php

namespace App\Models\Attendance;

use App\Helpers\PortalHelpers;
use App\Models\Auth\User;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Attendance extends Model
{
    use HasFactory;
    protected $table = "attendances";
    protected $fillable = ['user_id','ip_address', 'check_in', 'check_out', 'status', 'total_time', 'created_at'];
    public function user():belongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getStatusAttribute()
    {
        return PortalHelpers::getAttendanceStatus($this->attributes['status'] , $this->created_at);
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
