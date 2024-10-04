<?php

namespace App\Http\Livewire\Trash;

use App\Models\Auth\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class DeletedUsers extends Component
{
    public function render()
    {
        $All_Users = User::onlyTrashed()
            ->latest('id')
            ->with([
                'createdBy',
                'basic_info'
            ])->get();
        return view('livewire.trash.deleted-users', compact('All_Users'))->layout('layouts.authorized');
    }

    public function deleteEmployee(Request $request): RedirectResponse
    {
        try {
            DB::beginTransaction();
            $Emp_ID = $request->EMP_ID;
            User::where('EMP_ID', $Emp_ID)->delete();
            DB::commit();
            return back()->with('Success!', 'User Deleted!!');
        } catch (QueryException $e) {
            DB::rollback();
            return back()->with('error', 'An error occurred while restoring all users.');
        }
    }

    public function deleteAllEmployee(): RedirectResponse
    {
        try {
            DB::beginTransaction();
            User::where('Role_ID', '!=', 1)->delete();
            DB::commit();
            return back()->with('Success!', 'All users have been Deleted.');
        } catch (QueryException $e) {
            DB::rollback();
            return back()->with('error', 'An error occurred while restoring all users.');
        }
    }

    public function restoreEmployee(Request $request): RedirectResponse
    {
        try {
            DB::beginTransaction();
            $Emp_ID = $request->EMP_ID;
            User::onlyTrashed()->where('EMP_ID', $Emp_ID)->restore();
            DB::commit();
            return back()->with('Success!', 'User with ID ' . $Emp_ID . ' has been restored.');
        } catch (QueryException $e) {
            DB::rollback();
            return back()->with('error', 'An error occurred while restoring all users.');
        }
    }

    public function restoreAllEmployee(): RedirectResponse
    {
        try {
            DB::beginTransaction();
            User::onlyTrashed()->restore();
            DB::commit();
            return back()->with('Success!', 'All deleted users have been restored.');
        } catch (QueryException $e) {
            DB::rollback();
            return back()->with('error', 'An error occurred while restoring all users.');
        }
    }
}
