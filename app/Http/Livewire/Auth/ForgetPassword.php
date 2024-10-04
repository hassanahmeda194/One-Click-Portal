<?php

namespace App\Http\Livewire\Auth;

use Illuminate\Http\Request;
use Livewire\Component;

class ForgetPassword extends Component
{
    public function render()
    {
        return view('livewire.auth.forget-password');
    }

    public function submitForgetPasswordForm(Request $request) {

    }
}
