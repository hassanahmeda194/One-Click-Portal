<?php

namespace App\Http\Livewire\Content;

use App\Services\ContentOrderService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Auth\User;
use App\Models\ResearchOrders\OrderInfo;
use Illuminate\Http\Request;
use Carbon\Carbon;



class ContentOrdersList extends Component
{
    protected ContentOrderService $contentOrderService;

    public function mount(ContentOrderService $contentOrderService): void
    {
        $this->contentOrderService = $contentOrderService;
    }
    public function render(Request $request)
    {
        $auth_user = Auth::guard('Authorized')->user();
        $Content_Orders = $this->contentOrderService->getOrdersList((int) $auth_user->Role_ID, (int) $auth_user->id);
        
        if ($request->has('start_date') && $request->has('end_date') && $request->has('writer')) {

        $Content_Orders = [];
           $startDate = Carbon::parse($request->start_date)->startOfDay();
$endDate = Carbon::parse($request->end_date)->endOfDay();

$Deadline_Today_R = OrderInfo::where('order_infos.Order_Type', 2)
    ->join('order_client_infos', 'order_client_infos.id', '=', 'order_infos.client_id')
    ->join('content_basic_infos', 'content_basic_infos.order_id', '=', 'order_infos.id')
    ->join('order_submission_infos', 'order_submission_infos.order_id', '=', 'order_infos.id')
    ->join('order_assigning_infos', 'order_assigning_infos.order_id', '=', 'order_infos.id')
    ->join('user_basic_infos', 'user_basic_infos.user_id', '=', 'order_assigning_infos.assign_id')
    ->where('content_basic_infos.Order_Status', '!=', '2')
    ->where('content_basic_infos.Order_Status', '!=', '1')
    ->when($request->writer !== 'All', function ($query) use ($request) {
        return $query->where('order_assigning_infos.assign_id', $request->writer);
    })
    ->whereBetween('order_submission_infos.DeadLine', [$startDate, $endDate])
    ->select('user_basic_infos.F_Name', 'user_basic_infos.L_Name', 'order_client_infos.Client_Name', 'order_infos.Order_ID', 'order_submission_infos.DeadLine', 'content_basic_infos.Order_Status', 'order_infos.Order_Type', 'content_basic_infos.Word_Count', 'order_assigning_infos.assign_id')
    ->get();
            $Content_Orders = $Deadline_Today_R->toArray();
            $draftLetters = ['F', 'S', 'T', 'Four', 'Fifth', 'Sixth', 'Seven', 'Eight', 'nine', 'ten', 'eleven', 'twelve', 'thirteen', 'fourteen', 'fifteen'];
            $counter_manager_1 = 1;
            foreach ($draftLetters as $draftLetter) {
                $Drafts_Today_R = OrderInfo::with('assign')->where('order_infos.Order_Type', 2)
                    ->join('content_basic_infos', 'content_basic_infos.order_id', '=', 'order_infos.id')
                    ->join('order_client_infos', 'order_client_infos.id', '=', 'order_infos.client_id')
                    ->join('order_submission_infos', 'order_submission_infos.order_id', '=', 'order_infos.id')
                    ->join('order_assigning_infos', 'order_assigning_infos.order_id', '=', 'order_infos.id')
                    ->join('user_basic_infos' , 'user_basic_infos.user_id' ,  '=' ,'order_assigning_infos.assign_id')
                    ->leftJoin('draft_submission', function ($join) use ($counter_manager_1) {
                        $join->on('draft_submission.order_id', '=', 'order_infos.id')
                            ->where('draft_submission.draft_number', '=', $counter_manager_1);
                    })
                    ->whereBetween("order_submission_infos.{$draftLetter}_DeadLine",  [$startDate, $endDate])
                    ->whereNotNull("order_submission_infos.{$draftLetter}_DeadLine")
                    ->whereNull('draft_submission.id')
                    ->where('content_basic_infos.Order_Status', '!=', '2')
                    ->when($request->writer !== 'All', function ($query) use ($request) {
                            return $query->where('order_assigning_infos.assign_id', $request->writer);
                        })
                    ->select('user_basic_infos.F_Name' , 'user_basic_infos.L_Name' , 'order_client_infos.Client_Name', 'order_infos.Order_ID', "order_submission_infos.{$draftLetter}_DeadLine", 'content_basic_infos.Order_Status', 'order_infos.Order_Type', 'content_basic_infos.Word_Count', 'order_assigning_infos.assign_id')
                    ->get();
                $Content_Orders = array_merge($Content_Orders, $Drafts_Today_R->toArray());
                $counter_manager_1++;
            }
            
        }
        
        
         $Writters = User::with('basic_info')->whereIn('Role_ID', [8 , 12])->get();
        return view('livewire.content.content-orders-list', compact('Writters','Content_Orders', 'auth_user'))->layout('layouts.authorized');
    }
}
