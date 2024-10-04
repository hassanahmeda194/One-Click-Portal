<?php

namespace App\Http\Livewire\DevelopmentOrders;

use Livewire\Component;
use App\Models\BasicModels\OrderCountry;
use App\Models\BasicModels\OrderCurrencies;
use App\Services\DevelopmentOrderService;

use App\Models\ResearchOrders\OrderInfo;
use App\Services\Pre_Villages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Crypt;

class DevelopmentOrderEdit extends Component
{
    protected DevelopmentOrderService $developmentOrderService;
    protected Pre_Villages $pre_Villages;

    public function mount(DevelopmentOrderService $developmentOrderService, Pre_Villages $pre_Villages,): void
    {
        $this->developmentOrderService = $developmentOrderService;
        $this->pre_Villages = $pre_Villages;
    }

    public function render(Request $request)
    {
        $Order_Websites = $this->pre_Villages->getOrderWebsites();
        $Order_ID = Crypt::decryptString($request->Order_ID);
        $DevelopmentOrder = $this->developmentOrderService->getOrderDetail($Order_ID);
        $Currencies = Cache::rememberForever('currencies', function () {
            return OrderCurrencies::get();
        });
        $Countries = Cache::rememberForever('countries', function () {
            return OrderCountry::get();
        });
        return view('livewire.development-orders.development-order-edit', compact('DevelopmentOrder', 'Currencies', 'Countries', 'Order_Websites'))->layout('layouts.authorized');
    }
}
