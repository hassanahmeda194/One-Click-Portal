<?php

namespace App\Models\BasicModels;

use App\Models\Auth\User;
use App\Models\Permissions\ModulePermissions;
use App\Models\Permissions\OtherPermissions;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class UserDesignations extends Model
{
    use HasFactory;
    protected $table = 'user_designations';
    protected $fillable = ['Designation_Name'];

    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'Role_ID');
    }

    public function module_permission(): HasOne
    {
        return $this->hasOne(ModulePermissions::class, 'role_id');
    }

    public function other_permission(): HasOne
    {
        return $this->hasOne(OtherPermissions::class, 'role_id');
    }

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
