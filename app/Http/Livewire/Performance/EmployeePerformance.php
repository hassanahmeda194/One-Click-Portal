<?php

namespace App\Http\Livewire\Performance;

use App\Models\Auth\User;
use App\Models\Performance\WriterPerformance;
use App\Services\UsersPerformanceService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use SebastianBergmann\CodeCoverage\Util\Percentage;

class EmployeePerformance extends Component
{
    public function render(Request $request)
    {
        $authUser = Auth::guard('Authorized')->user();
        $start_date = $request->filled('start_date') ? $request->start_date : Carbon::now()->startOfMonth();
        $end_date = $request->filled('end_date') ? $request->end_date : Carbon::now()->endOfMonth();
        $currentMonth = Carbon::now()->month;
        $userArray = [];
        if ($authUser->Role_ID == 1) {
            
            $userArray = [5, 7, 8, 12];
            
        } elseif ($authUser->Role_ID == 17) {
            
            $userArray = [8, 12];
            
        } elseif ($authUser->Role_ID == 4) {
            
            $userArray = [5, 7];
            
        }
        $User_Performance = User::with(['basic_info', 'performance' => function ($q)  use ($start_date, $end_date) {
            $q->whereDate('created_at', '>=', $start_date)
                ->whereDate('created_at', '<=', $end_date);
        }, 'bench_mark'])
            ->whereIn('Role_ID', $userArray)
            ->whereHas('performance', function ($q) use ($start_date, $end_date) {
                $q->whereDate('created_at', '>=', $start_date)
                    ->whereDate('created_at', '<=', $end_date);
            })
            ->get();
        $totalAchievedWordCount = 0;
        $totalCancelWordCount = 0;
        foreach ($User_Performance as $user) {
            $totalAchievedWordCount += $user->performance->sum('achieved_word');
            $totalCancelWordCount += $user->performance->sum('cancel_word');
        }
        $totalBenchMarks = $User_Performance->flatMap(function ($user) {
            return $user->bench_mark->pluck('Bench_Mark');
        })->sum();
        $PerformancePercentage = ($totalAchievedWordCount * 100) / $totalBenchMarks;
        return view('livewire.performance.employee-performance', compact('User_Performance', 'totalBenchMarks', 'PerformancePercentage', 'totalAchievedWordCount', 'totalCancelWordCount'))
            ->layout('layouts.authorized');
    }

    public function getuserPermanceDetails(Request $request)
    {
        $id = $request->id;
        $currentMonth = Carbon::now()->month;
        $start_date = $request->filled('start_date') ? $request->start_date : Carbon::now()->startOfMonth();
        $end_date = $request->filled('end_date') ? $request->end_date : Carbon::now()->endOfMonth();
        $UserData = User::with([
            'performance' => function ($q) use ($start_date, $end_date) {
                $q->whereDate('created_at', '>=', $start_date)
                    ->whereDate('created_at', '<=', $end_date);
            }, 'bench_mark'
        ])->whereHas('performance', function ($q) use ($start_date, $end_date) {
            $q->with('order_info')
                ->whereDate('created_at', '>=', $start_date)
                ->whereDate('created_at', '<=', $end_date);
        })->where('id', $id)->first();

        $totalBenchMark = 0;
        if ($UserData) {
            $totalBenchMark = $UserData->bench_mark->sum('Bench_Mark');
        }

        $totalAchievedWord = 0;
        if ($UserData && $UserData->performance) {
            $totalAchievedWord = $UserData->performance->sum('achieved_word');
        }
        $currentMonth = Carbon::now();
        $lastSixMonthData = User::with(['performance' => function ($q) use ($currentMonth) {
            $q->whereYear('created_at', $currentMonth->year)
                ->whereMonth('created_at', '<=', $currentMonth->month);
        }, 'bench_mark'])
            ->whereHas('performance', function ($q) use ($currentMonth) {
                $q->whereYear('created_at', $currentMonth->year)
                    ->whereMonth('created_at', '<=', $currentMonth->month);
            })
            ->where('id', $id)
            ->first();
        $monthlyPerformanceSum = [];
        if ($lastSixMonthData) {
            foreach ($lastSixMonthData->performance as $performance) {
                $monthNumber = date('m', strtotime($performance['created_at']));
                $year = date('Y', strtotime($performance['created_at']));
                $monthYear = $monthNumber;
                if (!isset($monthlyPerformanceSum[$monthYear])) {
                    $monthlyPerformanceSum[$monthYear] = 0;
                }
                $monthlyPerformanceSum[$monthYear] += $performance['achieved_word'];
            }
        }
        return view('partials.performance.modal', compact('UserData', 'totalBenchMark', 'totalAchievedWord', 'monthlyPerformanceSum'))->render();
    }
}
