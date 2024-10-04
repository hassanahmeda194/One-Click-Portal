<?php

namespace App\Http\Livewire\Content;

use App\Models\ResearchOrders\OrderInfo;
use App\Services\ContentOrderService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
class ContentCanceldOrdersList extends Component
{


    protected ContentOrderService $contentOrderService;

    public function mount(ContentOrderService $contentOrderService): void
    {
        $this->contentOrderService = $contentOrderService;
    }
    public function render()
    {
        $auth_user = Auth::guard('Authorized')->user();

        $Content_Canceled_Orders = OrderInfo::with([
            'basic_info',
            'client_info',
            'content_info',
            'submission_info',
            'payment_info',
            'assign.basic_info' => function ($q) {
                $q->select('id', 'F_Name', 'L_Name', 'user_id');
            },
        ])
        ->where('Order_Type', 2)
        ->whereRelation('content_info', function ($q) {
            $q->where('Order_Status', 1);
        })
        ->latest('cancel_at')
        ->get();

        return view('livewire.content.content-canceld-orders-list', compact('Content_Canceled_Orders', 'auth_user'))->layout('layouts.authorized');
    }

}