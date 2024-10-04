<?php

namespace App\Http\Livewire\Content;

use App\Models\Auth\User;
use App\Models\BasicModels\OrderCountry;
use App\Models\BasicModels\OrderCurrencies;
use App\Models\PreferdLanguage;
use App\Models\ResearchOrders\OrderInfo;
use App\Services\OrdersService;
use App\Services\Pre_Villages;
use App\Services\ResearchOrderService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ContentCreateOrder extends Component
{
    protected ResearchOrderService $researchOrderService;
    protected Pre_Villages $pre_Villages;
    protected OrdersService $orderService;

    public function mount(Pre_Villages $pre_Villages, ResearchOrderService $researchOrderService, OrdersService $orderService): void
    {
        $this->pre_Villages = $pre_Villages;
        $this->researchOrderService = $researchOrderService;
        $this->orderService = $orderService;
    }

    public function render(Request $request)
    {
        $Order_Services = $this->pre_Villages->getOrderServices();
        $Order_Websites = $this->pre_Villages->getOrderWebsites();
        $Writer_Skills = $this->pre_Villages->getWriterSkills();
        $Order_Industries = $this->pre_Villages->getOrderIndustries();
        $Writing_Styles = $this->pre_Villages->getWritingStyles();
        $Order_Voices = $this->pre_Villages->getOrderVoices();
        $Generic_Types = $this->pre_Villages->getOrderGeneric();

        $Currencies = OrderCurrencies::get();
        $Countries = OrderCountry::get();
        $L_OID = $this->orderService->getNewOrderID();

        $Client_Info = $this->orderService->getClientInfoFromRoute($request->Client_ID);
        $languages = PreferdLanguage::all();

        return view('livewire.content.content-create-order', compact('Order_Services', 'Order_Websites', 'Order_Industries', 'Order_Voices', 'Writing_Styles', 'Generic_Types', 'L_OID', 'Currencies', 'Countries', 'Client_Info', 'Writer_Skills', 'languages'))->layout('layouts.authorized');
    }

    public function createContentOrder(Request $request, OrdersService $orderService): RedirectResponse
    {
        return $orderService->createNewOrder($request);
    }
}
