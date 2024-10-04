<?php

namespace App\Http\Livewire\Auth;

use App\Models\Auth\LoginHistory;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ViewLoginHistory extends Component
{
    public function render()
    {
        if (Auth::guard('Authorized')->user()->id == 1) {
            
            $loginHistory = LoginHistory::with(['users' => function ($q) {
                $q->with('basic_info');
            }])->latest('id')->get();
            
        } else {
            
            $loginHistory = LoginHistory::with('users.basic_info')->latest('id')
                ->where('user_id', Auth::guard('Authorized')->user()->id)
                ->get();
                
        }
        return view('livewire.auth.view-login-history', compact('loginHistory'))->layout('layouts.authorized');
    }
}
