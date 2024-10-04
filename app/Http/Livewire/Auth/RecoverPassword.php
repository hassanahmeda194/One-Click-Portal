<?php

namespace App\Http\Livewire\Auth;

use Illuminate\Http\Request;
use Livewire\Component;

class RecoverPassword extends Component
{
    public function render()
    {
        return view('livewire.auth.recover-password');
    }

    public function submitResetPasswordForm(Request $request) {

    }
}
