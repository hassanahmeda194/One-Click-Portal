<?php

namespace App\Http\Livewire\DevelopmentOrders;

use App\Models\ResearchOrders\OrderInfo;
use App\Services\DevelopmentOrderService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class DevelopmentOrderList extends Component
{
    protected DevelopmentOrderService $developmentOrderService;

    public function mount(DevelopmentOrderService $developmentOrderService): void
    {
        $this->developmentOrderService = $developmentOrderService;
    }

    public function render()
    {
        $auth_user = Auth::guard('Authorized')->user();
        $developmentOrders = $this->developmentOrderService->getOrdersList((int) $auth_user->Role_ID, (int) $auth_user->id);

        return view('livewire.development-orders.development-order-list', compact('developmentOrders', 'auth_user'))->layout('layouts.authorized');
    }
}
