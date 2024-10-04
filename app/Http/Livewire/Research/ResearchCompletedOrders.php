<?php

namespace App\Http\Livewire\Research;

use App\Services\ResearchOrderService;
use Illuminate\Support\Facades\Auth;
use App\Models\ResearchOrders\OrderInfo;
use Livewire\Component;

class ResearchCompletedOrders extends Component
{
    protected ResearchOrderService $researchOrderService;

    public function mount(ResearchOrderService $researchOrderService): void
    {
        $this->researchOrderService = $researchOrderService;
    }
    public function render()
    {
        $auth_user = Auth::guard('Authorized')->user();
        $Research_Orders = $this->researchOrderService->getCompletedOrdersList((int) $auth_user->Role_ID, (int) $auth_user->id);
        
        $IndependentWriterOrder = "";

        if ($auth_user->Role_ID == 7) {

            $IndependentWriterOrder = OrderInfo::whereHas('assign', function ($query) use ($auth_user) {
                $query->where('assign_id', $auth_user->id);
            })->whereHas('basic_info', function ($query) {
                $query->where('Order_Status', 2);
            })->with([
                'basic_info',
                'assign',
                'submission_info'

            ])->get();  
        }
        
        
        return view('livewire.research.research-completed-orders', compact('IndependentWriterOrder','Research_Orders', 'auth_user'))->layout('layouts.authorized');
    }
}
