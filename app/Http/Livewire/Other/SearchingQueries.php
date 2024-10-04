<?php

namespace App\Http\Livewire\Other;

use Livewire\Component;

class SearchingQueries extends Component
{
    public function render()
    {
        return view('livewire.other.searching-queries')->layout('layouts.authorized');
    }
}
