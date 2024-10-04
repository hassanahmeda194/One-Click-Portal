<?php

namespace App\Http\Livewire\Performance;

use App\Models\Auth\User;
use App\Services\UsersPerformanceService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Livewire\Component;

class UserPerformance extends Component
{
    protected UsersPerformanceService $performanceService;

    public function mount(UsersPerformanceService $performanceService): void
    {
        $this->performanceService = $performanceService;
    }

    public function render(Request $request)
    {
        $Role_ID = (int) Crypt::decryptString($request->Role_ID);
        $EMP_ID = Crypt::decryptString($request->EMP_ID);
        $start_date = $request->filled('start_date') ? $request->start_date : now()->startOfMonth();
        $end_date = $request->filled('end_date') ? $request->end_date : now()->endOfMonth();
        $User_Performance = User::with([
            'performance' => function ($q) use ($start_date, $end_date) {
                $q->whereDate('created_at', '>=', $start_date)
                    ->whereDate('created_at', '<=', $end_date);
            }, 'bench_mark'
        ])
            ->where('Emp_ID', $EMP_ID)
            ->first();

        return view('livewire.performance.user-performance', compact('User_Performance', 'Role_ID', 'EMP_ID'))->layout('layouts.authorized');
    }
}
