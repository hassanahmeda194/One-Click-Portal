<?php

namespace App\Models\Permissions;

use App\Models\BasicModels\UserDesignations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ModulePermissions extends Model
{
    use HasFactory;
    protected $table = "module_permissions";
    protected $fillable = [
        'role_id',
        'Research_view',
        'Research_list',
        'Research_create',
        'Research_edit',
        'Research_delete',
        'Research_detail',
        'Content_view',
        'Content_list',
        'Content_create',
        'Content_edit',
        'Content_delete',
        'Content_detail',
        'Website_view',
        'Website_list',
        'Website_create',
        'Website_edit',
        'Website_delete',
        'Website_detail',

        'home_Order_view',
        'home_Order_list',
        'home_Order_create',
        'home_Order_update',
        'home_Order_delete',
        'Confirmation_view',
        'Confirmation_list',
        'Confirmation_create',
        'Confirmation_update',
        'Confirmation_delete',
        'deadline_view',
        'deadline_list',
        'deadline_create',
        'deadline_update',
        'deadline_delete',
    ];
    public function user_role(): BelongsTo
    {
        return $this->belongsTo(UserDesignations::class, 'role_id');
    }
}
