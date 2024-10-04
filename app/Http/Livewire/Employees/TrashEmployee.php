<?php

namespace App\Http\Livewire\Employees;

use App\Models\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Livewire\Component;

class TrashEmployee extends Component
{
    public function render()
    {

        $trashedUsers = User::onlyTrashed()
            ->with([
                'createdBy',
                'basic_info'
            ])
            ->latest('id')
            ->get();

        return view('livewire.employees.trash-employee', compact('trashedUsers'))->layout('layouts.authorized');;
    }

    public function ForceDelete(Request $request)
    {
        $Emp_ID = Crypt::decryptString($request->EMP_ID);

        $PermenetUser = User::where('EMP_ID', $Emp_ID)->ForceDelete();
        if ($PermenetUser) {
            return redirect()->route('Main.Dashboard')->with('Success!', 'User Permenet Deleted Successfully!');
        }
        return redirect()->back()->with('Error!', 'User Not Deleted Successfully!');
    }
}
