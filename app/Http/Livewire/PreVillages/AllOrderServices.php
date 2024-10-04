<?php

namespace App\Http\Livewire\PreVillages;

use App\Models\BasicModels\OrderServices;
use App\Models\BasicModels\WriterSkills;
use App\Services\Pre_Villages;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Livewire\Component;

class AllOrderServices extends Component
{
    protected Pre_Villages $pre_Villages;
    public function mount(Pre_Villages $pre_Villages): void
    {
        $this->pre_Villages = $pre_Villages;
    }

    public function render()
    {
        $Order_Services = $this->pre_Villages->getOrderServices();
        $Writer_Skills = $this->pre_Villages->getWriterSkills();
        return view('livewire.pre-villages.all-order-services', compact('Order_Services', 'Writer_Skills'))->layout('layouts.authorized');
    }

    public function postService(Request $request): RedirectResponse
    {
        OrderServices::create([
            'Service_Name' => $request->Service_Name
        ]);
        return back()->with('Success!', "Service has been Created!");
    }

    public function deleteService(Request $request): RedirectResponse
    {
        $Service_ID = Crypt::decryptString($request->Service_ID);
        OrderServices::find($Service_ID)->delete();
        return back()->with('Success!', "Service has been Deleted!");
    }

    public function postSkill(Request $request): RedirectResponse
    {
        WriterSkills::create([
            'Skill_Name' => $request->Skill_Name
        ]);
        return back()->with('Success!', "Service has been Created!");
    }

    public function deleteSkill(Request $request): RedirectResponse
    {
        $Skill_ID = Crypt::decryptString($request->Skill_ID);
        WriterSkills::find($Skill_ID)->delete();
        return back()->with('Success!', "Service has been Deleted!");
    }
}
