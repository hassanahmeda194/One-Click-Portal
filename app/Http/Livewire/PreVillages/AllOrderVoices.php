<?php

namespace App\Http\Livewire\PreVillages;

use App\Models\BasicModels\OrderVoices;
use App\Services\Pre_Villages;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Livewire\Component;

class AllOrderVoices extends Component
{
    protected Pre_Villages $pre_Villages;

    public function mount(Pre_Villages $pre_Villages): void
    {
        $this->pre_Villages = $pre_Villages;
    }

    public function render()
    {
        $Order_Voices = $this->pre_Villages->getOrderVoices();
        return view('livewire.pre-villages.all-order-voices', compact('Order_Voices'))->layout('layouts.authorized');
    }

    public function postVoice(Request $request): RedirectResponse
    {
        OrderVoices::create([
            'Voice_Name' => $request->Voice_Name
        ]);
        return back()->with('Success!', "Voice has been Created!");
    }

    public function deleteVoice(Request $request): RedirectResponse
    {
        $Voice_ID = Crypt::decryptString($request->Voice_ID);
        OrderVoices::find($Voice_ID)->delete();
        return back()->with('Success!', "Voice has been Deleted!");
    }
}
