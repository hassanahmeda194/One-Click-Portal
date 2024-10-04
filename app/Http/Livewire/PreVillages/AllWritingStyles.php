<?php

namespace App\Http\Livewire\PreVillages;

use App\Models\BasicModels\OrderWritingStyles;
use App\Services\Pre_Villages;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Livewire\Component;

class AllWritingStyles extends Component
{
    protected Pre_Villages $pre_Villages;

    public function mount(Pre_Villages $pre_Villages): void
    {
        $this->pre_Villages = $pre_Villages;
    }

    public function render()
    {
        $Writing_Styles = $this->pre_Villages->getWritingStyles();
        return view('livewire.pre-villages.all-writing-styles', compact('Writing_Styles'))->layout('layouts.authorized');
    }

    public function postStyle(Request $request): RedirectResponse
    {
        OrderWritingStyles::create([
            'Style_Name' => $request->Style_Name
        ]);
        return back()->with('Success!', "Website has been Created!");
    }

    public function deleteStyle(Request $request): RedirectResponse
    {
        $Style_ID = Crypt::decryptString($request->Style_ID);
        OrderWritingStyles::find($Style_ID)->delete();
        return back()->with('Success!', "Website has been Deleted!");
    }
}
