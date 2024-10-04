<?php

namespace App\Http\Livewire;

use App\Models\Attendance\Attendance;
use App\Models\Auth\User;
use App\Models\ContentOrders\ContentBasicInfo;
use App\Models\LeaveEntitlements\UserLeaveQuota;
use App\Models\Notice\NoticeBoard;
use App\Models\ResearchOrders\OrderAssigningInfo;
use App\Models\ResearchOrders\OrderInfo;
use App\Models\ResearchOrders\OrderSubmissionInfo;
use App\Services\OrdersService;
use App\Services\ResearchOrderService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Illuminate\Support\Facades\Cache;
use PDO;
use App\Models\Notice\Notice;
use Illuminate\Support\Facades\Session;

class Dashboard extends Component
{
    protected ResearchOrderService $researchOrderService;
    protected OrdersService $orderService;
    public function mount(ResearchOrderService $researchOrderService, OrdersService $orderService): void
    {
        $this->researchOrderService = $researchOrderService;
        $this->orderService = $orderService;
    }
    public function render()
    {

        $auth_user = Auth::guard('Authorized')->user();
        $deadlines = ['DeadLine', 'F_DeadLine', 'S_DeadLine', 'T_DeadLine'];
        $User_ID = (int) $auth_user->id;
        $User_Role_ID = (int) $auth_user->Role_ID;
        $todayDate = Carbon::now()->toDateString();
        $tomorrowDate = Carbon::tomorrow()->toDateString();

        $OrdersToday = [];
        $OrdersTomorrow = [];
        $OrdersPast = [];
        $CordinatorTodayAll = [];
        $CordinatorTomorrowAll = [];
        $CordinatorPreviousAll = [];
        $WriterTodayOrder = [];
        $WriterTomorrowOrder = [];
        $WriterPreviousOrder = [];
        $ContentTodayAll = [];
        $ContentAllTowmorrow = [];
        $ContentAllPrevious = [];
        $Final_DeadLines = [];
        $deadline_times = [];
        $statusCountsFlat = [];
        $empCount = '';
        $lastAttendanceID = '';
        $Leave_Quota = '';
       
        $graphic_today = [];
        $graphic_tomorrow = [];
        $graphic_past = [];


              if ($User_Role_ID == 1 || $User_Role_ID == 9 || $User_Role_ID == 10 || $User_Role_ID == 11) {
            $Deadline_Today_C =   OrderInfo::where('order_infos.Order_Type', 2)
                ->join('content_basic_infos', 'content_basic_infos.order_id', '=', 'order_infos.id')
                ->join('order_client_infos', 'order_client_infos.id', '=', 'order_infos.client_id')
                ->join('order_submission_infos', 'order_submission_infos.order_id', '=', 'order_infos.id')
                ->where('content_basic_infos.Order_Status', '!=', '2')
                ->where('content_basic_infos.Order_Status', '!=', '1')
                ->whereDate('order_submission_infos.DeadLine', $todayDate)
                ->select('order_client_infos.Client_Name', 'order_infos.Order_ID', 'order_submission_infos.DeadLine', 'content_basic_infos.Order_Status', 'order_infos.Order_Type', 'content_basic_infos.Word_Count')
                ->get();
            $Deadline_Today_D =   OrderInfo::where('order_infos.Order_Type', 3)
                ->join('design_order_infos', 'design_order_infos.order_id', '=', 'order_infos.id')
                ->join('order_client_infos', 'order_client_infos.id', '=', 'order_infos.client_id')
                ->join('order_submission_infos', 'order_submission_infos.order_id', '=', 'order_infos.id')
                ->where('design_order_infos.Order_Status', '!=', '2')
                ->where('design_order_infos.Order_Status', '!=', '1')
                ->whereDate('order_submission_infos.DeadLine', $todayDate)
                ->select('order_client_infos.Client_Name', 'order_infos.Order_ID', 'order_submission_infos.DeadLine', 'design_order_infos.Order_Status', 'order_infos.Order_Type',)
                ->get();
            $Deadline_Today_Development =   OrderInfo::where('order_infos.Order_Type', 4)
                ->join('development_order_infos', 'development_order_infos.order_id', '=', 'order_infos.id')
                ->join('order_client_infos', 'order_client_infos.id', '=', 'order_infos.client_id')
                ->join('order_submission_infos', 'order_submission_infos.order_id', '=', 'order_infos.id')
                ->where('development_order_infos.Order_Status', '!=', '2')
                ->where('development_order_infos.Order_Status', '!=', '1')
                ->whereDate('order_submission_infos.DeadLine', $todayDate)
                ->select('order_client_infos.Client_Name', 'order_infos.Order_ID', 'order_submission_infos.DeadLine', 'development_order_infos.Order_Status', 'order_infos.Order_Type',)
                ->get();

            $Deadline_Today_R =   OrderInfo::where('order_infos.Order_Type', 1)
                ->join('order_client_infos', 'order_client_infos.id', '=', 'order_infos.client_id')
                ->join('order_basic_infos', 'order_basic_infos.order_id', '=', 'order_infos.id')
                ->join('order_submission_infos', 'order_submission_infos.order_id', '=', 'order_infos.id')
                ->where('order_basic_infos.Order_Status', '!=', '2')
                ->where('order_basic_infos.Order_Status', '!=', '1')
                ->whereDate('order_submission_infos.DeadLine', $todayDate)
                ->select('order_client_infos.Client_Name', 'order_infos.Order_ID', 'order_submission_infos.DeadLine', 'order_basic_infos.Order_Status', 'order_infos.Order_Type', 'order_basic_infos.Word_Count')
                ->get();

            $OrdersToday = array_merge(
                $Deadline_Today_C->toArray(),
                $Deadline_Today_R->toArray(),
                $Deadline_Today_D->toArray(),
                $Deadline_Today_Development->toArray()
            );

            $draftLetters = ['F', 'S', 'T', 'Four', 'Fifth', 'Sixth', 'Seven', 'Eight', 'nine', 'ten', 'eleven', 'twelve', 'thirteen', 'fourteen', 'fifteen'];
            $counter = 1;
            foreach ($draftLetters as $draftLetter) {
                $F_DeadLines_Today_R = OrderInfo::where('order_infos.Order_Type', 1)
                    ->join('order_basic_infos', 'order_basic_infos.order_id', '=', 'order_infos.id')
                    ->join('order_client_infos', 'order_client_infos.id', '=', 'order_infos.client_id')
                    ->join('order_submission_infos', 'order_submission_infos.order_id', '=', 'order_infos.id')
                    ->leftJoin('draft_submission', function ($join) use ($counter) {
                        $join->on('draft_submission.order_id', '=', 'order_infos.id')
                            ->where('draft_submission.draft_number', '=', $counter);
                    })
                    ->whereDate("order_submission_infos.{$draftLetter}_DeadLine", $todayDate)
                    ->whereNotNull("order_submission_infos.{$draftLetter}_DeadLine")
                    ->whereNull('draft_submission.id')
                    ->where('order_basic_infos.Order_Status', '!=', '2')
                    ->select('order_client_infos.Client_Name', 'order_infos.Order_ID', "order_submission_infos.{$draftLetter}_DeadLine", 'order_basic_infos.Order_Status', 'order_infos.Order_Type', 'order_basic_infos.Word_Count')
                    ->get();
                $Draft_DeadLines_Today_C = OrderInfo::where('order_infos.Order_Type', 2)
                    ->join('content_basic_infos', 'content_basic_infos.order_id', '=', 'order_infos.id')
                    ->join('order_client_infos', 'order_client_infos.id', '=', 'order_infos.client_id')
                    ->join('order_submission_infos', 'order_submission_infos.order_id', '=', 'order_infos.id')
                    ->leftJoin('draft_submission', function ($join) use ($counter) {
                        $join->on('draft_submission.order_id', '=', 'order_infos.id')
                            ->where('draft_submission.draft_number', '=', $counter);
                    })
                    ->whereDate("order_submission_infos.{$draftLetter}_DeadLine", $todayDate)
                    ->where('content_basic_infos.Order_Status', '!=', '2')
                    ->whereNotNull("order_submission_infos.{$draftLetter}_DeadLine")
                    ->whereNull('draft_submission.id')
                    ->select('order_client_infos.Client_Name', 'order_infos.Order_ID', "order_submission_infos.{$draftLetter}_DeadLine", 'content_basic_infos.Order_Status', 'order_infos.Order_Type', 'content_basic_infos.Word_Count')
                    ->distinct()
                    ->get();

                $F_DeadLines_Today_D = OrderInfo::where('order_infos.Order_Type', 3)
                    ->join('design_order_infos', 'design_order_infos.order_id', '=', 'order_infos.id')
                    ->join('order_client_infos', 'order_client_infos.id', '=', 'order_infos.client_id')
                    ->join('order_submission_infos', 'order_submission_infos.order_id', '=', 'order_infos.id')
                    ->leftJoin('draft_submission', function ($join) use ($counter) {
                        $join->on('draft_submission.order_id', '=', 'order_infos.id')
                            ->where('draft_submission.draft_number', '=', $counter);
                    })
                    ->whereDate("order_submission_infos.{$draftLetter}_DeadLine", $todayDate)
                    ->where('design_order_infos.Order_Status', '!=', '2')
                    ->whereNotNull("order_submission_infos.{$draftLetter}_DeadLine")
                    ->whereNull('draft_submission.id')
                    ->select('order_client_infos.Client_Name', 'order_infos.Order_ID', "order_submission_infos.{$draftLetter}_DeadLine", 'design_order_infos.Order_Status', 'order_infos.Order_Type')
                    ->get();

                $F_DeadLines_Today_Development = OrderInfo::where('order_infos.Order_Type', 4)
                    ->join('development_order_infos', 'development_order_infos.order_id', '=', 'order_infos.id')
                    ->join('order_client_infos', 'order_client_infos.id', '=', 'order_infos.client_id')
                    ->join('order_submission_infos', 'order_submission_infos.order_id', '=', 'order_infos.id')
                    ->leftJoin('draft_submission', function ($join) use ($counter) {
                        $join->on('draft_submission.order_id', '=', 'order_infos.id')
                            ->where('draft_submission.draft_number', '=', $counter);
                    })
                    ->whereDate("order_submission_infos.{$draftLetter}_DeadLine", $todayDate)
                    ->where('development_order_infos.Order_Status', '!=', '2')
                    ->whereNotNull("order_submission_infos.{$draftLetter}_DeadLine")
                    ->whereNull('draft_submission.id')
                    ->select('order_client_infos.Client_Name', 'order_infos.Order_ID', "order_submission_infos.{$draftLetter}_DeadLine", 'development_order_infos.Order_Status', 'order_infos.Order_Type')
                    ->get();


                $OrdersToday = array_merge($OrdersToday, $Draft_DeadLines_Today_C->toArray(), $F_DeadLines_Today_R->toArray(), $F_DeadLines_Today_D->toArray(), $F_DeadLines_Today_Development->toArray());
                $counter++;
            }
            $Deadline_Tomorrow_C =   OrderInfo::where('order_infos.Order_Type', 2)
                ->join('content_basic_infos', 'content_basic_infos.order_id', '=', 'order_infos.id')
                ->join('order_client_infos', 'order_client_infos.id', '=', 'order_infos.client_id')
                ->join('order_submission_infos', 'order_submission_infos.order_id', '=', 'order_infos.id')
                ->where('content_basic_infos.Order_Status', '!=', '2')
                ->where('content_basic_infos.Order_Status', '!=', '1')
                ->whereDate('order_submission_infos.DeadLine', $tomorrowDate)
                ->select('order_client_infos.Client_Name', 'order_infos.Order_ID', 'order_submission_infos.DeadLine', 'content_basic_infos.Order_Status', 'order_infos.Order_Type', 'content_basic_infos.Word_Count')
                ->get();
            $Deadline_Tomorrow_R =   OrderInfo::where('order_infos.Order_Type', 1)
                ->join('order_basic_infos', 'order_basic_infos.order_id', '=', 'order_infos.id')
                ->join('order_client_infos', 'order_client_infos.id', '=', 'order_infos.client_id')
                ->join('order_submission_infos', 'order_submission_infos.order_id', '=', 'order_infos.id')
                ->where('order_basic_infos.Order_Status', '!=', '2')
                ->where('order_basic_infos.Order_Status', '!=', '1')
                ->whereDate('order_submission_infos.DeadLine', $tomorrowDate)
                ->select('order_client_infos.Client_Name', 'order_infos.Order_ID', 'order_submission_infos.DeadLine', 'order_basic_infos.Order_Status', 'order_infos.Order_Type', 'order_basic_infos.Word_Count')
                ->get();

            $Deadline_Tomorrow_D =   OrderInfo::where('order_infos.Order_Type', 3)
                ->join('design_order_infos', 'design_order_infos.order_id', '=', 'order_infos.id')
                ->join('order_client_infos', 'order_client_infos.id', '=', 'order_infos.client_id')
                ->join('order_submission_infos', 'order_submission_infos.order_id', '=', 'order_infos.id')
                ->where('design_order_infos.Order_Status', '!=', '2')
                ->where('design_order_infos.Order_Status', '!=', '1')
                ->whereDate('order_submission_infos.DeadLine', $tomorrowDate)
                ->select('order_client_infos.Client_Name', 'order_infos.Order_ID', 'order_submission_infos.DeadLine', 'design_order_infos.Order_Status', 'order_infos.Order_Type',)
                ->get();
            $Deadline_Tomorrow_Development =  OrderInfo::where('order_infos.Order_Type', 4)
                ->join('development_order_infos', 'development_order_infos.order_id', '=', 'order_infos.id')
                ->join('order_client_infos', 'order_client_infos.id', '=', 'order_infos.client_id')
                ->join('order_submission_infos', 'order_submission_infos.order_id', '=', 'order_infos.id')
                ->where('development_order_infos.Order_Status', '!=', '2')
                ->where('development_order_infos.Order_Status', '!=', '1')
                ->whereDate('order_submission_infos.DeadLine', $tomorrowDate)
                ->select('order_client_infos.Client_Name', 'order_infos.Order_ID', 'order_submission_infos.DeadLine', 'development_order_infos.Order_Status', 'order_infos.Order_Type',)
                ->get();
            $OrdersTomorrow = array_merge(
                $Deadline_Tomorrow_C->toArray(),
                $Deadline_Tomorrow_R->toArray(),
                $Deadline_Tomorrow_D->toArray(),
                $Deadline_Tomorrow_Development->toArray()
            );
            $counter1 = 1;
            foreach ($draftLetters as $draftLetter) {
                $F_DeadLines_Tomorrow_R = OrderInfo::where('order_infos.Order_Type', 1)
                    ->join('order_basic_infos', 'order_basic_infos.order_id', '=', 'order_infos.id')
                    ->join('order_client_infos', 'order_client_infos.id', '=', 'order_infos.client_id')
                    ->join('order_submission_infos', 'order_submission_infos.order_id', '=', 'order_infos.id')
                    ->leftJoin('draft_submission', function ($join) use ($counter1) {
                        $join->on('draft_submission.order_id', '=', 'order_infos.id')
                            ->where('draft_submission.draft_number', '=', $counter1);
                    })
                    ->whereDate("order_submission_infos.{$draftLetter}_DeadLine", $tomorrowDate)
                    ->whereNotNull("order_submission_infos.{$draftLetter}_DeadLine")
                    ->whereNull('draft_submission.id')
                    ->where('order_basic_infos.Order_Status', '!=', '2')
                    ->select('order_client_infos.Client_Name', 'order_infos.Order_ID', "order_submission_infos.{$draftLetter}_DeadLine", 'order_basic_infos.Order_Status', 'order_infos.Order_Type', 'order_basic_infos.Word_Count')
                    ->get();

                $Draft_DeadLines_Tomorrow_C = OrderInfo::where('order_infos.Order_Type', 2)
                    ->join('content_basic_infos', 'content_basic_infos.order_id', '=', 'order_infos.id')
                    ->join('order_client_infos', 'order_client_infos.id', '=', 'order_infos.client_id')
                    ->join('order_submission_infos', 'order_submission_infos.order_id', '=', 'order_infos.id')
                    ->leftJoin('draft_submission', function ($join) use ($counter1) {
                        $join->on('draft_submission.order_id', '=', 'order_infos.id')
                            ->where('draft_submission.draft_number', '=', $counter1);
                    })
                    ->whereDate("order_submission_infos.{$draftLetter}_DeadLine", $tomorrowDate)
                    ->where('content_basic_infos.Order_Status', '!=', '2')
                    ->whereNotNull("order_submission_infos.{$draftLetter}_DeadLine")
                    ->whereNull('draft_submission.id')
                    ->select('order_client_infos.Client_Name', 'order_infos.Order_ID', "order_submission_infos.{$draftLetter}_DeadLine", 'content_basic_infos.Order_Status', 'order_infos.Order_Type', 'content_basic_infos.Word_Count')
                    ->distinct()
                    ->get();

                $F_DeadLines_Tommorow_D = OrderInfo::where('order_infos.Order_Type', 3)
                    ->join('design_order_infos', 'design_order_infos.order_id', '=', 'order_infos.id')
                    ->join('order_client_infos', 'order_client_infos.id', '=', 'order_infos.client_id')
                    ->join('order_submission_infos', 'order_submission_infos.order_id', '=', 'order_infos.id')
                    ->leftJoin('draft_submission', function ($join) use ($counter) {
                        $join->on('draft_submission.order_id', '=', 'order_infos.id')
                            ->where('draft_submission.draft_number', '=', $counter);
                    })
                    ->whereDate("order_submission_infos.{$draftLetter}_DeadLine", $tomorrowDate)
                    ->where('design_order_infos.Order_Status', '!=', '2')
                    ->whereNotNull("order_submission_infos.{$draftLetter}_DeadLine")
                    ->whereNull('draft_submission.id')
                    ->select('order_client_infos.Client_Name', 'order_infos.Order_ID', "order_submission_infos.{$draftLetter}_DeadLine", 'design_order_infos.Order_Status', 'order_infos.Order_Type')
                    ->get();

                $F_DeadLines_Tomorrow_Development = OrderInfo::where('order_infos.Order_Type', 4)
                    ->join('development_order_infos', 'development_order_infos.order_id', '=', 'order_infos.id')
                    ->join('order_client_infos', 'order_client_infos.id', '=', 'order_infos.client_id')
                    ->join('order_submission_infos', 'order_submission_infos.order_id', '=', 'order_infos.id')
                    ->leftJoin('draft_submission', function ($join) use ($counter) {
                        $join->on('draft_submission.order_id', '=', 'order_infos.id')
                            ->where('draft_submission.draft_number', '=', $counter);
                    })
                    ->whereDate("order_submission_infos.{$draftLetter}_DeadLine", $tomorrowDate)
                    ->where('development_order_infos.Order_Status', '!=', '2')
                    ->whereNotNull("order_submission_infos.{$draftLetter}_DeadLine")
                    ->whereNull('draft_submission.id')
                    ->select('order_client_infos.Client_Name', 'order_infos.Order_ID', "order_submission_infos.{$draftLetter}_DeadLine", 'development_order_infos.Order_Status', 'order_infos.Order_Type')
                    ->get();
                $OrdersTomorrow = array_merge(
                    $OrdersTomorrow,
                    $Draft_DeadLines_Tomorrow_C->toArray(),
                    $F_DeadLines_Tomorrow_R->toArray(),
                    $F_DeadLines_Tommorow_D->toArray(),
                    $F_DeadLines_Tomorrow_Development->toArray()
                );
                $counter1++;
            }

            $cacheKey = 'orders_past_data';
            $OrdersPast = Cache::remember(
                $cacheKey,
                now()->addHours(24),
                function () {
                    $dateFields = [
                        'F_DeadLine' => 'F_DeadLine',
                        'DeadLine' => 'DeadLine',
                        'S_DeadLine' => 'S_DeadLine',
                        'T_DeadLine' => 'T_DeadLine',
                    ];

                    $ordersPastResult = [];

                    foreach ($dateFields as $field => $column) {
                        $todayDate = Carbon::now()->toDateString();

                        if ($column == 'F_DeadLine') {
                            $draftNumber = 1;
                        } elseif ($column == 'S_DeadLine') {
                            $draftNumber = 2;
                        } elseif ($column == 'T_DeadLine') {
                            $draftNumber = 3;
                        } elseif ($column == 'DeadLine') {
                            $draftNumber = 0;
                        }

                        $pastOrders = OrderSubmissionInfo::select('order_submission_infos.' . $column, 'order_submission_infos.client_id', 'order_submission_infos.order_id')
                            ->whereDate('order_submission_infos.' . $column, '<', $todayDate)
                            ->join('order_infos', 'order_infos.id', '=', 'order_submission_infos.order_id')
                            ->orderByDesc('order_infos.id');

                        $pastOrders->leftJoin('draft_submission', function ($join) use ($draftNumber) {
                            $join->on('draft_submission.order_id', '=', 'order_submission_infos.order_id')
                                ->where('draft_submission.draft_number', $draftNumber);
                        });

                        $pastOrders->whereNull('order_infos.deleted_at');
                        $orderIds = $pastOrders->pluck('order_submission_infos.order_id')->toArray();

                        if (!empty($orderIds)) {
                            $pastOrders->whereIn('order_submission_infos.order_id', $orderIds)
                                ->whereExists(function ($query) use ($draftNumber) {
                                    $query->select(DB::raw(1))
                                        ->from('draft_submission as draft_' . $draftNumber)
                                        ->whereRaw('draft_' . $draftNumber . '.order_id = order_submission_infos.order_id')
                                        ->where('draft_' . $draftNumber . '.draft_number', '<>', $draftNumber);
                                });

                            $OrderType = OrderInfo::where('Order_Type', 2)->whereIn('id', $orderIds)->first();

                            if ($OrderType) {
                                if ($OrderType->Order_Type == 1) {
                                    $pastOrders->join('order_basic_infos', 'order_basic_infos.order_id', '=', 'order_submission_infos.order_id')
                                        ->whereNotIn('order_basic_infos.Order_Status', [1, 2]);
                                } elseif ($OrderType->Order_Type == 2) {
                                    $pastOrders->join('content_basic_infos', 'content_basic_infos.order_id', '=', 'order_submission_infos.order_id')
                                        ->whereNotIn('content_basic_infos.Order_Status', [1, 2]);
                                }
                            }
                            $pastOrdersResult = $pastOrders->get();
                            $ordersPastResult = array_merge($ordersPastResult, $pastOrdersResult->toArray());
                        }
                    }
                    return $ordersPastResult;
                }
            );
        }
        if ($User_Role_ID == 4) {
            $Deadline_Today_R =   OrderInfo::where('order_infos.Order_Type', 1)
                ->join('order_client_infos', 'order_client_infos.id', '=', 'order_infos.client_id')
                ->join('order_basic_infos', 'order_basic_infos.order_id', '=', 'order_infos.id')
                ->join('order_submission_infos', 'order_submission_infos.order_id', '=', 'order_infos.id')
                ->where('order_basic_infos.Order_Status', '!=', '2')
                ->where('order_basic_infos.Order_Status', '!=', '1')
                ->whereDate('order_submission_infos.DeadLine', $todayDate)
                ->select('order_client_infos.Client_Name', 'order_infos.Order_ID', 'order_submission_infos.DeadLine', 'order_basic_infos.Order_Status', 'order_infos.Order_Type', 'order_basic_infos.Word_Count')
                ->get();
            $OrdersToday = $Deadline_Today_R->toArray();
            $draftLetters = ['F', 'S', 'T', 'Four', 'Fifth', 'Sixth', 'Seven', 'Eight', 'nine', 'ten', 'eleven', 'twelve', 'thirteen', 'fourteen', 'fifteen'];
            $counter_manager_1 = 1;
            foreach ($draftLetters as $draftLetter) {
                $Drafts_Today_R = OrderInfo::where('order_infos.Order_Type', 1)
                    ->join('order_basic_infos', 'order_basic_infos.order_id', '=', 'order_infos.id')
                    ->join('order_client_infos', 'order_client_infos.id', '=', 'order_infos.client_id')
                    ->join('order_submission_infos', 'order_submission_infos.order_id', '=', 'order_infos.id')
                    ->leftJoin('draft_submission', function ($join) use ($counter_manager_1) {
                        $join->on('draft_submission.order_id', '=', 'order_infos.id')
                            ->where('draft_submission.draft_number', '=', $counter_manager_1);
                    })
                    ->whereDate("order_submission_infos.{$draftLetter}_DeadLine", $todayDate)
                    ->whereNotNull("order_submission_infos.{$draftLetter}_DeadLine")
                    ->whereNull('draft_submission.id')
                    ->where('order_basic_infos.Order_Status', '!=', '2')
                    ->select('order_client_infos.Client_Name', 'order_infos.Order_ID', "order_submission_infos.{$draftLetter}_DeadLine", 'order_basic_infos.Order_Status', 'order_infos.Order_Type', 'order_basic_infos.Word_Count')
                    ->get();
                $OrdersToday = array_merge($OrdersToday, $Drafts_Today_R->toArray());
                $counter_manager_1++;
            }
            $Deadline_Tomorrow_R =   OrderInfo::where('order_infos.Order_Type', 1)
                ->join('order_basic_infos', 'order_basic_infos.order_id', '=', 'order_infos.id')
                ->join('order_client_infos', 'order_client_infos.id', '=', 'order_infos.client_id')
                ->join('order_submission_infos', 'order_submission_infos.order_id', '=', 'order_infos.id')
                ->where('order_basic_infos.Order_Status', '!=', '2')
                ->where('order_basic_infos.Order_Status', '!=', '1')
                ->whereDate('order_submission_infos.DeadLine', $tomorrowDate)
                ->select('order_client_infos.Client_Name', 'order_infos.Order_ID', 'order_submission_infos.DeadLine', 'order_basic_infos.Order_Status', 'order_infos.Order_Type', 'order_basic_infos.Word_Count')
                ->get();
            $OrdersTomorrow = $Deadline_Tomorrow_R->toArray();
            $draftLetters = ['F', 'S', 'T', 'Four', 'Fifth', 'Sixth', 'Seven', 'Eight', 'nine', 'ten', 'eleven', 'twelve', 'thirteen', 'fourteen', 'fifteen'];
            $countermanager2 = 1;
            foreach ($draftLetters as $draftLetter) {
                $DeadLines_Tomorrow_R = OrderInfo::where('order_infos.Order_Type', 1)
                    ->join('order_basic_infos', 'order_basic_infos.order_id', '=', 'order_infos.id')
                    ->join('order_client_infos', 'order_client_infos.id', '=', 'order_infos.client_id')
                    ->join('order_submission_infos', 'order_submission_infos.order_id', '=', 'order_infos.id')
                    ->leftJoin('draft_submission', function ($join) use ($countermanager2) {
                        $join->on('draft_submission.order_id', '=', 'order_infos.id')
                            ->where('draft_submission.draft_number', '=', $countermanager2);
                    })
                    ->whereDate("order_submission_infos.{$draftLetter}_DeadLine", $tomorrowDate)
                    ->whereNotNull("order_submission_infos.{$draftLetter}_DeadLine")
                    ->whereNull('draft_submission.id')
                    ->select('order_client_infos.Client_Name', 'order_infos.Order_ID', "order_submission_infos.{$draftLetter}_DeadLine", 'order_basic_infos.Order_Status', 'order_infos.Order_Type', 'order_basic_infos.Word_Count')
                    ->get();

                $OrdersTomorrow = array_merge($OrdersTomorrow, $DeadLines_Tomorrow_R->toArray());
                $countermanager2++;
            }

            $dateFields = [
                'F_DeadLine' => 'F_DeadLine',
                'DeadLine' => 'DeadLine',
                'S_DeadLine' => 'S_DeadLine',
                'T_DeadLine' => 'T_DeadLine',
            ];
            $cacheKey = 'orders_past_data';
            $OrdersPast = Cache::remember($cacheKey, now()->addHours(24), function () {
                $dateFields = [
                    'F_DeadLine' => 'F_DeadLine',
                    'DeadLine' => 'DeadLine',
                    'S_DeadLine' => 'S_DeadLine',
                    'T_DeadLine' => 'T_DeadLine',
                ];

                $ordersPastResult = [];

                foreach ($dateFields as $field => $column) {
                    $todayDate = Carbon::now()->toDateString();

                    if ($column == 'F_DeadLine') {
                        $draftNumber = 1;
                    } elseif ($column == 'S_DeadLine') {
                        $draftNumber = 2;
                    } elseif ($column == 'T_DeadLine') {
                        $draftNumber = 3;
                    } elseif ($column == 'DeadLine') {
                        $draftNumber = 0;
                    }

                    $pastOrders = OrderSubmissionInfo::select('order_submission_infos.' . $column, 'order_submission_infos.client_id', 'order_submission_infos.order_id')
                        ->whereDate('order_submission_infos.' . $column, '<', $todayDate)
                        ->join('order_infos', 'order_infos.id', '=', 'order_submission_infos.order_id')
                        ->orderByDesc('order_infos.id');

                    $pastOrders->leftJoin('draft_submission', function ($join) use ($draftNumber) {
                        $join->on('draft_submission.order_id', '=', 'order_submission_infos.order_id')
                            ->where('draft_submission.draft_number', $draftNumber);
                    });
                    $pastOrders->whereNull('order_infos.deleted_at');
                    $orderIds = $pastOrders->pluck('order_submission_infos.order_id')->toArray();
                    if (!empty($orderIds)) {
                        $pastOrders->whereIn('order_submission_infos.order_id', $orderIds)
                            ->whereExists(function ($query) use ($draftNumber) {
                                $query->select(DB::raw(1))
                                    ->from('draft_submission as draft_' . $draftNumber)
                                    ->whereRaw('draft_' . $draftNumber . '.order_id = order_submission_infos.order_id')
                                    ->where('draft_' . $draftNumber . '.draft_number', '<>', $draftNumber);
                            });

                        $OrderType = OrderInfo::Where('Order_Type', 1)->whereIn('id', $orderIds)->first();

                        if ($OrderType) {
                            if ($OrderType->Order_Type == 1) {
                                $pastOrders->join('order_basic_infos', 'order_basic_infos.order_id', '=', 'order_submission_infos.order_id')
                                    ->whereNotIn('order_basic_infos.Order_Status', [1, 2]);
                            } elseif ($OrderType->Order_Type == 2) {
                                $pastOrders->join('content_basic_infos', 'content_basic_infos.order_id', '=', 'order_submission_infos.order_id')
                                    ->whereNotIn('content_basic_infos.Order_Status', [1, 2]);
                            }
                        }
                        $pastOrdersResult = $pastOrders->get();
                        $ordersPastResult = array_merge($ordersPastResult, $pastOrdersResult->toArray());
                    }
                }
                return $ordersPastResult;
            });
        } elseif ($User_Role_ID == 17) {
            $Deadline_Today_C =   OrderInfo::where('order_infos.Order_Type', 2)
                ->join('content_basic_infos', 'content_basic_infos.order_id', '=', 'order_infos.id')
                ->join('order_client_infos', 'order_client_infos.id', '=', 'order_infos.client_id')
                ->join('order_submission_infos', 'order_submission_infos.order_id', '=', 'order_infos.id')
                ->where('content_basic_infos.Order_Status', '!=', '2')
                ->where('content_basic_infos.Order_Status', '!=', '1')
                ->whereDate('order_submission_infos.DeadLine', $todayDate)
                ->select('order_client_infos.Client_Name', 'order_infos.Order_ID', 'order_submission_infos.DeadLine', 'content_basic_infos.Order_Status', 'order_infos.Order_Type', 'content_basic_infos.Word_Count')
                ->get();
            $OrdersToday = $Deadline_Today_C->toArray();
            $draftLetters = ['F', 'S', 'T', 'Four', 'Fifth', 'Sixth', 'Seven', 'Eight', 'nine', 'ten', 'eleven', 'twelve', 'thirteen', 'fourteen', 'fifteen'];
            $counter = 1;
            foreach ($draftLetters as $draftLetter) {
                $Draft_DeadLines_Today_C = OrderInfo::where('order_infos.Order_Type', 2)
                    ->join('content_basic_infos', 'content_basic_infos.order_id', '=', 'order_infos.id')
                    ->join('order_client_infos', 'order_client_infos.id', '=', 'order_infos.client_id')
                    ->join('order_submission_infos', 'order_submission_infos.order_id', '=', 'order_infos.id')
                    ->leftJoin('draft_submission', function ($join) use ($counter) {
                        $join->on('draft_submission.order_id', '=', 'order_infos.id')
                            ->where('draft_submission.draft_number', '=', $counter);
                    })
                    ->whereDate("order_submission_infos.{$draftLetter}_DeadLine", $todayDate)
                    ->where('content_basic_infos.Order_Status', '!=', '2')
                    ->whereNotNull("order_submission_infos.{$draftLetter}_DeadLine")
                    ->whereNull('draft_submission.id')
                    ->select('order_client_infos.Client_Name', 'order_infos.Order_ID', "order_submission_infos.{$draftLetter}_DeadLine", 'content_basic_infos.Order_Status', 'order_infos.Order_Type', 'content_basic_infos.Word_Count')
                    ->distinct()
                    ->get();

                $OrdersToday = array_merge($OrdersToday, $Draft_DeadLines_Today_C->toArray());
                $counter++;
            }
            $Deadline_Tomorrow_C =   OrderInfo::where('order_infos.Order_Type', 2)
                ->join('content_basic_infos', 'content_basic_infos.order_id', '=', 'order_infos.id')
                ->join('order_client_infos', 'order_client_infos.id', '=', 'order_infos.client_id')
                ->join('order_submission_infos', 'order_submission_infos.order_id', '=', 'order_infos.id')
                ->where('content_basic_infos.Order_Status', '!=', '2')
                ->where('content_basic_infos.Order_Status', '!=', '1')
                ->whereDate('order_submission_infos.DeadLine', $tomorrowDate)
                ->select('order_client_infos.Client_Name', 'order_infos.Order_ID', 'order_submission_infos.DeadLine', 'content_basic_infos.Order_Status', 'order_infos.Order_Type', 'content_basic_infos.Word_Count')
                ->get();
            $OrdersTomorrow = $Deadline_Tomorrow_C->toArray();
            $counter1 = 1;
            foreach ($draftLetters as $draftLetter) {
                $Draft_DeadLines_Tomorrow_C = OrderInfo::where('order_infos.Order_Type', 2)
                    ->join('content_basic_infos', 'content_basic_infos.order_id', '=', 'order_infos.id')
                    ->join('order_client_infos', 'order_client_infos.id', '=', 'order_infos.client_id')
                    ->join('order_submission_infos', 'order_submission_infos.order_id', '=', 'order_infos.id')
                    ->leftJoin('draft_submission', function ($join) use ($counter1) {
                        $join->on('draft_submission.order_id', '=', 'order_infos.id')
                            ->where('draft_submission.draft_number', '=', $counter1);
                    })
                    ->whereDate("order_submission_infos.{$draftLetter}_DeadLine", $tomorrowDate)
                    ->where('content_basic_infos.Order_Status', '!=', '2')
                    ->whereNotNull("order_submission_infos.{$draftLetter}_DeadLine")
                    ->whereNull('draft_submission.id')
                    ->select('order_client_infos.Client_Name', 'order_infos.Order_ID', "order_submission_infos.{$draftLetter}_DeadLine", 'content_basic_infos.Order_Status', 'order_infos.Order_Type', 'content_basic_infos.Word_Count')
                    ->distinct()
                    ->get();
                $OrdersTomorrow = array_merge($OrdersTomorrow, $Draft_DeadLines_Tomorrow_C->toArray());
                $counter1++;
            }
        } elseif ($User_Role_ID == 5 || $User_Role_ID == 7) {
            $CordinationDeadlineToday = OrderInfo::join('order_submission_infos', 'order_submission_infos.order_id', '=', 'order_infos.id')
                ->join('order_assigning_infos', 'order_assigning_infos.order_id', '=', 'order_infos.id')
                ->join('order_basic_infos', 'order_basic_infos.order_id', '=', 'order_infos.id')
                ->where('order_basic_infos.Order_Status', '!=', '2')
                ->where('order_basic_infos.Order_Status', '!=', '1')
                ->where('order_assigning_infos.assign_id', '=', $User_ID)
                ->whereDate('order_submission_infos.DeadLine', '=', $todayDate)
                ->select('order_infos.Order_ID', 'order_infos.Order_Type', 'order_basic_infos.Word_Count', 'order_submission_infos.DeadLine', 'order_basic_infos.Word_Count', 'Order_Status')
                ->get();
                
                
        
            $CordinatorTodayAll = $CordinationDeadlineToday->toArray();
            $draftLetters = ['F', 'S', 'T', 'Four', 'Fifth', 'Sixth', 'Seven', 'Eight', 'nine', 'ten', 'eleven', 'twelve', 'thirteen', 'fourteen', 'fifteen'];
            $counterwriter = 1;
            foreach ($draftLetters as $draftLetter) {
                $writer_Deadline_Today = OrderInfo::join('order_submission_infos', 'order_submission_infos.order_id', '=', 'order_infos.id')
                    ->join('order_assigning_infos', 'order_assigning_infos.order_id', '=', 'order_infos.id')
                    ->join('order_basic_infos', 'order_basic_infos.order_id', '=', 'order_infos.id')
                    ->where('order_basic_infos.Order_Status', '!=', '2')
                    ->where('order_assigning_infos.assign_id', '=', $User_ID)
                    ->whereDate("order_submission_infos.{$draftLetter}_DeadLine", '=', $todayDate)
                    ->whereDoesntHave('draftSubmissions', function ($query) use ($counterwriter) {
                        $query->where('draft_number', $counterwriter);
                    })
                    ->select('order_infos.Order_ID', 'order_infos.Order_Type', 'order_basic_infos.Word_Count', "order_submission_infos.{$draftLetter}_DeadLine", 'order_basic_infos.Word_Count', 'Order_Status')
                    ->get();

                $CordinatorTodayAll = array_merge($CordinatorTodayAll, $writer_Deadline_Today->toArray());
                $counterwriter++;
            }
            
            
            // $CordinationF_DeadlineToday = OrderInfo::join('order_submission_infos', 'order_submission_infos.order_id', '=', 'order_infos.id')
            //     ->join('order_assigning_infos', 'order_assigning_infos.order_id', '=', 'order_infos.id')
            //     ->join('order_basic_infos', 'order_basic_infos.order_id', '=', 'order_infos.id')
            //     ->where('order_assigning_infos.assign_id', '=', $User_ID)
            //     ->whereDate('order_submission_infos.F_DeadLine', '=', $todayDate)
            //     ->whereDoesntHave('draftSubmissions', function ($query) {
            //         $query->where('draft_number', 1);
            //     })
            //     ->select('order_infos.Order_ID', 'order_infos.Order_Type', 'order_basic_infos.Word_Count', 'order_submission_infos.F_DeadLine', 'order_basic_infos.Word_Count', 'Order_Status')
            //     ->get();

            // $CordinationS_DeadlineToday = OrderInfo::join('order_submission_infos', 'order_submission_infos.order_id', '=', 'order_infos.id')
            //     ->join('order_assigning_infos', 'order_assigning_infos.order_id', '=', 'order_infos.id')
            //     ->join('order_basic_infos', 'order_basic_infos.order_id', '=', 'order_infos.id')
            //     ->where('order_assigning_infos.assign_id', '=', $User_ID)
            //     ->whereDate('order_submission_infos.S_DeadLine', '=', $todayDate)
            //     ->whereDoesntHave('draftSubmissions', function ($query) {
            //         $query->where('draft_number', 2);
            //     })
            //     ->select('order_infos.Order_ID', 'order_infos.Order_Type', 'order_basic_infos.Word_Count', 'order_submission_infos.S_DeadLine', 'order_basic_infos.Word_Count', 'Order_Status')
            //     ->get();

            // $CordinationT_DeadlineToday = OrderInfo::join('order_submission_infos', 'order_submission_infos.order_id', '=', 'order_infos.id')
            //     ->join('order_assigning_infos', 'order_assigning_infos.order_id', '=', 'order_infos.id')
            //     ->join('order_basic_infos', 'order_basic_infos.order_id', '=', 'order_infos.id')
            //     ->where('order_assigning_infos.assign_id', '=', $User_ID)
            //     ->whereDate('order_submission_infos.T_DeadLine', '=', $todayDate)
            //     ->whereDoesntHave('draftSubmissions', function ($query) {
            //         $query->where('draft_number', 3);
            //     })
            //     ->select('order_infos.Order_ID', 'order_infos.Order_Type', 'order_basic_infos.Word_Count', 'order_submission_infos.T_DeadLine', 'order_basic_infos.Word_Count', 'Order_Status')
            //     ->get();

            // $CordinatorTodayAll = array_merge(
            //     $CordinationDeadlineToday->toArray(),
            //     $CordinationF_DeadlineToday->toArray(),
            //     $CordinationS_DeadlineToday->toArray(),
            //     $CordinationT_DeadlineToday->toArray()
            // );

            $CordinationDeadlineTomorrow = OrderInfo::join('order_submission_infos', 'order_submission_infos.order_id', '=', 'order_infos.id')
                ->join('order_assigning_infos', 'order_assigning_infos.order_id', '=', 'order_infos.id')
                ->join('order_basic_infos', 'order_basic_infos.order_id', '=', 'order_infos.id')
                ->where('order_assigning_infos.assign_id', '=', $User_ID)
                ->where('order_basic_infos.Order_Status', '!=', '2')
                ->where('order_basic_infos.Order_Status', '!=', '1')
                ->whereDate('order_submission_infos.DeadLine', '=', $tomorrowDate)
                ->select('order_infos.Order_ID', 'order_infos.Order_Type', 'order_basic_infos.Word_Count', 'order_submission_infos.DeadLine', 'order_basic_infos.Word_Count', 'Order_Status')
                ->get();


            $CordinatorTomorrowAll = $CordinationDeadlineTomorrow->toArray();
            $draftLetters = ['F', 'S', 'T', 'Four', 'Fifth', 'Sixth', 'Seven', 'Eight', 'nine', 'ten', 'eleven', 'twelve', 'thirteen', 'fourteen', 'fifteen'];
            $counterwriter123 = 1;
            foreach ($draftLetters as $draftLetter) {
                $writer_Deadline_Today1 = OrderInfo::join('order_submission_infos', 'order_submission_infos.order_id', '=', 'order_infos.id')
                    ->join('order_assigning_infos', 'order_assigning_infos.order_id', '=', 'order_infos.id')
                    ->join('order_basic_infos', 'order_basic_infos.order_id', '=', 'order_infos.id')
                    ->where('order_basic_infos.Order_Status', '!=', '2')
                    ->where('order_assigning_infos.assign_id', '=', $User_ID)
                    ->whereDate("order_submission_infos.{$draftLetter}_DeadLine", '=', $tomorrowDate)
                    ->whereDoesntHave('draftSubmissions', function ($query) use ($counterwriter123) {
                        $query->where('draft_number', $counterwriter123);
                    })
                    ->select('order_infos.Order_ID', 'order_infos.Order_Type', 'order_basic_infos.Word_Count', "order_submission_infos.{$draftLetter}_DeadLine", 'order_basic_infos.Word_Count', 'Order_Status')
                    ->get();

                $CordinatorTomorrowAll = array_merge($CordinatorTomorrowAll, $writer_Deadline_Today1->toArray());
                $counterwriter123++;
            }
            

            // $CordinationS_DeadlineTomorrow = OrderInfo::join('order_submission_infos', 'order_submission_infos.order_id', '=', 'order_infos.id')
            //     ->join('order_assigning_infos', 'order_assigning_infos.order_id', '=', 'order_infos.id')
            //     ->join('order_basic_infos', 'order_basic_infos.order_id', '=', 'order_infos.id')
            //     ->where('order_assigning_infos.assign_id', '=', $User_ID)
            //     ->whereDate('order_submission_infos.S_DeadLine', '=', $tomorrowDate)
            //     ->whereDoesntHave('draftSubmissions', function ($query) {
            //         $query->where('draft_number', 2);
            //     })
            //     ->select('order_infos.Order_ID', 'order_infos.Order_Type', 'order_basic_infos.Word_Count', 'order_submission_infos.S_DeadLine', 'order_basic_infos.Word_Count', 'Order_Status')
            //     ->get();

            // $CordinationT_DeadlineTomorrow = OrderInfo::join('order_submission_infos', 'order_submission_infos.order_id', '=', 'order_infos.id')
            //     ->join('order_assigning_infos', 'order_assigning_infos.order_id', '=', 'order_infos.id')
            //     ->join('order_basic_infos', 'order_basic_infos.order_id', '=', 'order_infos.id')
            //     ->where('order_assigning_infos.assign_id', '=', $User_ID)
            //     ->whereDate('order_submission_infos.T_DeadLine', '=', $tomorrowDate)
            //     ->whereDoesntHave('draftSubmissions', function ($query) {
            //         $query->where('draft_number', 3);
            //     })
            //     ->select('order_infos.Order_ID', 'order_infos.Order_Type', 'order_basic_infos.Word_Count', 'order_submission_infos.T_DeadLine', 'order_basic_infos.Word_Count', 'Order_Status')
            //     ->get();

            // $CordinatorTomorrowAll  = array_merge(
            //     $CordinationDeadlineTomorrow->toArray(),
            //     $CordinationF_DeadlineTomorrow->toArray(),
            //     $CordinationS_DeadlineTomorrow->toArray(),
            //     $CordinationT_DeadlineTomorrow->toArray()
            // );


            $CordinatorPreviousAll = Cache::remember('cordinator_previous_data', 60 * 24, function () use ($deadlines, $todayDate, $User_ID) {
                $cordinatorPreviousAll = [];

                foreach ($deadlines as $deadline) {
                    $cordinatorPreviousData = OrderInfo::with(['submission_info' => function ($query) use ($deadline, $todayDate) {
                        $query->select('id', $deadline, 'order_id')->whereDate($deadline, '<', $todayDate);
                    }])->whereHas('submission_info', function ($q) use ($deadline, $todayDate) {
                        $q->whereDate($deadline, '<', $todayDate);
                    })->whereHas('assign', function ($q) use ($User_ID) {
                        $q->where('assign_id', $User_ID);
                    })->get();

                    $cordinatorPreviousAll = array_merge($cordinatorPreviousAll, $cordinatorPreviousData->toArray());
                }

                return $cordinatorPreviousAll;
            });
        } elseif ($User_Role_ID == 6  || $User_Role_ID == 7) {
            $WriterTodayOrder = OrderInfo::with(['tasks' => function ($query) use ($User_ID, $todayDate) {
                $query->where('assign_id', $User_ID)->whereDate('DeadLine', $todayDate)->whereNotIn('Task_Status', [1, 2]);
            }])->whereHas('tasks', function ($q) use ($User_ID, $todayDate) {
                $q->where('assign_id', $User_ID)->whereDate('DeadLine', $todayDate)->whereNotIn('Task_Status', [1, 2]);
            })->get();
            $WriterTomorrowOrder = OrderInfo::with(['tasks' => function ($query) use ($User_ID, $tomorrowDate) {
                $query->where('assign_id', $User_ID)->whereDate('DeadLine', $tomorrowDate)->whereNotIn('Task_Status', [1, 2]);
            }])->whereHas('tasks', function ($q) use ($User_ID, $tomorrowDate) {
                $q->where('assign_id', $User_ID)->whereDate('DeadLine', $tomorrowDate)->whereNotIn('Task_Status', [1, 2]);
            })->get();
            $WriterPreviousOrder = OrderInfo::with(['tasks' => function ($query) use ($User_ID, $todayDate) {
                $query->where('assign_id', $User_ID)->whereDate('DeadLine', '<', $todayDate);
            }])->whereHas('tasks', function ($q) use ($User_ID, $todayDate) {
                $q->where('assign_id', $User_ID)->whereDate('DeadLine', '<', $todayDate);
            })->get();
        } elseif ($User_Role_ID == 8 || $User_Role_ID == 12) {
            $ContentDeadlineToday = OrderInfo::join('order_submission_infos', 'order_submission_infos.order_id', '=', 'order_infos.id')
                ->join('order_assigning_infos', 'order_assigning_infos.order_id', '=', 'order_infos.id')
                ->join('content_basic_infos', 'content_basic_infos.order_id', '=', 'order_infos.id')
                ->where('order_assigning_infos.assign_id', '=', $User_ID)
                ->whereDate('order_submission_infos.DeadLine', '=', $todayDate)
                ->where('content_basic_infos.Order_Status', '!=', '2')
                ->where('content_basic_infos.Order_Status', '!=', '1')
                ->select('order_infos.Order_ID', 'order_infos.Order_Type', 'content_basic_infos.Word_Count', 'order_submission_infos.DeadLine', 'content_basic_infos.Word_Count', 'Order_Status')
                ->get();

            $ContentTodayAll = $ContentDeadlineToday->toArray();
            $draftLetters = ['F', 'S', 'T', 'Four', 'Fifth', 'Sixth', 'Seven', 'Eight', 'nine', 'ten', 'eleven', 'twelve', 'thirteen', 'fourteen', 'fifteen'];
            $counter2 = 1;
            foreach ($draftLetters as $draftLetter) {
                $Content_Deadline_Today = OrderInfo::join('order_submission_infos', 'order_submission_infos.order_id', '=', 'order_infos.id')
                    ->join('order_assigning_infos', 'order_assigning_infos.order_id', '=', 'order_infos.id')
                    ->join('content_basic_infos', 'content_basic_infos.order_id', '=', 'order_infos.id')
                    ->where('content_basic_infos.Order_Status', '!=', '2')
                    ->where('order_assigning_infos.assign_id', '=', $User_ID)
                    ->whereDate("order_submission_infos.{$draftLetter}_DeadLine", '=', $todayDate)
                    ->whereDoesntHave('draftSubmissions', function ($query) use ($counter2) {
                        $query->where('draft_number', $counter2);
                    })
                    ->select('order_infos.Order_ID', 'order_infos.Order_Type', 'content_basic_infos.Word_Count', "order_submission_infos.{$draftLetter}_DeadLine", 'content_basic_infos.Word_Count', 'Order_Status')
                    ->get();

                $ContentTodayAll = array_merge($ContentTodayAll, $Content_Deadline_Today->toArray());
                $counter2++;
            }

            $ContentDeadlineTowmorrow = OrderInfo::join('order_submission_infos', 'order_submission_infos.order_id', '=', 'order_infos.id')
                ->join('order_assigning_infos', 'order_assigning_infos.order_id', '=', 'order_infos.id')
                ->join('content_basic_infos', 'content_basic_infos.order_id', '=', 'order_infos.id')
                ->where('order_assigning_infos.assign_id', '=', $User_ID)
                ->whereDate('order_submission_infos.DeadLine', '=', $tomorrowDate)
                ->where('content_basic_infos.Order_Status', '!=', '2')
                ->where('content_basic_infos.Order_Status', '!=', '1')
                ->select('order_infos.Order_ID', 'order_infos.Order_Type', 'content_basic_infos.Word_Count', 'order_submission_infos.DeadLine', 'content_basic_infos.Word_Count', 'Order_Status')
                ->get();
            $ContentAllTowmorrow = $ContentDeadlineTowmorrow->toArray();
            $counter3 = 1;
            foreach ($draftLetters as $draftLetter) {
                $Content_Deadline_Today = OrderInfo::join('order_submission_infos', 'order_submission_infos.order_id', '=', 'order_infos.id')
                    ->join('order_assigning_infos', 'order_assigning_infos.order_id', '=', 'order_infos.id')
                    ->join('content_basic_infos', 'content_basic_infos.order_id', '=', 'order_infos.id')
                    ->where('content_basic_infos.Order_Status', '!=', '2')
                    ->where('order_assigning_infos.assign_id', '=', $User_ID)
                    ->whereDate("order_submission_infos.{$draftLetter}_DeadLine", '=', $tomorrowDate)
                    ->whereDoesntHave('draftSubmissions', function ($query) use ($counter3) {
                        $query->where('draft_number', $counter3);
                    })
                    ->select('order_infos.Order_ID', 'order_infos.Order_Type', 'content_basic_infos.Word_Count', "order_submission_infos.{$draftLetter}_DeadLine", 'content_basic_infos.Word_Count', 'Order_Status')
                    ->get();

                $ContentAllTowmorrow = array_merge($ContentAllTowmorrow, $Content_Deadline_Today->toArray());
                $counter3++;
            }

            $ContentDeadlines = ['DeadLine', 'F_DeadLine', 'S_DeadLine', 'T_DeadLine'];
            $ContentAllPrevious = [];

            foreach ($ContentDeadlines as $deadline) {
                $content = OrderInfo::Where('Order_Type', 2)->whereHas('assign', function ($query) use ($User_ID) {
                    $query->where('assign_id', $User_ID);
                })->whereHas('submission_info', function ($query) use ($todayDate, $deadline) {
                    $query->where($deadline, '<', $todayDate);
                })->with(['submission_info' => function ($query) use ($deadline) {
                    $query->select('id', $deadline, 'order_id');
                }])->get();

                $ContentAllPrevious = array_merge($ContentAllPrevious, $content->toArray());
            }
        } else if ($User_Role_ID == 16) {
            $graphic_today_d = OrderInfo::join('assign_dead_lines', 'assign_dead_lines.order_id', '=', 'order_infos.id')
                ->join('order_assigning_infos', 'order_assigning_infos.order_id', '=', 'order_infos.id')
                ->join('design_order_infos', 'design_order_infos.order_id', '=', 'order_infos.id')
                ->where('order_assigning_infos.assign_id', $User_ID)
                ->whereDate('assign_dead_lines.deadline_date', '=', $todayDate)
                ->where('design_order_infos.Order_Status', '!=', '2')
                ->where('design_order_infos.Order_Status', '!=', '1')
                ->select('order_infos.Order_ID', 'order_infos.Order_Type', 'assign_dead_lines.deadline_date', 'Order_Status')
                ->get()->toArray();

            $draftLetters = ['first_draft', 'second_draft', 'third_draft', 'forth_draft', 'fifth_draft', 'sixth_draft', 'seventh_draft', 'eighth_draft', 'nineth_draft', 'tenth_draft', 'eleventh_draft', 'twelveth_draft', 'thirteen_draft', 'fourteen_draft', 'fifteen_draft'];
            $graphic_today = $graphic_today_d;

            $counter_design_today = 1;
            foreach ($draftLetters as $draftLetter) {
                $designing_drafts = OrderInfo::join('assign_dead_lines', 'assign_dead_lines.order_id', '=', 'order_infos.id')
                    ->join('order_assigning_infos', 'order_assigning_infos.order_id', '=', 'order_infos.id')
                    ->join('design_order_infos', 'design_order_infos.order_id', '=', 'order_infos.id')
                    ->where('design_order_infos.Order_Status', '!=', '2')
                    ->where('order_assigning_infos.assign_id', $User_ID)
                    ->whereDate("assign_dead_lines.$draftLetter", $todayDate)
                    ->whereDoesntHave('draftSubmissions', function ($query) use ($counter_design_today) {
                        $query->where('draft_number', $counter_design_today);
                    })
                    ->select('order_infos.Order_ID', 'order_infos.Order_Type', "assign_dead_lines.$draftLetter", 'Order_Status')
                    ->get()
                    ->toArray();
                $graphic_today = array_merge($graphic_today, $designing_drafts);
                $counter_design_today++;
            }
            $graphic_tomorrow_d = OrderInfo::join('assign_dead_lines', 'assign_dead_lines.order_id', '=', 'order_infos.id')
                ->join('order_assigning_infos', 'order_assigning_infos.order_id', '=', 'order_infos.id')
                ->join('design_order_infos', 'design_order_infos.order_id', '=', 'order_infos.id')
                ->where('order_assigning_infos.assign_id', $User_ID)
                ->whereDate('assign_dead_lines.deadline_date', '=', $tomorrowDate)
                ->where('design_order_infos.Order_Status', '!=', '2')
                ->where('design_order_infos.Order_Status', '!=', '1')
                ->select('order_infos.Order_ID', 'order_infos.Order_Type', 'assign_dead_lines.deadline_date', 'Order_Status')
                ->get()
                ->toArray();

            $draftLetters = ['first_draft', 'second_draft', 'third_draft', 'forth_draft', 'fifth_draft', 'sixth_draft', 'seventh_draft', 'eighth_draft', 'nineth_draft', 'tenth_draft', 'eleventh_draft', 'twelveth_draft', 'thirteen_draft', 'fourteen_draft', 'fifteen_draft'];

            $graphic_tomorrow = $graphic_tomorrow_d; // Initialize with the data from tomorrow's drafts

            $counter_design_tomorrow = 1;
            foreach ($draftLetters as $draftLetter) {
                $designing_drafts_tomorrow = OrderInfo::join('assign_dead_lines', 'assign_dead_lines.order_id', '=', 'order_infos.id')
                    ->join('order_assigning_infos', 'order_assigning_infos.order_id', '=', 'order_infos.id')
                    ->join('design_order_infos', 'design_order_infos.order_id', '=', 'order_infos.id')
                    ->where('design_order_infos.Order_Status', '!=', '2')
                    ->where('order_assigning_infos.assign_id', $User_ID)
                    ->whereDate("assign_dead_lines.{$draftLetter}", $tomorrowDate)
                    ->whereDoesntHave('draftSubmissions', function ($query) use ($counter_design_tomorrow) {
                        $query->where('draft_number', $counter_design_tomorrow);
                    })
                    ->select('order_infos.Order_ID', 'order_infos.Order_Type', "assign_dead_lines.{$draftLetter}", 'Order_Status')
                    ->get()
                    ->toArray();

                // Merge the data from tomorrow's drafts into $graphic_tomorrow
                $graphic_tomorrow = array_merge($graphic_tomorrow, $designing_drafts_tomorrow);

                $counter_design_tomorrow++;
            }
            $graphic_past = [];
            // $draft_Letters = ['DeadLine', 'F_DeadLine', 'S_DeadLine', 'T_DeadLine', 'Four_DeadLine', 'Fifth_DeadLine', 'Sixth_DeadLine', 'Seven_DeadLine', 'Eight_DeadLine', 'nine_DeadLine', 'ten_DeadLine', 'eleven_DeadLine', 'twelve_DeadLine', 'thirteen_DeadLine', 'fourteen_DeadLine', 'fifteen_DeadLine'];
            // foreach ($draft_Letters as $deadline) {
            //     $design_past_drafts = OrderInfo::Where('Order_Type', 3)
            //         ->whereHas('assign', function ($query) use ($User_ID) {
            //             $query->where('assign_id', $User_ID);
            //         })->whereHas('submission_info', function ($query) use ($todayDate, $deadline) {
            //             $query->where($deadline, '<', $todayDate);
            //         })->with(['submission_info' => function ($query) use ($deadline) {
            //             $query->select('id', $deadline, 'order_id');
            //         }])->get();
            //     $graphic_past = array_merge($graphic_past);
            // }
        }else if($User_Role_ID == 3){
            $graphic_today_d = OrderInfo::join('assign_dead_lines', 'assign_dead_lines.order_id', '=', 'order_infos.id')
                ->join('order_assigning_infos', 'order_assigning_infos.order_id', '=', 'order_infos.id')
                ->join('development_order_infos', 'development_order_infos.order_id', '=', 'order_infos.id')
                ->where('order_assigning_infos.assign_id', $User_ID)
                ->whereDate('assign_dead_lines.deadline_date', '=', $todayDate)
                ->where('development_order_infos.Order_Status', '!=', '2')
                ->where('development_order_infos.Order_Status', '!=', '1')
                ->select('order_infos.Order_ID', 'order_infos.Order_Type', 'assign_dead_lines.deadline_date', 'Order_Status')
                ->get()->toArray();

            $draftLetters = ['first_draft', 'second_draft', 'third_draft', 'forth_draft', 'fifth_draft', 'sixth_draft', 'seventh_draft', 'eighth_draft', 'nineth_draft', 'tenth_draft', 'eleventh_draft', 'twelveth_draft', 'thirteen_draft', 'fourteen_draft', 'fifteen_draft'];
            $graphic_today = $graphic_today_d;

            $counter_design_today = 1;
            foreach ($draftLetters as $draftLetter) {
                $designing_drafts = OrderInfo::join('assign_dead_lines', 'assign_dead_lines.order_id', '=', 'order_infos.id')
                    ->join('order_assigning_infos', 'order_assigning_infos.order_id', '=', 'order_infos.id')
                    ->join('development_order_infos', 'development_order_infos.order_id', '=', 'order_infos.id')
                    ->where('development_order_infos.Order_Status', '!=', '2')
                    ->where('order_assigning_infos.assign_id', $User_ID)
                    ->whereDate("assign_dead_lines.$draftLetter", $todayDate)
                    ->whereDoesntHave('draftSubmissions', function ($query) use ($counter_design_today) {
                        $query->where('draft_number', $counter_design_today);
                    })
                    ->select('order_infos.Order_ID', 'order_infos.Order_Type', "assign_dead_lines.$draftLetter", 'Order_Status')
                    ->distinct()
                    ->get()
                    ->toArray();
                $graphic_today = array_merge($graphic_today, $designing_drafts);
                $counter_design_today++;
            }
            $graphic_tomorrow_d = OrderInfo::join('assign_dead_lines', 'assign_dead_lines.order_id', '=', 'order_infos.id')
                ->join('order_assigning_infos', 'order_assigning_infos.order_id', '=', 'order_infos.id')
                ->join('development_order_infos', 'development_order_infos.order_id', '=', 'order_infos.id')
                ->where('order_assigning_infos.assign_id', $User_ID)
                ->whereDate('assign_dead_lines.deadline_date', '=', $tomorrowDate)
                ->where('development_order_infos.Order_Status', '!=', '2')
                ->where('development_order_infos.Order_Status', '!=', '1')
                ->select('order_infos.Order_ID', 'order_infos.Order_Type', 'assign_dead_lines.deadline_date', 'Order_Status')
                ->get()
                ->toArray();

            $draftLetters = ['first_draft', 'second_draft', 'third_draft', 'forth_draft', 'fifth_draft', 'sixth_draft', 'seventh_draft', 'eighth_draft', 'nineth_draft', 'tenth_draft', 'eleventh_draft', 'twelveth_draft', 'thirteen_draft', 'fourteen_draft', 'fifteen_draft'];

            $graphic_tomorrow = $graphic_tomorrow_d; 

            $counter_design_tomorrow = 1;
            foreach ($draftLetters as $draftLetter) {
                $designing_drafts_tomorrow = OrderInfo::join('assign_dead_lines', 'assign_dead_lines.order_id', '=', 'order_infos.id')
                    ->join('order_assigning_infos', 'order_assigning_infos.order_id', '=', 'order_infos.id')
                    ->join('development_order_infos', 'development_order_infos.order_id', '=', 'order_infos.id')
                    ->where('development_order_infos.Order_Status', '!=', '2')
                    ->where('order_assigning_infos.assign_id', $User_ID)
                    ->whereDate("assign_dead_lines.{$draftLetter}", $tomorrowDate)
                    ->whereDoesntHave('draftSubmissions', function ($query) use ($counter_design_tomorrow) {
                        $query->where('draft_number', $counter_design_tomorrow);
                    })
                    ->select('order_infos.Order_ID', 'order_infos.Order_Type', "assign_dead_lines.{$draftLetter}", 'Order_Status')
                    ->get()
                    ->toArray();

                $graphic_tomorrow = array_merge($graphic_tomorrow, $designing_drafts_tomorrow);
                $counter_design_tomorrow++;
            }
            $graphic_past = [];
        }
        $today = Carbon::now();
        $tomorrow = Carbon::tomorrow();
        $threeHoursLeft = Carbon::now()->subHours(3);
        $Role_ID = (int)$auth_user->Role_ID;
        $statusCountsFlat = $this->orderService->getOrderCounts();
        $empCount = User::count();
        $lastAttendanceID = Attendance::OrderByDesc('id')->where('user_id', $auth_user->id)->first();
         
         
        // $lastAttendanceID = Attendance::whereDate('created_at', $today->format('Y-m-d'))->where('user_id', $auth_user->id)
            // ->first();
        $Leave_Quota = UserLeaveQuota::where('user_id', $auth_user->id)->first();
    
            $todayNotice = Notice::with(['images', 'createdBy.basic_info'])->whereDate('created_at', Carbon::today())->first();

        return view('livewire.dashboard', compact(
             'todayNotice',
            'ContentAllPrevious',
            'ContentAllTowmorrow',
            'ContentTodayAll',
            'WriterPreviousOrder',
            'WriterTomorrowOrder',
            'WriterTodayOrder',
            'CordinatorPreviousAll',
            'CordinatorTomorrowAll',
            'CordinatorTodayAll',
            'OrdersToday',
            'OrdersPast',
            'OrdersTomorrow',
            'auth_user',
            'Final_DeadLines',
            'deadline_times',
            'statusCountsFlat',
            'auth_user',
            'empCount',
            'lastAttendanceID',
            'Leave_Quota',
            'graphic_today',
            'graphic_tomorrow',
            'graphic_past'
        ))->layout('layouts.authorized');
    }
}
