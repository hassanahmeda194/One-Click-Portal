<?php

namespace App\Http\Livewire\PreVillages;

use App\Models\PreferdLanguage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Livewire\Component;

class PreferredLanguage extends Component
{
    public function render()
    {
        $languages =  PreferdLanguage::all();
        return view('livewire.pre-villages.preferred-language', compact('languages'))->layout('layouts.authorized');
    }

    public function submitPreferredLanguage(Request $request)
    {
        try {
            PreferdLanguage::create([
                'name' => $request->name
            ]);
            return back()->with('Success!', 'Preferred Language Added Successfully!');
        } catch (\Exception $e) {
            return back()->with('Error!', 'Preferred Language Added Successfully!');
        }
    }

    public function DeletePreferredLanguage($id)
    {
        try {
            PreferdLanguage::find(Crypt::decryptString($id))->delete();
            return back()->with('Success!', 'Preferred Language Deleted Successfully!');
        } catch (\Exception $e) {
            return back()->with('Error!', 'Preferred Language Deleted Successfully!');
        }
    }
}
