<?php

namespace App\Http\Livewire\PreVillages;

use App\Models\BasicModels\OrderWebsites;
use App\Services\Pre_Villages;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Livewire\Component;

class AllOrderWebsites extends Component
{
    protected Pre_Villages $pre_Villages;
    public function mount(Pre_Villages $pre_Villages): void
    {
        $this->pre_Villages = $pre_Villages;
    }

    public function render()
    {
        $Order_Websites = $this->pre_Villages->getOrderWebsites();
        return view('livewire.pre-villages.all-order-websites', compact('Order_Websites'))->layout('layouts.authorized');
    }

    public function postWebsite(Request $request): RedirectResponse
    {
        OrderWebsites::create([
            'Website_Name' => $request->Website_Name
        ]);
        return back()->with('Success!', "Website has been Created!");
    }

    public function deleteWebsite(Request $request): RedirectResponse
    {
        $Web_ID = Crypt::decryptString($request->Web_ID);
        OrderWebsites::find($Web_ID)->delete();
        return back()->with('Success!', "Website has been Deleted!");
    }
}
