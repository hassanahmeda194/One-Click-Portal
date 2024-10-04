<?php

namespace App\Models\Auth;

use App\Models\BasicModels\Departments;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserBasicInfo extends Model
{
    use HasFactory;
    protected $table = "user_basic_infos";
    protected $fillable = [
        'F_Name',
        'L_Name',
        'Phone_Number',
        'CNIC_Number',
        'Join_Date',
        'Dep_ID',
        'EMP_Status',
        'Job_Type',
        'Basic_Salary',
        'DOB',
        'user_id',
         'Probation_Period'
    ];

    public function authorized_user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function department():belongsTo
    {
        return $this->belongsTo(Departments::class, 'Dep_ID');
    }

    public function getFullNameAttribute(): string
    {
        return $this->attributes['F_Name'] . ' ' . $this->attributes['L_Name'];
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
