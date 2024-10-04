<?php

namespace App\Http\Livewire\PreVillages;

use App\Models\BasicModels\UserDesignations;
use App\Services\Pre_Villages;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Livewire\Component;

class AllDesignations extends Component
{
    protected Pre_Villages $pre_Villages;

    public function mount(Pre_Villages $pre_Villages): void
    {
        $this->pre_Villages = $pre_Villages;
    }

    public function render()
    {
        $Designations = $this->pre_Villages->getDesignations();
        return view('livewire.pre-villages.all-designations', compact('Designations'))->layout('layouts.authorized');
    }

    public function postDesignations(Request $request): RedirectResponse
    {
        UserDesignations::create([
            'Designation_Name' => $request->Designation_Name
        ]);
        return back()->with('Success!', "Designation has been Created!");
    }
    public function deleteDesignation(Request $request): RedirectResponse
    {
        $Role_ID = Crypt::decryptString($request->Role_ID);
        UserDesignations::find($Role_ID)->delete();
        return back()->with('Success!', "Designation has been Deleted!");
    }
}
