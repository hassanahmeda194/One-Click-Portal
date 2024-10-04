<?php

namespace App\Models\LeaveEntitlements;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveSetting extends Model
{
    use HasFactory;

    protected $table = "leave_settings";
    protected $fillable = ['Leave_Type', 'Leave_Numbers'];

    // User DB Attribute
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
