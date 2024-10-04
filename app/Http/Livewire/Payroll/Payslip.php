<?php

namespace App\Http\Livewire\Payroll;

use App\Models\Attendance\Attendance;
use App\Models\Auth\User;
use App\Models\Payroll\AllowanceSetting;
use App\Models\Payroll\DetactionSetting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Livewire\Component;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\Auth;

class Payslip extends Component
{
    public function render()
    {
        $users = User::with('basic_info')->get();
        $currect_joining_date = Carbon::parse(auth()->guard('Authorized')->user()->basic_info->Join_Date)->format('Y-m');
        return view('livewire.payroll.payslip', compact('users', 'currect_joining_date'))->layout('layouts.authorized');
    }
    public function SubmitGeneratePayslip(Request $request)
    {
        
        if ($request->month === Carbon::now()->format('Y-m')) {
            return back()->with('Error!', 'Payslip for the current month will be generated after the month ends.');
        }
        $user = User::with(['basic_info', 'designation'])->find($request->user_id);
        if (!$user) {
            return back()->with('Error!', 'User not found.');
        }
        $basicSalarywithoutDetaction = $user->basic_info->Basic_Salary;
        $basicSalary = $user->basic_info->Basic_Salary;

        $unpaidDetaction = DetactionSetting::find(1);
        $halfDetaction = DetactionSetting::find(3);

        $allowance = AllowanceSetting::where('month', Carbon::parse($request->month)->format('Y-m'))
            ->where('user_id', $user->id)
            ->first();
        $monthlyAllowance = $allowance ? $allowance->amount : 0;

        $attendances = Attendance::where('user_id', $user->id)
            ->whereYear('created_at', Carbon::parse($request->month)->year)
            ->whereMonth('created_at', Carbon::parse($request->month)->month)
            ->get();
        $unpaid_Leave_Count = 0;
        $halfDay_Count = 0;
        $halfdayDetactAmmount = 0;
        $oneDaySalary = $basicSalary / 30;
        foreach ($attendances as $attendance) {
            switch ($attendance->status) {
                case 'UnPaid':
                    $unpaid_Leave_Count += 1;
                    $basicSalary -= ($oneDaySalary / $unpaidDetaction->detact_amount * 100);
                    break;
                case 'Halfday':
                    $halfDay_Count += 1;
                    $basicSalary -= ($oneDaySalary / $halfDetaction->detact_amount * 100);
                    break;
            }
        }
        $salaryMinusLeave = $basicSalary;
        $DetactedAmount = $basicSalarywithoutDetaction - $basicSalary;
        $salarywithBonus = $basicSalary + $monthlyAllowance;
        $leaveDetact = $oneDaySalary  * $unpaid_Leave_Count;
        $percentage = $halfDetaction->detact_amount  / 100;
        $halfdaydetaction = 0;
        if ($halfDay_Count != 0) {
            $halfdaydetaction = ($oneDaySalary * $percentage) / $halfDay_Count;
        }
        $currentMonth = date('M, Y', strtotime($request->month));
        $html = view('pdf.payslip', compact('user', 'basicSalarywithoutDetaction', 'salarywithBonus', 'monthlyAllowance', 'unpaid_Leave_Count', 'salaryMinusLeave', 'currentMonth', 'DetactedAmount', 'halfDay_Count', 'halfdayDetactAmmount', 'leaveDetact', 'halfdaydetaction'))->render();
        $pdf = new Dompdf();
        $pdf->loadHtml($html);
        $pdf->setPaper('A4', 'portrait');
        $pdf->render();
        return $pdf->stream('payslip.pdf');
    }
}
