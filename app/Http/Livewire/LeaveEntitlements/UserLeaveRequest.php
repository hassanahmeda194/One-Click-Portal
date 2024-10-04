<?php

namespace App\Http\Livewire\LeaveEntitlements;

use App\Helpers\PortalHelpers;
use App\Models\LeaveEntitlements\LeaveRequest;
use App\Models\LeaveEntitlements\UserLeaveQuota;
use App\Services\LeaveEntitlementService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class UserLeaveRequest extends Component
{
    protected LeaveEntitlementService $leaveEntitlementService;

    public function mount(LeaveEntitlementService $leaveEntitlementService): void
    {
        $this->leaveEntitlementService = $leaveEntitlementService;
    }

    public function render()
    {
        $Leave_Info = $this->leaveEntitlementService->getLeavesTypesList();
        $auth_id = Auth::guard('Authorized')->user()->id;
        $Leave_Quota = UserLeaveQuota::where('user_id', $auth_id)->first();
        return view('livewire.leave-entitlements.user-leave-request', compact('Leave_Info', 'Leave_Quota'))->layout('layouts.authorized');
    }

    public function postLeaveRequest(Request $request): RedirectResponse
    {
        $user_id = Auth::guard('Authorized')->user()->id;
        $F_Date = (!empty($request->F_Date)) ? date('Y-m-d', strtotime($request->F_Date)) : null;
        $L_Date = (!empty($request->L_Date)) ? date('Y-m-d', strtotime($request->L_Date)) : null;
        LeaveRequest::create([
            'Leave_Subject' => $request->Leave_Subject,
            'F_Date' => $F_Date,
            'L_Date' => $L_Date,
            'Leave_Reason' => $request->Leave_Reason,
            'Leave_Status' => $request->Leave_Status,
            'leave_id' => $request->Leave_Type,
            'user_id' => $user_id,
        ]);
        $authUser = Auth::guard('Authorized')->user();
        $orderid  = "leave_request";
        PortalHelpers::sendNotification(null,$orderid, "Leave Request has been submitted!", $authUser->designation->Designation_Name, [(int)$authUser->id], [1,2,14,15]);
        return back()->with('Success!', 'Leave Request has been Sent!');
    }
}
