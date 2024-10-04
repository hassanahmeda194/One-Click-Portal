<?php

namespace App\Http\Livewire\Content;

use App\Services\ContentOrderService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ContentCompletedOrders extends Component
{
    protected ContentOrderService $contentOrderService;

    public function mount(ContentOrderService $contentOrderService): void
    {
        $this->contentOrderService = $contentOrderService;
    }
    public function render()
    {
        $auth_user = Auth::guard('Authorized')->user();
        $Content_Orders = $this->contentOrderService->getCompletedOrdersList((int) $auth_user->Role_ID, (int) $auth_user->id);

        return view('livewire.content.content-completed-orders', compact('Content_Orders', 'auth_user'))->layout('layouts.authorized');
    }
}
