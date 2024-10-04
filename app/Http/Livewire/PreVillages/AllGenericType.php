<?php

namespace App\Http\Livewire\PreVillages;

use App\Models\BasicModels\OrderGenericType;
use App\Services\Pre_Villages;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Livewire\Component;

class AllGenericType extends Component
{
    protected Pre_Villages $pre_Villages;

    public function mount(Pre_Villages $pre_Villages): void
    {
        $this->pre_Villages = $pre_Villages;
    }

    public function render()
    {
        $Generic_Types = $this->pre_Villages->getOrderGeneric();
        return view('livewire.pre-villages.all-generic-type', compact('Generic_Types'))->layout('layouts.authorized');
    }

    public function postGeneric(Request $request): RedirectResponse
    {
        OrderGenericType::create([
            'Generic_Type' => $request->Generic_Type
        ]);
        return back()->with('Success!', "Generic has been Created!");
    }

    public function deleteGeneric(Request $request): RedirectResponse
    {
        $Generic_ID = Crypt::decryptString($request->Generic_ID);
        OrderGenericType::find($Generic_ID)->delete();
        return back()->with('Success!', "Generic has been Deleted!");
    }
}
