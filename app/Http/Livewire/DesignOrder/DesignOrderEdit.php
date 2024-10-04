<?php

namespace App\Http\Livewire\DesignOrder;

use App\Models\BasicModels\OrderCountry;
use App\Models\BasicModels\OrderCurrencies;
use App\Models\ResearchOrders\OrderInfo;
use App\Services\Pre_Villages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Crypt;
use Livewire\Component;

class DesignOrderEdit extends Component
{
    protected Pre_Villages $pre_Villages;
    public function mount(Pre_Villages $pre_Villages): void
    {
        $this->pre_Villages = $pre_Villages;
    }
    public function render(Request $request)
    {
        $Order_ID = Crypt::decryptString($request->Order_ID);

        $DesignOrder = OrderInfo::where('Order_ID', $Order_ID)->with([
            'design_info',
            'authorized_user' => function ($q) {
                $q->with([
                    'basic_info' => function ($q) {
                        $q->select('id', 'F_Name', 'L_Name', 'user_id');
                    }
                ]);
            },
            'client_info',
            'submission_info',
            'payment_info',
            'order_desc',
            'reference_info'
        ])->first();

        $Currencies = Cache::rememberForever('currencies', function () {
            return OrderCurrencies::get();
        });

        $Countries = Cache::rememberForever('countries', function () {
            return OrderCountry::get();
        });

        $Order_Websites = $this->pre_Villages->getOrderWebsites();

        return view('livewire.design-order.design-order-edit', compact('DesignOrder', 'Currencies', 'Countries', 'Order_Websites'))->layout('layouts.authorized');
    }
}
