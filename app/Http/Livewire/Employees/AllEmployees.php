<?php

namespace App\Http\Livewire\Employees;

use App\Models\Auth\User;
use Livewire\Component;

class AllEmployees extends Component
{
    public function render()
    {
        $All_Users = User::latest('id')
            ->with([
                'createdBy',
                'basic_info'
            ])->get();
        return view('livewire.employees.all-employees', compact('All_Users'))->layout('layouts.authorized');
    }

}
