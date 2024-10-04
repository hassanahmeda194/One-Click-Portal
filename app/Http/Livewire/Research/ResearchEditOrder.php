<?php

namespace App\Http\Livewire\Research;

use App\Models\BasicModels\OrderCountry;
use App\Models\BasicModels\OrderCurrencies;
use App\Models\PreferdLanguage;
use App\Models\ResearchOrders\OrderInfo;
use App\Services\OrdersService;
use App\Services\Pre_Villages;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Livewire\Component;

class ResearchEditOrder extends Component
{
    protected Pre_Villages $pre_Villages;
    protected OrdersService $orderService;

    public function mount(Pre_Villages $pre_Villages, OrdersService $orderService): void
    {
        $this->pre_Villages = $pre_Villages;
        $this->orderService = $orderService;
    }

    public function render(Request $request)
    {
        $Order_ID = Crypt::decryptString($request->Order_ID);
        $auth_user = Auth::guard('Authorized')->user();
        $Order_Services = $this->pre_Villages->getOrderServices();
        $Order_Websites = $this->pre_Villages->getOrderWebsites();
        $Currencies = OrderCurrencies::get();
        $Countries = OrderCountry::get();
        $Research_Order = OrderInfo::where('Order_ID', $Order_ID)
            ->with([
                'client_info',
                'basic_info',
                'submission_info',
                'reference_info',
                'order_desc',
                'payment_info',
                'attachments',
                'final_submission'
            ])->firstOrFail();
        $languages = PreferdLanguage::all();
        return view('livewire.research.research-edit-order', compact('Order_ID', 'Research_Order', 'auth_user', 'Order_Services', 'Order_Websites', 'Currencies', 'Countries' , 'languages'))->layout('layouts.authorized');
    }

    public function updateResearchOrder(Request $request, OrdersService $orderService): RedirectResponse
    {
        return $orderService->updateOrder($request);
    }

}
