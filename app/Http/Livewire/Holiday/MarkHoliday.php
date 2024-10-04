<?php

namespace App\Http\Livewire\Holiday;

use App\Models\Attendance\Attendance;
use App\Models\Auth\User;
use App\Models\Holiday\Holiday;
use Illuminate\Http\Request;

use Livewire\Component;

class MarkHoliday extends Component
{

    public function render()
    {
        $Holidays = Holiday::all();
        return view('livewire.holiday.mark-holiday',compact('Holidays'))->layout('layouts.authorized');

    }
    
   public function markHoliday(Request $request) {
       
   
   
   $request->validate([
        'date' => 'required', 
        'name' => 'required', 
    ]);


    $date = $request->date;
    $name = $request->name;

    if (Holiday::where('date', $date)->exists()) {
        return redirect()->back()->with('error', 'A holiday already exists for the selected date');
    }

    $existingAttendances = Attendance::whereDate('created_at', $date)->get();

    if ($existingAttendances->isNotEmpty()) {
        foreach ($existingAttendances as $attendance) {
            $attendance->update(['status' => 8]);
        }
    } else {
        $users = User::all();
        foreach ($users as $user) {
            Attendance::create([
                'user_id' => $user->id,
                'status' => 8,
                'created_at' => $date,
                'ip_address' => null,
                'check_in' => null,
                'check_out' => null
            ]);
        }
    }

    Holiday::create([
        'name' => $name,
        'date' => $date
    ]);

    return redirect()->back()->with('Success!', 'Holiday has been marked successfully');
}



}
