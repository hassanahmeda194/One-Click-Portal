<?php

namespace App\Http\Livewire\CustomErrors;

use Illuminate\Http\Request;
use Livewire\Component;

class ExceptionMessage extends Component
{
    public function render(Request $request)
    {
        $Message = $request->Message;
        return view('livewire.custom-errors.exception-message', compact('Message'))->layout('layouts.error');
    }
}
