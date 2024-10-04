<?php

namespace App\Http\Livewire\DesignOrder;

use Illuminate\Support\Facades\Auth;
use App\Models\ResearchOrders\OrderInfo;
use Livewire\Component;

class DesignOrderList extends Component
{
    public function render()
{
    $auth_user = Auth::guard('Authorized')->user();
    $query = OrderInfo::with([
        'design_info',
        'authorized_user',
        'client_info',
        'submission_info',
        'payment_info',
        'basic_info',
        'assign',
    ])->where('Order_Type', 3);

    if ($auth_user->Role_ID == 16) {
        $query->whereHas('assign', function ($query) use ($auth_user) {
            $query->where('assign_id', $auth_user->id);
        });
    }

    $DesignOrderList = $query->orderByDesc('id')->get();
    

    return view('livewire.design-order.design-order-list', compact('DesignOrderList','auth_user'))->layout('layouts.authorized');
}

}
