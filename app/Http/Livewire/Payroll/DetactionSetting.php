<?php

namespace App\Http\Livewire\Payroll;

use App\Models\Payroll\DetactionSetting as PayrollDetactionSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class DetactionSetting extends Component
{
    public function render()
    {
        $detactions = PayrollDetactionSetting::all();
        return view('livewire.payroll.detaction-setting' ,compact('detactions'))->layout('layouts.authorized');
    }

    public function getDetactionSetting(Request $request){
       return response()->json(PayrollDetactionSetting::find($request->id));
    }

    public function updateDetactAmmount(Request $request){
        try{
            PayrollDetactionSetting::find($request->detact_id)->update([
                    'detact_amount' => $request->detact_ammount
            ]);
            return back()->with('Success!' , 'Detaction Ammount Update!');
        }catch(\Exception $e){
            dd($e->getMessage());
            Log::error('Error updating detaction amount: ' . $e->getMessage());
            return back()->with('Error!' , 'Detaction Ammount Update Failed!');
        }
    }

}
