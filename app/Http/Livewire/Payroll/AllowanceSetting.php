<?php

namespace App\Http\Livewire\Payroll;

use App\Models\Auth\User;
use App\Models\Payroll\AllowanceSetting as PayrollAllowanceSetting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Livewire\Component;

class AllowanceSetting extends Component
{
    public function render()
    {
        $users = User::with('basic_info')->get();
        $Allowances = PayrollAllowanceSetting::with('user.basic_info')->whereDate('month', Carbon::now()->format('Y-m'))->get();
        return view('livewire.payroll.allowance-setting', compact('users', 'Allowances'))->layout('layouts.authorized');
    }

    public function submitAllowanceSetting(Request $request)
    {
        $request->validate([
            'allowance_name' => 'required',
            'amount' => 'required',
            'month' => 'required',
        ]);
        if ($request->has('all_employee')) {
            $users = User::pluck('id');
            $allowanceData = $users->map(function ($userId) use ($request) {
                return [
                    'allowance_name' => $request->allowance_name,
                    'amount' => $request->amount,
                    'month' => $request->month,
                    'user_id' => $userId,
                ];
            });
            PayrollAllowanceSetting::insert($allowanceData->toArray());
            return back()->with('success', 'Allowance added successfully for all employees!');
        } else {
            PayrollAllowanceSetting::create([
                'allowance_name' => $request->allowance_name,
                'amount' => $request->amount,
                'month' => $request->month,
                'user_id' => $request->user_id,
            ]);
            return back()->with('success', 'Allowance added successfully for the selected user!');
        }
    }

    public function deleteAllowance($id)
    {
        try {
            $allowance = PayrollAllowanceSetting::find($id);
            if ($allowance) {
                $allowance->delete();
                return back()->with('Success!', 'Allowance deleted successfully!');
            } else {
                return back()->with('Error!', 'Allowance not found!');
            }
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to delete allowance!');
        }
    }
}
