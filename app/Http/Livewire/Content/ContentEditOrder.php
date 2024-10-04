<?php

namespace App\Http\Livewire\Content;

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

class ContentEditOrder extends Component
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

        $Order_Websites = $this->pre_Villages->getOrderWebsites();
        $Writer_Skills = $this->pre_Villages->getWriterSkills();
        $Order_Industries = $this->pre_Villages->getOrderIndustries();
        $Writing_Styles = $this->pre_Villages->getWritingStyles();
        $Order_Voices = $this->pre_Villages->getOrderVoices();
        $Generic_Types = $this->pre_Villages->getOrderGeneric();

        $Currencies = OrderCurrencies::get();
        $Countries = OrderCountry::get();
        $Content_Order = OrderInfo::where('Order_ID', $Order_ID)
            ->with([
                'client_info',
                'content_info',
                'submission_info',
                'reference_info',
                'order_desc',
                'payment_info',
                'attachments',
                'final_submission'
            ])->firstOrFail();
        $languages = PreferdLanguage::all();
        return view('livewire.content.content-edit-order', compact('Order_ID', 'Content_Order', 'auth_user', 'Order_Websites', 'Order_Industries', 'Writing_Styles', 'Order_Voices', 'Generic_Types', 'Currencies', 'Countries', 'Writer_Skills', 'languages'))->layout('layouts.authorized');
    }

    public function updateContentOrder(Request $request, OrdersService $orderService): RedirectResponse
    {
        return $orderService->updateOrder($request);
    }
}
