<?php

namespace App\Http\Livewire\CustomErrors;

use Livewire\Component;

class ErrorsList extends Component
{
    public function render()
    {
        return view('livewire.custom-errors.errors-list')->layout('layouts.authorized');
    }
}
