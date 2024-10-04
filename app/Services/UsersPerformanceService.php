<?php

namespace App\Services;

use App\Models\Auth\User;
use Carbon\Carbon;
use Closure;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class UsersPerformanceService
{
    // Research Writer
    public function getResearchWriterPerformances(): Collection|array
    {
        return $this->getPerformances(User::with(['stats', 'basic_info', 'bench_mark'])->whereHas('stats')->whereIn('Role_ID', [6, 7]));
    }

    // Content Writer
    public function getContentWriterPerformances()
    {
        return $this->getPerformances(User::with(['stats', 'basic_info', 'bench_mark'])->whereHas('stats')->whereIn('Role_ID', [8, 12]));
    }

    protected function getPerformances($query)
    {
        $performances = $query
            ->with([
                'stats',
                'basic_info',
                'bench_mark'
            ])
            ->withSum('stats', 'Completed')
            ->withSum('stats', 'Canceled')
            ->get();

        return $performances->groupBy(function ($performance) {
            return Carbon::parse($performance->created_at)->format('Y-m');
        });
    }

    // Coordinator
    public function getCoordinatorPerformances()
    {
        $coordinators = User::where('Role_ID', 5)
            ->with(['writers' => $this->getWritersPerformanceQuery()])
            ->get();

        return $coordinators->map(function ($user) {
            return $this->calculatePerformance($user->writers, $user);
        });
    }

    protected function getWritersPerformanceQuery(): Closure
    {
        return static function ($query) {
            $query->with(['stats', 'basic_info', 'bench_mark'])
                ->withSum('stats', 'Completed')
                ->withSum('stats', 'Canceled')
                ->withSum('bench_mark', 'Bench_Mark')
                ->whereHas('stats')
                ->whereHas('basic_info');
        };
    }

    protected function calculatePerformance($writers, $user): array
    {
        $assign_task_sum_assign__words = $writers->sum('bench_mark_sum_bench__mark');
        $stats_sum_completed = $writers->sum('stats_sum_completed');
        $stats_sum_canceled = $writers->sum('stats_sum_canceled');

        $writers_performance = $writers->map(function ($writer) use ($user) {
            return [
                'EMP_ID' => $user->EMP_ID ?? null,
                'Name' => optional($user->basic_info)->full_name,
                'Assign_Words' => $writer->assign_task_sum_assign__words ?? 0,
                'Cancel_Words' => $writer->stats_sum_canceled ?? 0,
                'Achieve_Words' => $writer->stats_sum_completed ?? 0,
            ];
        });

        return [
            'EMP_ID' => $user->EMP_ID,
            'Name' => optional($user->basic_info)->full_name,
            'Writers' => $writers_performance,
            'Assign_Words' => $assign_task_sum_assign__words,
            'Cancel_Words' => $stats_sum_canceled,
            'Achieve_Words' => $stats_sum_completed,
        ];
    }

    public function getManagerPerformances()
    {
        $manager = User::where('Role_ID', 4)->first();
        return $this->getCoordinatorPerformances()->map(function ($item) use ($manager) {
            return $this->calculateManagerPerformance($item, $manager);
        });
    }

    protected function calculateManagerPerformance($item, $user): array
    {
        return [
            'EMP_ID' => $user->EMP_ID,
            'Name' => optional($user->basic_info)->full_name,
            'Assign_Words' => $item['Assign_Words'],
            'Cancel_Words' => $item['Cancel_Words'],
            'Achieve_Words' => $item['Achieve_Words'],
        ];
    }

    public function getUserPerformances($Role_ID, $EMP_ID)
    {
        return match ($Role_ID) {
            6, 7, 1 => User::with([
                'stats',
                'basic_info',
                'assign_task.order_info',
                'bench_mark' => function ($query) {
                    $query->latest('id');
                }
            ])
                ->whereHas('assign_task')
                ->where('EMP_ID', $EMP_ID)
                ->where('Role_ID', $Role_ID)
                ->first(),
            8, 12 => User::with([
                'stats',
                'basic_info',
                'bench_mark' => function ($query) {
                    $query->latest('id');
                }
            ])
                ->whereHas('stats')
                ->whereHas('basic_info')
                ->where('EMP_ID', $EMP_ID)
                ->where('Role_ID', $Role_ID)
                ->first(),
            5 => User::with([
                'stats',
                'basic_info',
                'writers.bench_mark' => function ($query) {
                    $query->latest('id');
                },
                'writers.assign_task.stats',
                'writers.assign_task.order_info',
                'writers.basic_info'
            ])
                ->where('EMP_ID', $EMP_ID)
                ->where('Role_ID', $Role_ID)
                ->whereHas('writers.assign_task.stats')
                ->get(),
            4 => $this->getCoordinatorPerformances(),
            15 => User::with([
                'users',
                'basic_info',
                'bench_mark' => function ($q) {
                    $q->whereMonth('created_at', Carbon::now()->month);
                },
            ])->where('Role_ID', $Role_ID)
                ->withCount('users')
                ->get(),
            9, 10, 11, 3, 16, 17 => null,
            default => abort(403),
        };
    }

    // Human Resource
    public function getHumanResourcePerformances(): Collection|array
    {
        return User::with([
            'users',
            'basic_info',
            'bench_mark' => function ($q) {
                $q->whereMonth('created_at', Carbon::now()->month);
            },

        ])->where('Role_ID', 15)
            ->withCount('users')
            ->get();
    }
}
