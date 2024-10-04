<?php

namespace App\Http\Livewire\DevelopmentOrders;

use App\Models\Auth\User;
use App\Models\Draft\DraftSubmission;
use App\Services\DevelopmentOrderService;
use App\Services\OrdersService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use App\Models\ResearchOrders\OrderInfo;


use Livewire\Component;

class DevelopmentOrderView extends Component
{
    protected DevelopmentOrderService $developmentOrderService;

    public function mount(DevelopmentOrderService $developmentOrderService): void
    {
        $this->developmentOrderService = $developmentOrderService;
    }

    public function render(Request $request)
    {
        $Order_ID = Crypt::decryptString($request->Order_ID);
        $auth_user = Auth::guard('Authorized')->user();
        $currentDateTime = date('Y-m-d H:i:s');
        
        DB::table('notifications')
            ->where('notifiable_id', $auth_user->id)
            ->where('data->Order_ID', $Order_ID)
            ->update(['read_at' => $currentDateTime]);
        
        $Order_ID = Crypt::decryptString($request->Order_ID);
        $DevelopmentOrder = $this->developmentOrderService->getOrderDetail($Order_ID);
        $AssignUser = User::with('basic_info')->where('role_ID', 3)->get();
        $auth_user = Auth::guard('Authorized')->user();
        return view('livewire.development-orders.development-order-view', compact('Order_ID', 'DevelopmentOrder', 'auth_user', 'AssignUser'))->layout('layouts.authorized');
    }
}
