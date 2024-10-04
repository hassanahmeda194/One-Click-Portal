<?php

namespace App\Http\Livewire\DesignOrder;

use App\Models\Auth\User;
use App\Models\ResearchOrders\OrderInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class DesignOrderView extends Component
{
    public function render(Request $request)
    {
        $Order_ID = Crypt::decryptString($request->Order_ID);
        $auth_user = Auth::guard('Authorized')->user();
        $currentDateTime = date('Y-m-d H:i:s');

        DB::table('notifications')
            ->where('notifiable_id', $auth_user->id)
            ->where('data->Order_ID', $Order_ID)
            ->update(['read_at' => $currentDateTime]);

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
            'attachments',
            'reference_info',
            'assign',
            'draftSubmissions' => function ($q) {
                $q->with('attachments');
            },
            'final_submission',
            'revision',
            'assign_dead_lines' => function ($q) use ($auth_user) {
                $q->where('user_id', $auth_user->id);
            }
        ])->first();
        // dd($DesignOrder->toArray());
        $AssignUser = User::with('basic_info')->where('role_ID', 16)->get();
        $auth_user = Auth::guard('Authorized')->user();
        return view('livewire.design-order.design-order-view', compact('DesignOrder', 'AssignUser', 'auth_user'))->layout('layouts.authorized');
    }
}
