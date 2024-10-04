<?php

namespace App\Http\Livewire\Research;


use App\Models\ResearchOrders\OrderInfo;
use App\Services\ResearchOrderService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ResearchCanceldOrdersList extends Component
{
    protected ResearchOrderService $researchOrderService;

    public function mount(ResearchOrderService $researchOrderService): void
    {
        $this->researchOrderService = $researchOrderService;
    }
    public function render()
    {
        $auth_user = Auth::guard('Authorized')->user();
        $Research_Canceled_Orders =  OrderInfo::latest('id')
        ->with([
            'client_info',
            'basic_info',
            'submission_info',
            'payment_info',
            'assign.basic_info' => function ($q) {
                $q->select('id', 'F_Name', 'L_Name', 'user_id');
            },
        ])
        ->where('Order_Type', 1)
        ->whereRelation('basic_info', function ($q) {
            $q->where('Order_Status', 1);

        })->latest('cancel_at')->get();



        return view('livewire.research.research-canceld-orders-list', compact('Research_Canceled_Orders', 'auth_user'))->layout('layouts.authorized');
    }

}