<?php

namespace App\Http\Livewire\LeaveEntitlements;

use App\Models\Auth\User;
use App\Models\LeaveEntitlements\LeaveSetting;
use App\Services\LeaveEntitlementService;
use Livewire\Component;

class UserLeaveQuotaView extends Component
{
    protected LeaveEntitlementService $leaveEntitlementService;
    public function render()
    {
        $users_leaves  = User::with('leave_quota', 'basic_info')->get();
        return view('livewire.leave-entitlements.user-leave-quota-view', compact('users_leaves'))->layout('layouts.authorized');
    }
}