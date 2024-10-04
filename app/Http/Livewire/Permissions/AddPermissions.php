<?php

namespace App\Http\Livewire\Permissions;

use App\Models\BasicModels\UserDesignations;
use Livewire\Component;

class AddPermissions extends Component
{
    public function render()
    {
        $role = UserDesignations::get();
        return view('livewire.permissions.add-permissions', compact('role'))->layout('layouts.authorized');
    }
}
