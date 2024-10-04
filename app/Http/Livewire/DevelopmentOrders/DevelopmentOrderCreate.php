<?php

namespace App\Http\Livewire\DevelopmentOrders;

use App\Models\BasicModels\OrderCountry;
use App\Models\BasicModels\OrderCurrencies;
use App\Services\OrdersService;
use App\Services\Pre_Villages;
use App\Services\DevelopmentOrderService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class DevelopmentOrderCreate extends Component
{
    protected Pre_Villages $pre_Villages;
    protected OrdersService $orderService;

    public function mount(Pre_Villages $pre_Villages,  OrdersService $orderService): void
    {
        $this->pre_Villages = $pre_Villages;
        $this->orderService = $orderService;
    }
    public function render(Request $request)
    {
        $Order_Websites = $this->pre_Villages->getOrderWebsites();
        $Currencies = Cache::rememberForever('currencies', function () {
            return OrderCurrencies::get();
        });
        $Countries = Cache::rememberForever('countries', function () {
            return OrderCountry::get();
        });
        $L_OID = $this->orderService->getNewOrderID();
        $Client_Info = $this->orderService->getClientInfoFromRoute($request->Client_ID);
        return view('livewire.development-orders.development-order-create', compact('Order_Websites', 'L_OID', 'Currencies', 'Countries', 'Client_Info'))->layout('layouts.authorized');
    }
}
