<?php

namespace App\Http\Livewire\HR;

use App\Models\Auth\UserBenchMark;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class AssignedTargets extends Component
{
    public function render()
    {
        $Benchmark_List = UserBenchMark::with('user')
            ->whereMonth('created_at', Carbon::now()->month)
            ->get();
        return view('livewire.h-r.assigned-targets', compact('Benchmark_List'))->layout('layouts.authorized');
    }

    public function assignUserTarget(Request $request): RedirectResponse
    {
        try {
            DB::beginTransaction();
            $Benchmark = UserBenchMark::where('user_id', $request->Emp_ID)
                ->first();

            if (empty($Benchmark)) {
                UserBenchMark::create([
                    'Bench_Mark' => $request->Benchmark,
                    'user_id' => $request->Emp_ID
                ]);
                DB::commit();
                return back()->with('Success!', 'User benchmark assigned successfully');
            }

            UserBenchMark::where('id', $Benchmark->id)
                ->update([
                    'Bench_Mark' => $request->Benchmark,
                ]);
            DB::commit();
            return back()->with('Success!', 'User benchmark updated successfully');
        } catch (ValidationException $e) {
            DB::rollBack();
            return back()->with('Info!', $e->errors());
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('Error.Response', ['Message' => $e->getMessage()]);
        }
    }

    public function deleteUserTarget(Request $request): RedirectResponse
    {
        $Bench_ID = Crypt::decryptString($request->Bench_ID);
        UserBenchMark::where('id', $Bench_ID)->delete();
        return back()->with('Success!', 'User benchmark Deleted successfully');
    }
}
