<?php

namespace App\Http\Livewire\Trash;

use App\Services\ResearchOrderService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ResearchDeletedOrders extends Component
{
    protected ResearchOrderService $researchOrderService;

    public function mount(ResearchOrderService $researchOrderService): void
    {
        $this->researchOrderService = $researchOrderService;
    }
    public function render()
    {
        $auth_user = Auth::guard('Authorized')->user();
        $Research_Orders = $this->researchOrderService->getDeletedOrdersList((int) $auth_user->Role_ID, (int) $auth_user->id);
        return view('livewire.trash.research-deleted-orders', compact('Research_Orders', 'auth_user'))->layout('layouts.authorized');
    }
}
