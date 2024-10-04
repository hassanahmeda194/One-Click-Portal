<?php

namespace App\Http\Livewire\LeaveEntitlements;

use App\Models\LeaveEntitlements\LeaveSetting;
use App\Services\LeaveEntitlementService;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Livewire\Component;

class LeaveSettings extends Component
{
    protected LeaveEntitlementService $leaveEntitlementService;
    public function mount(LeaveEntitlementService $leaveEntitlementService): void
    {
        $this->leaveEntitlementService = $leaveEntitlementService;
    }
    public function render()
    {
        $Leave_Info = $this->leaveEntitlementService->getLeavesTypesList();
        return view('livewire.leave-entitlements.leave-settings', compact('Leave_Info'))->layout('layouts.authorized');
    }

    public function postLeaveInfo(Request $request): RedirectResponse
    {
        LeaveSetting::create([
            'Leave_Type' => $request->Leave_Type,
            'Leave_Numbers' => $request->Leave_Numbers
        ]);
        return back()->with('Success!', 'Leave has been Submitted!');
    }

    public function updateLeaveSetting(Request $request): RedirectResponse
    {
        $Leave_ID = $request->Leave_ID;
        LeaveSetting::where('id', $Leave_ID)->update([
            'Leave_Type' => $request->Leave_Type,
            'Leave_Numbers' => $request->Leave_Numbers
        ]);
        return back()->with('Success!', 'Leave has been Updated!');
    }

    public function deleteLeaveInfo(Request $request): RedirectResponse
    {
        $Leave_ID = $request->Leave_ID;
        LeaveSetting::where('id', $Leave_ID)->delete();
        return back()->with('Success!', 'Leave has been Deleted!');
    }
}
