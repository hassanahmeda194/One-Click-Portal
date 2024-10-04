<?php

namespace App\Http\Livewire;

use Illuminate\Http\Request;
use Livewire\Component;
use App\Models\CompanyPolicy;

class Policy extends Component
{
    public function render()
    {
        return view('livewire.policy')->layout('layouts.authorized');
    }

    public function updateCompanyPolicy(Request $request)
    {
        

        $request->validate([
            'policy_path' => 'required|file',
        ]);
        
        $oldPolicy = CompanyPolicy::first();
        if ($oldPolicy) {
            if (file_exists($oldPolicy->policy_path)) {
                unlink($oldPolicy->policy_path);
            }
            if ($request->hasFile('policy_path')) {
                $name = $request->policy_path->getClientOriginalName();
                $request->policy_path->move(public_path('Policy/'), $name);
                $path = 'Policy/' . $name;
            }
            $oldPolicy->update([
                'policy_path' => $path,
            ]);
            return back()->with('Success!', 'Policy Updated Successfully!');
        }
        return back()->with('Error!', 'No policy found to update!');
    }
}
