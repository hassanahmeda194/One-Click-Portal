<?php

namespace App\Http\Livewire\Research;

use App\Services\ResearchOrderService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\ResearchOrders\OrderInfo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Auth\User;

class ReasearchOrdersList extends Component
{
    protected ResearchOrderService $researchOrderService;


    public function mount(ResearchOrderService $researchOrderService): void
    {
        $this->researchOrderService = $researchOrderService;
    }

    public function render(Request $request)
    {
        $auth_user = Auth::guard('Authorized')->user();
        $Research_Orders = $this->researchOrderService->getOrdersList((int) $auth_user->Role_ID, (int) $auth_user->id);
        $unAssignedOrder = "";
        $IndependentWriterOrder = "";

        if ($request->has('filter') && in_array($auth_user->Role_ID, [1, 4])) {
            $currentMonth = Carbon::now()->month;
            $currentYear = Carbon::now()->year;

            $unAssignedOrder = OrderInfo::with([
                'authorized_user',
                'assign',
                'client_info',
                'basic_info',
                'content_info',
                'submission_info',
                'deadlines',
                'reference_info',
                'order_desc',
                'payment_info',
                'attachments',
                'revision',
                'tasks',
                'final_submission',
            ])->whereDoesntHave('assign')
                ->whereDoesntHave('tasks')
                ->whereMonth('created_at', $currentMonth)
                ->whereYear('created_at', $currentYear)
                ->OrderByDesc('id')
                ->get();
        }
        if ($auth_user->Role_ID == 7) {

            $IndependentWriterOrder = OrderInfo::whereHas('assign', function ($query) use ($auth_user) {
                $query->where('assign_id', $auth_user->id);
            })->whereHas('basic_info', function ($query) {
                $query->whereNot('Order_Status', 2);
            })->with([
                'basic_info',
                'assign',
                'submission_info'

            ])->get();
        }
        if ($request->has('start_date') && $request->has('end_date') && $request->has('writer')) {

        $Research_Orders = [];
           $startDate = Carbon::parse($request->start_date)->startOfDay();
$endDate = Carbon::parse($request->end_date)->endOfDay();

$Deadline_Today_R = OrderInfo::where('order_infos.Order_Type', 1)
    ->join('order_client_infos', 'order_client_infos.id', '=', 'order_infos.client_id')
    ->join('order_basic_infos', 'order_basic_infos.order_id', '=', 'order_infos.id')
    ->join('order_submission_infos', 'order_submission_infos.order_id', '=', 'order_infos.id')
    ->join('order_assigning_infos', 'order_assigning_infos.order_id', '=', 'order_infos.id')
    ->join('user_basic_infos', 'user_basic_infos.user_id', '=', 'order_assigning_infos.assign_id')
    ->where('order_basic_infos.Order_Status', '!=', '2')
    ->where('order_basic_infos.Order_Status', '!=', '1')
    ->when($request->writer !== 'All', function ($query) use ($request) {
        return $query->where('order_assigning_infos.assign_id', $request->writer);
    })
    ->whereBetween('order_submission_infos.DeadLine', [$startDate, $endDate])
    ->select('user_basic_infos.F_Name', 'user_basic_infos.L_Name', 'order_client_infos.Client_Name', 'order_infos.Order_ID', 'order_submission_infos.DeadLine', 'order_basic_infos.Order_Status', 'order_infos.Order_Type', 'order_basic_infos.Word_Count', 'order_assigning_infos.assign_id')
    ->get();
            $Research_Orders = $Deadline_Today_R->toArray();
            $draftLetters = ['F', 'S', 'T', 'Four', 'Fifth', 'Sixth', 'Seven', 'Eight', 'nine', 'ten', 'eleven', 'twelve', 'thirteen', 'fourteen', 'fifteen'];
            $counter_manager_1 = 1;
            foreach ($draftLetters as $draftLetter) {
                $Drafts_Today_R = OrderInfo::with('assign')->where('order_infos.Order_Type', 1)
                    ->join('order_basic_infos', 'order_basic_infos.order_id', '=', 'order_infos.id')
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
                    ->where('order_basic_infos.Order_Status', '!=', '2')
                    ->when($request->writer !== 'All', function ($query) use ($request) {
                            return $query->where('order_assigning_infos.assign_id', $request->writer);
                        })
                    ->select('user_basic_infos.F_Name' , 'user_basic_infos.L_Name' , 'order_client_infos.Client_Name', 'order_infos.Order_ID', "order_submission_infos.{$draftLetter}_DeadLine", 'order_basic_infos.Order_Status', 'order_infos.Order_Type', 'order_basic_infos.Word_Count', 'order_assigning_infos.assign_id')
                    ->get();
                $Research_Orders = array_merge($Research_Orders, $Drafts_Today_R->toArray());
                $counter_manager_1++;
            }
            
        }
        
        $Writters = User::with('basic_info')->whereIn('Role_ID', [5,6,7])->get();

        return view('livewire.research.reasearch-orders-list', compact('Writters','IndependentWriterOrder', 'Research_Orders', 'auth_user', 'unAssignedOrder'))->layout('layouts.authorized');
    }
}
