<?php

namespace App\Http\Livewire\Research;

use App\Events\NotificationCreated;
use App\Helpers\PortalHelpers;
use App\Models\AssignDeadLine;
use App\Models\Auth\User;
use App\Models\Draft\DraftSubmission;
use App\Models\Performance\WriterPerformance;
use App\Models\ResearchOrders\OrderAssigningInfo;
use App\Models\ResearchOrders\OrderInfo;
use App\Models\ResearchOrders\OrderTaskSubmit;
use App\Models\ResearchOrders\ResearchDraftSubmission;
use App\Notifications\PortalNotifications;
use App\Services\OrdersService;
use App\Services\ResearchOrderService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Notification;
use Livewire\Component;

class ReasearchOrdersView extends Component
{
    protected ResearchOrderService $researchOrderService;
    protected OrdersService $ordersService;

    public function mount(ResearchOrderService $researchOrderService, OrdersService $ordersService): void
    {
        $this->researchOrderService = $researchOrderService;
        $this->ordersService = $ordersService;
    }

    public function render(Request $request)
    {
        $Order_ID = Crypt::decryptString($request->Order_ID);
        $auth_user = Auth::guard('Authorized')->user();


        $currentDateTime = date('Y-m-d H:i:s');

        DB::table('notifications')
            ->where('notifiable_id', $auth_user->id)
            ->where('data->Order_ID', $Order_ID) 
            ->update(['read_at' => $currentDateTime]);


        $draft_submission = DraftSubmission::where('order_number', $Order_ID)->get();
        $Research_Order = $this->researchOrderService->getOrderDetail($Order_ID, (int)$auth_user->Role_ID, (int)$auth_user->id);
        // dd($Research_Order->toArray());
        $Coordinators = $this->ordersService->getCoordinators();
        $Writers = $this->ordersService->getWriters((int)$auth_user->Role_ID, (int)$auth_user->id);
        $AssignOrderArray = User::with('basic_info')->where('Role_ID', 5)->orwhere('Role_ID', 7)->get();
        return view('livewire.research.reasearch-orders-view', compact('Order_ID', 'Research_Order', 'Coordinators', 'Writers', 'auth_user', 'draft_submission', 'AssignOrderArray'))->layout('layouts.authorized');
    }

    public function assignOrder(Request $request): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $Order = OrderInfo::where('Order_ID', $request->Order_ID)->firstOrFail();
            

            $users = User::findMany($request->Assign_ID);
            $userIds = [];

            foreach ($users as $user) {
                if (!$Order->assign->contains('id', $user->id)) {
                    OrderAssigningInfo::create([
                        'order_id' => $Order->id,
                        'assign_id' => $user->id,
                    ]);

                    if ($Order->Order_Type == 1) {
                        AssignDeadLine::create([
                            'deadline_date' => $request->DeadLine,
                            'deadline_time' => $request->DeadLine_Time,
                            'first_draft' => $request->F_DeadLine,
                            'second_draft' => $request->S_DeadLine,
                            'third_draft' => $request->T_DeadLine,
                            'forth_draft' => $request->Four_DeadLine,
                            'fifth_draft' => $request->Fifth_DeadLine,
                            'sixth_draft' => $request->Sixth_DeadLine,
                            'seventh_draft' => $request->Seven_DeadLine,
                            'eighth_draft' => $request->Eight_DeadLine,
                            'nineth_draft' => $request->nine_DeadLine,
                            'tenth_draft' => $request->ten_DeadLine,
                            'eleventh_draft' => $request->eleven_DeadLine,
                            'twelveth_draft' => $request->twelve_DeadLine,
                            'thirteen_draft' => $request->thirteen_DeadLine,
                            'fourteen_draft' => $request->fourteen_DeadLine,
                            'fifteen_draft' => $request->fifteen_DeadLine,
                            'order_id' => $Order->id,
                            'user_id' => $user->id,
                        ]);
                    }
                }
            }
            foreach ($users as $user) {
                WriterPerformance::create([
                    'order_id' => $Order->id,
                    'user_id' => $user->id
                ]);
            }

            foreach ($users as $user) {
                $userIds[] = (int)$user->id;
            }

            $authUser = Auth::guard('Authorized')->user();
            $usersToNotify = array_merge([(int)$authUser->id], $userIds);

            $message = $request->Order_ID . ' has been Assigned Successfully!.';
            if ($Order->Order_Type == 1) {
                $manager = 4;
            } else {
                $manager = 17;
            }
            PortalHelpers::sendNotification(null, $request->Order_ID, $message, $authUser->designation->Designation_Name, (array)$usersToNotify, [1, $manager]);

            DB::commit();
            return back()->with('Success!', "Order Assigned Successfully!");
        } catch (ModelNotFoundException | \Exception $e) {
            DB::rollBack();
            return redirect()->route('Error.Response', ['Message' => $e->getMessage()]);
        }
    }

    public function ViewAssignTask(Request $request)
    {
        $Task_Details = OrderTaskSubmit::where('task_id', $request->task_id)->get();

        $html = '';
        foreach ($Task_Details as $index => $task) {
            $html .= '<tr>';
            $html .= '<td>' . ($index + 1) . '</td>';
            $html .= '<td>' . $task->File_Name . '<br>' . $task->created_at . '</td>';
            $html .= '<td><a href="' . asset($task->task_file_path) . '" class="action-btns1" download><i class="feather feather-download text-success"></i></a></td>';
            $html .= '</tr>';
        }

        return $html;
    }


    public function removeCordinator(Request $request)
    {
        try {
            $assign_order = OrderAssigningInfo::where('order_id', $request->order_id)
                ->where('assign_id', $request->assign_id)
                ->firstOrFail();

            $assign_order->delete();

            $authUser = Auth::guard('Authorized')->user();

            $OrderID = OrderInfo::where('id', $request->order_id)->firstOrFail();

            $message = $OrderID->Order_ID . ' has removed a coordinator';
            PortalHelpers::sendNotification(
                null,
                $OrderID->Order_ID,
                $message,
                $authUser->designation->Designation_Name,
                (array)$authUser->id,
                [1, 4]
            );

            return back()->with('Success!', 'Coordinator removed successfully!');
        } catch (ModelNotFoundException | \Exception $e) {

            return redirect()->route('Error.Response', ['Message' => $e->getMessage()]);
        }
    }
}
