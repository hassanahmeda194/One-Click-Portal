<?php

namespace App\Http\Livewire\PreVillages;

use App\Models\BasicModels\OrderIndustries;
use App\Services\Pre_Villages;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Livewire\Component;

class AllIndustries extends Component
{
    protected Pre_Villages $pre_Villages;

    public function mount(Pre_Villages $pre_Villages): void
    {
        $this->pre_Villages = $pre_Villages;
    }

    public function render()
    {
        $Order_Industries = $this->pre_Villages->getOrderIndustries();
        return view('livewire.pre-villages.all-industries', compact('Order_Industries'))->layout('layouts.authorized');
    }

    public function postIndustry(Request $request): RedirectResponse
    {
        OrderIndustries::create([
            'Industry_Name' => $request->Industry_Name
        ]);
        return back()->with('Success!', "Industry has been Created!");
    }

    public function deleteIndustry(Request $request): RedirectResponse
    {
        $Industry_ID = Crypt::decryptString($request->Industry_ID);
        OrderIndustries::find($Industry_ID)->delete();
        return back()->with('Success!', "Industry has been Deleted!");
    }
}
