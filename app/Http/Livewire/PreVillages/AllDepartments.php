<?php

namespace App\Http\Livewire\PreVillages;

use App\Models\BasicModels\Departments;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Services\Pre_Villages;
use Illuminate\Support\Facades\Crypt;
use Livewire\Component;

class AllDepartments extends Component
{
    protected Pre_Villages $pre_Villages;
    public function mount(Pre_Villages $pre_Villages): void
    {
        $this->pre_Villages = $pre_Villages;
    }

    public function render()
    {
        $Departments = $this->pre_Villages->getDepartments();
        return view('livewire.pre-villages.all-departments', compact('Departments'))->layout('layouts.authorized');
    }

    public function postDepartment(Request $request): RedirectResponse
    {
        Departments::create([
            'Department_Name' => $request->Department_Name
        ]);
        return back()->with('Success!', "New Department Added Successfully!");
    }

    public function deleteDepartment(Request $request): RedirectResponse
    {
        $Dep_ID = Crypt::decryptString($request->Dep_ID);
        Departments::find($Dep_ID)->delete();
        return back()->with('Success!', "Department has been Deleted!");
    }
}
